<?php

namespace MiniBlog\Shared\Infrastructure\Database\seeders;

use Illuminate\Database\Seeder;
use MiniBlog\Shared\Infrastructure\Persistences\Models\User;

class UserTableSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'id'                => 1,
                'name'              => 'Admin',
                'email'             => 'admin@admin.com',
                'email_verified_at' => null,
                'password'          => bcrypt('password'),
                'remember_token'    => null,
                'created_at'        => now(),
                'updated_at'        => now()

            ],
        ];

        User::insert($users);
    }
}

