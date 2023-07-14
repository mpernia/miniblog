<?php

namespace MiniBlog\Tests\Feature\Frontend;

use Tests\TestCase;

class PostTest extends TestCase
{
    public function testBasic()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
