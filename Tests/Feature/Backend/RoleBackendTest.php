<?php

namespace MiniBlog\Tests\Feature\Backend;

use Tests\TestCase;

class RoleBackendTest extends TestCase
{
    public function test_unauthenticated_user_cannot_access_to_role()
    {
        $response = $this->getJson('/api/v1/roles/1');
        $response->assertUnauthorized();
    }

    public function test_returns_roles_list()
    {
        $this->fail();
    }

    public function test_role_store_successful()
    {
        $this->fail();
    }

    public function test_role_invalid_store_returns_error()
    {
        $this->fail();
    }

    public function test_role_show_successful()
    {
        $this->fail();
    }

    public function test_role_show_not_found()
    {
        $this->fail();
    }

    public function test_role_update_successful()
    {
        $this->fail();
    }

    public function test_role_invalid_update_returns_error()
    {
        $this->fail();
    }

    public function test_role_delete_successful()
    {
        $this->fail();
    }

    public function test_role_delete_restricted_by_policy()
    {
        $this->fail();
    }
}
