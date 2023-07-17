<?php

namespace MiniBlog\Tests\Feature\Backend;

use Tests\TestCase;

class PermissionBackendTest extends TestCase
{
    public function test_unauthenticated_user_cannot_access_to_permission()
    {
        $response = $this->getJson('/api/v1/permissions/1');
        $response->assertUnauthorized();
    }

    public function test_returns_permissions_list()
    {
        $this->fail();
    }

    public function test_permission_store_successful()
    {
        $this->fail();
    }

    public function test_permission_invalid_store_returns_error()
    {
        $this->fail();
    }

    public function test_permission_show_successful()
    {
        $this->fail();
    }

    public function test_permission_show_not_found()
    {
        $this->fail();
    }

    public function test_permission_update_successful()
    {
        $this->fail();
    }

    public function test_permission_invalid_update_returns_error()
    {
        $this->fail();
    }

    public function test_permission_delete_successful()
    {
        $this->fail();
    }

    public function test_permission_delete_restricted_by_policy()
    {
        $this->fail();
    }
}
