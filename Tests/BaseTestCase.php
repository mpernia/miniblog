<?php

namespace MiniBlog\Tests;

use Illuminate\Foundation\Testing\TestCase;
use Illuminate\Support\Facades\Artisan;
use Tests\CreatesApplication;

abstract class BaseTestCase extends TestCase
{
    use CreatesApplication;

    protected function setUp(): void
    {
        parent::setUp();
        //Artisan::call('migrate:fresh --seed');
    }
}
