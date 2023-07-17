<?php

namespace MiniBlog\Tests\Factories;

use Faker\Factory as FakerFactory;
use Faker\Generator;
use MiniBlog\Shared\Domain\DataTransferObjects\DataTransferObject;
use Tests\CreatesApplication;

abstract class Factory
{
    use CreatesApplication;

    protected Generator $faker;
    protected $app;

    public function __construct()
    {
        $this->faker = FakerFactory::create();
        $this->app = $this->createApplication();
    }

    public static function create(int $count = 1) : array|DataTransferObject
    {
        $instance = new static();

        if ($count === 1) {
            return $instance->handle();
        }

        $data = [];

        for ($i = 0; $i < $count; $i++) {
            $data[] = $instance->handle();
        }

        return $data;
    }

    abstract protected function handle() : DataTransferObject;
}
