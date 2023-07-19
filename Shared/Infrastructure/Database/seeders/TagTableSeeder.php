<?php

namespace MiniBlog\Shared\Infrastructure\Database\seeders;

use Illuminate\Database\Seeder;
use MiniBlog\Shared\Infrastructure\Persistences\Models\Tag;

class TagTableSeeder extends Seeder
{
    public function run(): void
    {
        $tags = [
            [
                'id'   => 1,
                'name' => 'policies',
                'slug' => 'policies',
            ],
            [
                'id'   => 2,
                'name' => 'terms',
                'slug' => 'terms',
            ],
            [
                'id'   => 3,
                'name' => 'cookies',
                'slug' => 'cookies',
            ],
        ];

        Tag::insert($tags);
    }
}
