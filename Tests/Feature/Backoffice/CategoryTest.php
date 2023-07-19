<?php

namespace MiniBlog\Tests\Feature\Backoffice;

use Tests\TestCase;

class CategoryTest extends TestCase
{
    public function testBasic()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
