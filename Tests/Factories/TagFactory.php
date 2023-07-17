<?php

namespace MiniBlog\Tests\Factories;

use MiniBlog\BoundedContext\Shared\Domain\DataTransferObjects\TagDto;
use MiniBlog\Shared\Domain\DataTransferObjects\DataTransferObject;

class TagFactory extends Factory
{
    protected function handle(): DataTransferObject
    {
        $name = $this->faker->sentence(2);
        return new TagDto([
            'name' => $name,
            'slug' => str_replace(' ', '-', $name),
        ]);
    }
}
