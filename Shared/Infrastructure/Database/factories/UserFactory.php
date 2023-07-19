<?php

namespace MiniBlog\Shared\Infrastructure\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use MiniBlog\Shared\Infrastructure\Persistences\Models\User;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        return [

        ];
    }
}
