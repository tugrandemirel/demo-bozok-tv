<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class ContactSetting extends Settings
{
    public ?string $phone;
    public ?string $email;
    public ?string $address;

    public static function group(): string
    {
        return 'contact';
    }
}
