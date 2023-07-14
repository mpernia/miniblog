<?php

namespace MiniBlog\Tests\Feature\Frontend;

use Tests\TestCase;

class CategoryTest extends TestCase
{
    public function testBasic()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
