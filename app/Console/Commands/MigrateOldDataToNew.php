<?php

namespace App\Console\Commands;

use App\Enum\MorphImage\MorphImageImageTypeEnum;
use App\Enum\Newsletter\NewsletterGeneralEnum;
use App\Helper\ImageHelper;
use App\Helper\SeoHelper;
use App\Models\Category;
use App\Models\MainHeadline;
use App\Models\MorphImage;
use App\Models\Newsletter;
use App\Models\NewsletterPublicationStatus;
use App\Models\NewsletterSource;
use App\Models\SeoSetting;
use App\Models\Tag;
use App\Models\User;
use App\Service\Seo\SeoService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MigrateOldDataToNew extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'database:migrate-legacy-to-new';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Eski verilerin yeni veritabanına aktarılması';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        ini_set('memory_limit', '-1');
        set_time_limit(0);
        DB::beginTransaction();
        $old_database = DB::connection('old_database');

        try {
            $totalRecords = $old_database->table('newsletters')->count();

            if ($totalRecords === 0) {
                $this->info('Aktarılacak veri bulunamadı!');
                return;
            }

            /** @var User $created_by_user */
            $created_by_user = User::query()
                ->select("id")
                ->where('email', "bozoktv66@gmail.com")
                ->first();

            $created_by_user_id = 2;

            if ($created_by_user) {
                $created_by_user_id = $created_by_user->id;
            }
            /** @var NewsletterSource $source_bozok_tv_id */
            $source_bozok_tv_id = NewsletterSource::query()
                ->select("id")
                ->bozokTv()
                ->first()
                ->id;
            // Progress bar başlat
            $this->info("Toplam $totalRecords veri aktarılacak...");
            $progressBar = $this->output->createProgressBar($totalRecords);
            $progressBar->start();

            // Başlangıç zamanı
            $startTime = microtime(true);

            // Verileri chunk'larla çekme
            $old_database->table('newsletters')
                ->orderBy('order')
                ->chunk(1000, function ($old_newsletters) use ($totalRecords, $progressBar, $old_database, $created_by_user_id, $source_bozok_tv_id) {
                    $seo_service = new SeoService();
                    foreach ($old_newsletters as $index => $old_newsletter) {

                        $current_index = $progressBar->getProgress() + $index + 1;

                        /** @var \stdClass|null $old_category */
                        $old_category = $old_database->table('categories')
                            ->where('id', $old_newsletter->category_id)
                            ->first();

                        /** @var Category $category */
                        $category = Category::query()
                            ->where('slug', $old_category->slug)
                            ->first();

                        if (!$category) {
                            $category = Category::query()
                                ->create([
                                    'name' => $old_category->name,
                                    'is_active' => $old_category->is_active,
                                    'home_page' => $old_category->home_page,
                                    "created_by_user_id" => $created_by_user_id
                                ]);
                            $seo_service->generateSeoData($category);
                        }

                        $newsletter_publication_status_id = $this->getStatusById($old_newsletter->slug, true);

                        $newsletter = Newsletter::query()
                            ->create([
                                "uuid" => Str::uuid(),
                                'category_id' => $category->id,
                                "created_by_user_id" => $created_by_user_id,
                                "newsletter_publication_status_id" => $newsletter_publication_status_id,
                                "newsletter_source_id" => $source_bozok_tv_id,
                                "title" => $old_newsletter->title,
                                "slug" => $old_newsletter->slug == "arsiv" ? Str::slug($old_newsletter->title) : $old_newsletter->slug,
                                "spot" => $old_newsletter->spot,
                                "content" => $old_newsletter->detail,
                            ]);

                        if ($old_newsletter->slider) {
                            MainHeadline::query()
                                ->create([
                                    "uuid" => Str::uuid(),
                                    "created_by_user_id" => $created_by_user_id,
                                    "headlineable_type" => Newsletter::class,
                                    "headlineable_id" => $newsletter->id,
                                ]);
                        }

                        if ($old_newsletter->five_cuff) {
                            $newsletter->fiveCuff()
                                ->create([]);
                        }

                        if ($old_newsletter->featured) {
                            $newsletter->outstandings()
                                ->create([]);
                        }

                        if ($old_newsletter->last_minute) {
                            $newsletter->lastMinute()
                                ->create([]);
                        }

                        if ($old_newsletter->cuff_of_the_day) {
                            $newsletter->todayHeadline()
                                ->create([]);
                        }

                        if ($old_newsletter->image) {
                            MorphImage::query()
                                ->create([
                                    'imageable_id' => $newsletter->id,
                                    'imageable_type' => Newsletter::class,
                                    'path' => 'old-site/'.$old_newsletter->image,
                                    "image_type" => MorphImageImageTypeEnum::COVER
                                ]);
                        }

                        if ($old_newsletter->detail_image) {
                            MorphImage::query()
                                ->create([
                                    'imageable_id' => $newsletter->id,
                                    'imageable_type' => Newsletter::class,
                                    'path' => 'old-site/'.$old_newsletter->image,
                                    "image_type" => MorphImageImageTypeEnum::FEATURED,
                                ]);
                        }

                        $seo_service->generateSeoData($newsletter);

                        // İlerlemeyi göster
                        $progressBar->advance();

                        // Yüzdeyi hesapla
                        $percentage = (int)(($current_index) / $totalRecords * 100);

                        // Her 100 işlemde bir bilgi yazdır
                        if ($current_index % 100 === 0) {
                            $this->line("{$current_index}/$totalRecords [{$progressBar->getProgress()}] $percentage%");
                        }
                    }
                });

            // İşlem bitiminde geçen süreyi hesapla
            $endTime = microtime(true);
            $executionTime = $endTime - $startTime;

            // Transaction commit
            DB::commit();
            $this->info("$executionTime kadar sürdü.");
            $progressBar->finish();

        } catch (\Exception $exception) {
            DB::rollBack();
            $this->error($exception->getMessage());
        }
    }

    private function getStatusById($slug, $is_active)
    {
        $statusMap = [
            'arsiv' => 'archive',
            true => 'onTheAir',
            false => 'removed',
        ];

        // Eğer 'arsiv' slug'ı varsa, archive statusunu döndür
        if ($slug == 'arsiv') {
            return $this->getStatusId('archive');
        }

        // Durum aktifse 'onTheAir', değilse 'removed' döndür
        return $this->getStatusId($statusMap[$is_active] ?? 'draft');
    }

    /**
     * İlgili statusu getir
     */
    private function getStatusId($statusMethod)
    {
        return NewsletterPublicationStatus::query()
            ->select('id')
            ->{$statusMethod}() // dinamik metod çağırma
            ->first()
            ->id;
    }
}
