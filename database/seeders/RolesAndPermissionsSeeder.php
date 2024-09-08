<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'manage-users' => 'Manage users',
            'publish-articles' => 'Publish articles',
            'edit-articles' => 'Edit articles',
            'delete-articles' => 'Delete articles',
            'access-admin-panel' => 'Access admin panel',
            'access-editor-panel' => 'Access editor panel',
            'write-columns' => 'Write columns',
            'edit-columns' => 'Edit columns',
            'delete-columns' => 'Delete columns'
        ];

        foreach ($permissions as $slug => $name) {
            Permission::updateOrCreate(['slug' => $slug], ['name' => $name]);
        }

        // Roller ve ilgili izinleri oluştur
        $roles = [
            'super-admin' => [
                'manage-users',
                'publish-articles',
                'edit-articles',
                'delete-articles',
                'access-admin-panel',
                'delete-columns',
            ],
            'admin' => [
                'manage-users',
                'publish-articles',
                'edit-articles',
                'delete-articles',
                'access-admin-panel',
                'delete-columns',
            ],
            'author' => [
                'write-columns',
                'edit-columns',
            ],
            'user' => [] // User rolü herhangi bir izin içermiyor
        ];

        foreach ($roles as $roleSlug => $rolePermissions) {
            $role = Role::updateOrCreate(['slug' => $roleSlug], ['name' => ucfirst($roleSlug)]);
            $role->syncPermissions(Permission::whereIn('slug', $rolePermissions)->get());
        }
    }
}
