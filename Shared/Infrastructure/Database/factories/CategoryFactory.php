<?php

namespace MiniBlog\Shared\Infrastructure\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use MiniBlog\Shared\Infrastructure\Persistences\Models\Category;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition(): array
    {
        return [

        ];
    }
}
