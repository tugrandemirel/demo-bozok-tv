<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('social_media_setting.links', []);
    }

    public function down(): void
    {
        $this->migrator->delete('social_media_setting.links');
    }
};
