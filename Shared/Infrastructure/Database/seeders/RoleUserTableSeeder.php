<?php

namespace MiniBlog\Shared\Infrastructure\Database\seeders;

use Illuminate\Database\Seeder;
use MiniBlog\Shared\Infrastructure\Persistences\Models\User;

class RoleUserTableSeeder extends Seeder
{
    public function run(): void
    {
        User::findOrFail(1)->roles()->sync(1);
    }
}
