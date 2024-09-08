<?php

namespace Database\Seeders;

use App\Enum\User\UserTermsAcceptedEnum;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /** @var User $super_admin */
        $super_admin = User::query()
            ->create([
                'uuid' => Str::uuid(),
                'name' => 'Super',
                'surname' => ' Admin',
                'email' => 'demireltugran66@gmail.com',
                'password' => bcrypt('123456789'),
                'phone' => '0544 338 0633',
                'terms_accepted' => UserTermsAcceptedEnum::ACCEPTED
            ]);
        $super_admin->assignRole('super-admin');

        /** @var User $admin */
        $admin = User::query()
            ->create([
                'uuid' => Str::uuid(),
                'name' => 'Necdet',
                'surname' => ' Demirel',
                'email' => 'bozoktv66@gmail.com',
                'password' => bcrypt('123456789'),
                'phone' => '0530 662 45 66',
                'terms_accepted' => UserTermsAcceptedEnum::ACCEPTED
            ]);
        $admin->assignRole('admin');

        /** @var User $author */
        $author = User::query()
            ->create([
                'uuid' => Str::uuid(),
                'name' => 'Editor',
                'surname' => ' Demirel',
                'email' => 'editor@editor.com',
                'password' => bcrypt('123456789'),
                'phone' => '0530 662 66 66',
                'terms_accepted' => UserTermsAcceptedEnum::ACCEPTED
            ]);
        $author->assignRole('author');

        /** @var User $user */
        $user = User::query()
            ->create([
                'uuid' => Str::uuid(),
                'name' => 'User',
                'surname' => 'User',
                'email' => 'user@user.com',
                'password' => bcrypt('123456789'),
                'phone' => '0530 666 66 66',
                'terms_accepted' => UserTermsAcceptedEnum::ACCEPTED
            ]);
        $user->assignRole('user');
    }
}
