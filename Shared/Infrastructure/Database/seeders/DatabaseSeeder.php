<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use MiniBlog\Shared\Infrastructure\Database\seeders\CategoryTableSeeder;
use MiniBlog\Shared\Infrastructure\Database\seeders\PermissionRoleTableSeeder;
use MiniBlog\Shared\Infrastructure\Database\seeders\PermissionsTableSeeder;
use MiniBlog\Shared\Infrastructure\Database\seeders\PostTableSeeder;
use MiniBlog\Shared\Infrastructure\Database\seeders\RolesTableSeeder;
use MiniBlog\Shared\Infrastructure\Database\seeders\RoleUserTableSeeder;
use MiniBlog\Shared\Infrastructure\Database\seeders\TagTableSeeder;
use MiniBlog\Shared\Infrastructure\Database\seeders\UserTableSeeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            PermissionsTableSeeder::class,
            RolesTableSeeder::class,
            PermissionRoleTableSeeder::class,
            UserTableSeeder::class,
            RoleUserTableSeeder::class,
        ]);

        if (config('app.env') === 'local')
        {
            $this->call([
                CategoryTableSeeder::class,
                TagTableSeeder::class,
                PostTableSeeder::class,
            ]);
        }
    }
}
