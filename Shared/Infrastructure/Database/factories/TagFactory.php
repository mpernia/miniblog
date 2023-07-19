<?php

namespace MiniBlog\Shared\Infrastructure\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use MiniBlog\Shared\Infrastructure\Persistences\Models\Tag;

class TagFactory extends Factory
{
    protected $model = Tag::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'slug' => $this->faker->slug(),
        ];
    }
}
