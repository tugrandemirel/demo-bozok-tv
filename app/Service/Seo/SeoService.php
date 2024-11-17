<?php

namespace App\Service\Seo;

use App\Models\MorphImage;
use App\Models\SeoSetting;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SeoService
{
    protected $stopWords = [
        've', 'ile', 'için', 'bir', 'de', 'da', 'bu', 'şu', 'her', 'ancak', 'ama',
        'fakat', 'ki', 'mı', 'mi', 'mu', 'mü', 'ne', 'veya', 'yahut', 'velev ki',
        'gibi', 'lakin', 'ile birlikte', 'hem', 'o', 'bu', 'şu', 'iç', 'aşağı yukarı',
        'önce', 'sonra', 'bütün', 'tüm', 'tümü', 'olarak', 'birlikte', 'sadece',
        'ise', 'aynı', 'üzerine', 'göre', 'diğer', 'aynı zamanda', 'artık',
        'yakın', 'daha', 'çok', 'bazı', 'buna', 'bununla', 'ben', 'sen', 'biz',
        'siz', 'o', 'bu', 'şu', 'onlar', 'onun', 'bunlar', 'kim', 'kimi',
        'hangi', 'neden', 'niçin', 'nasıl', 'yine', 'oldukça', 'hala', 'en',
        'az', 'çok', 'birkaç', 'kadar', 'herhangi', 'hangi', 'nerede', 'nereye',
        'nereden', 'nasıl', 'niye', 'hiç', 'hiçbir', 'bazıları'
    ];

    /**
     * @throws \Exception
     */
    public function generateSeoData($model): void
    {
       try {
           // Modelin türüne göre başlık, içerik ve diğer alanlar
           switch (get_class($model)) {
               case 'App\Models\Newsletter':
                   $title = $model->title;
                   $description = $this->generateDescription($model->content, $model->spot);
                   $keywords = $this->generateKeywords($model->content);
                   break;

               case 'App\Models\Gallery':
                   $title = $model->title;
                   $description = $this->generateDescription($model->description);
                   $keywords = $this->generateKeywords($model->description);
                   break;

               case 'App\Models\Post':
                   $title = $model->title;
                   $description = $this->generateDescription($model->content);
                   $keywords = $this->generateKeywords($model->content);
                   break;

               default:
                   throw new \Exception("Geçersiz model türü");
           }

           // Stop words'leri temizle
           $keywords = $this->removeStopWords($keywords);

           // Dinamik Canonical URL
           $canonicalUrl = $this->generateCanonicalUrl($model);

           // Open Graph verilerini oluştur
           $ogTitle = $this->sanitizeMetaTitle($title);
           $ogDescription = $this->sanitizeMetaDescription($description);
           $ogImage = $this->generateOpenGraphImage($model);

           // Twitter Card verilerini oluştur
           $twitterTitle = $ogTitle; // Aynı başlık
           $twitterDescription = $ogDescription; // Aynı açıklama
           $twitterImage = $ogImage; // Aynı resim

           // Veritabanına kayıt işlemi
           $seoData = [
               'uuid' => Str::uuid(),
               'created_by_user_id' => $model->created_by_user_id ?? $model->user_id,
               'meta_title' => $this->sanitizeMetaTitle($title),
               'meta_description' => $this->sanitizeMetaDescription($description),
               'meta_keywords' => implode(',', $keywords),
               'seoable_type' => get_class($model),
               'seoable_id' => $model->id,
               'canonical_url' => $canonicalUrl, // Eklenen Canonical URL
               'og_title' => $ogTitle, // Open Graph başlığı
               'og_description' => $ogDescription, // Open Graph açıklaması
               'og_image' => $ogImage, // Open Graph resmi
               'twitter_title' => $twitterTitle, // Twitter başlığı
               'twitter_description' => $twitterDescription, // Twitter açıklaması
               'twitter_image' => $twitterImage, // Twitter resmi
           ];

           SeoSetting::updateOrCreate(
               [
                   'seoable_type' => $seoData['seoable_type'],
                   'seoable_id' => $seoData['seoable_id']
               ],
               $seoData
           );
       } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
       }
    }

    protected function generateCanonicalUrl($model): string
    {
        // Dinamik URL oluşturmak için modelin ID'sini kullan
        return url('/' . strtolower(class_basename($model)) . '/' . $model->id);
    }

    protected function generateOpenGraphImage($model): ?string
    {
        // MorphImage ilişkisini kullanarak resmi elde et
        $image = MorphImage::where('imageable_id', $model->id)
            ->where('imageable_type', get_class($model))
            ->first();

        // Resim varsa, URL'sini döndür
        return $image ? url( '/storage/'.$image->path) : null; // URL dönüşümünü yap
    }

    protected function generateDescription($content, $spot = null): string
    {
        // Spot varsa, ilk olarak onu kullan. Yoksa içeriğin ilk 160 karakterini al.
        return Str::limit(strip_tags($spot ?: $content), 160);
    }

    protected function generateKeywords($content): array
    {
        // Kelimelerin ağırlıklarını analiz ederek anahtar kelimeler oluştur
        $words = array_filter(explode(' ', strip_tags($content)));
        $wordCounts = array_count_values($words);

        // En çok tekrar eden 5 kelimeyi anahtar kelime olarak seç
        arsort($wordCounts);
        return array_slice(array_keys($wordCounts), 0, 5);
    }

    protected function removeStopWords($keywords): array
    {
        return array_diff($keywords, $this->stopWords);
    }

    protected function sanitizeMetaTitle($title): string
    {
        // Meta başlığı optimize et ve gereksiz boşlukları temizle
        return Str::limit(trim(strip_tags($title)), 60);
    }

    protected function sanitizeMetaDescription($description): string
    {
        return Str::limit(trim(strip_tags($description)), 160);
    }
}
