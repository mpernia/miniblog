<?php

namespace MiniBlog\Shared\Infrastructure\Database\seeders;

use Illuminate\Database\Seeder;
use MiniBlog\Shared\Infrastructure\Persistences\Models\Category;

class CategoryTableSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'id' => 1,
                'name' => 'Static Pages',
                'slug' => 'static-pages',
            ]
        ];

        Category::insert($categories);
    }
}
