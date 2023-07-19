<?php

namespace MiniBlog\Shared\Infrastructure\Database\seeders;

use Illuminate\Database\Seeder;
use MiniBlog\Shared\Infrastructure\Persistences\Models\Role;

class RolesTableSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            ['id' => 1, 'title' => 'Admin'],
            ['id' => 2, 'title' => 'Collaborator'],
            ['id' => 3, 'title' => 'User']
        ];

        Role::insert($roles);
    }
}
