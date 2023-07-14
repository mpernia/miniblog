<?php

namespace MiniBlog\Tests\Feature\Backend;

use Tests\TestCase;

class UserTest extends TestCase
{
    public function test_unauthenticated_user_cannot_access_to_user()
    {
        $response = $this->getJson('/api/v1/users/1');
        $response->assertUnauthorized();
    }

    public function test_returns_users_list()
    {
        $this->fail();
    }

    public function test_user_store_successful()
    {
        $this->fail();
    }

    public function test_user_invalid_store_returns_error()
    {
        $this->fail();
    }

    public function test_user_show_successful()
    {
        $this->fail();
    }

    public function test_user_show_not_found()
    {
        $this->fail();
    }

    public function test_user_update_successful()
    {
        $this->fail();
    }

    public function test_user_invalid_update_returns_error()
    {
        $this->fail();
    }

    public function test_user_delete_successful()
    {
        $this->fail();
    }

    public function test_user_delete_restricted_by_policy()
    {
        $this->fail();
    }
}
