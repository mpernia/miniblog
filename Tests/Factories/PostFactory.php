<?php

namespace MiniBlog\Tests\Factories;

use MiniBlog\BoundedContext\Shared\Domain\DataTransferObjects\PostDto;
use MiniBlog\Shared\Domain\DataTransferObjects\DataTransferObject;

class PostFactory extends Factory
{
    protected function handle(): DataTransferObject
    {
        return new PostDto([
            'title' => $this->faker->text(6),
            'content' => implode(PHP_EOL, $this->faker->paragraphs($this->faker->randomNumber([1, 2, 3]))),
            'excerpt' => $this->faker->paragraph(),
            'created_at' => $this->faker->dateTimeBetween('-1 months', '-1 day'),
        ]);
    }
}
