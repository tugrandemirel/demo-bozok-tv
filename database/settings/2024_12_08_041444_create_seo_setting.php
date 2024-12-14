<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('seo_settings.default_title', 'Haber Sitesi');
        $this->migrator->add('seo_settings.default_description', 'Son dakika haberler ve güncel gelişmeler.');
        $this->migrator->add('seo_settings.default_keywords', ['haber', 'son dakika', 'güncel']);
        $this->migrator->add('seo_settings.pages', [
            'about' => [
                'title' => 'Hakkımızda - Haber Sitesi',
                'description' => 'Haber sitemiz hakkında bilgiler.',
                'keywords' => ['hakkımızda', 'bilgi', 'haber sitesi'],
            ],
            'contact' => [
                'title' => 'İletişim - Haber Sitesi',
                'description' => 'Bize ulaşın.',
                'keywords' => ['iletişim', 'haber sitesi', 'destek'],
            ],
            'tag' => [
                'title' => 'Künye - Bozok Tv Sitesi',
                'description' => 'Bize ulaşın.',
                'keywords' => ['iletişim', 'haber sitesi', 'destek'],
            ],
        ]);
    }

    public function down(): void
    {
        $this->migrator->delete('seo_settings.default_title');
        $this->migrator->delete('seo_settings.default_description');
        $this->migrator->delete('seo_settings.default_keywords');
        $this->migrator->delete('seo_settings.pages');
    }
};
