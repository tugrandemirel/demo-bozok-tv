<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add("contact.phone", null);
        $this->migrator->add("contact.email", null);
        $this->migrator->add("contact.address",  null);
    }

    public function down()
    {
        $this->migrator->delete("contact.phone");
        $this->migrator->delete("contact.email");
        $this->migrator->delete("contact.address");
    }
};
