<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general_setting.site_name', 'Bozok Tv');
        $this->migrator->add('general_setting.slogan', "Yozgat'tan Dünyaya Açılan Pencere");
        $this->migrator->add('general_setting.logo',  null);
        $this->migrator->add('general_setting.favicon',  null);
        $this->migrator->add('general_setting.url', 'https://bozok.tv');
        $this->migrator->add('general_setting.is_active', true);
    }

    public function down()
    {
        $this->migrator->delete('general_setting.site_name');
        $this->migrator->delete('general_setting.slogan');
        $this->migrator->delete('general_setting.logo');
        $this->migrator->delete('general_setting.favicon');
        $this->migrator->delete('general_setting.url');
        $this->migrator->delete('general_setting.is_active');
    }
};
