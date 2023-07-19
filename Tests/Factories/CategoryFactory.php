<?php

namespace MiniBlog\Tests\Factories;

use MiniBlog\BoundedContext\Shared\Domain\DataTransferObjects\CategoryDto;
use MiniBlog\Shared\Domain\DataTransferObjects\DataTransferObject;

class CategoryFactory extends Factory
{
    protected function handle(): DataTransferObject
    {
        $name = $this->faker->sentence(3);
        return new CategoryDto([
            'name' => $name,
            'slug' => str_replace(' ', '-', $name)
        ]);
    }
}
