<?php

namespace MiniBlog\Tests\Feature\Backoffice;

use Tests\TestCase;

class RoleTest extends TestCase
{
    public function testBasic()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
