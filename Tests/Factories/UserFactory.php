<?php

namespace MiniBlog\Tests\Factories;

use MiniBlog\BoundedContext\Shared\Domain\DataTransferObjects\UserDto;
use MiniBlog\Shared\Domain\DataTransferObjects\DataTransferObject;

class UserFactory extends Factory
{
    protected function handle(): DataTransferObject
    {
        return new UserDto([
            'name' => $this->faker->userName(),
            'email' => $this->faker->email(),
            'password' => bcrypt('hello'),
        ]);
    }
}
