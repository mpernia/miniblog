<?php

namespace MiniBlog\Tests\Feature\Backend;

use Tests\TestCase;

class CategoryTest extends TestCase
{
    public function test_unauthenticated_user_cannot_access_to_category()
    {
        $response = $this->getJson('/api/v1/categories/1');
        $response->assertUnauthorized();
    }

    public function test_returns_categories_list()
    {
        $this->fail();
    }

    public function test_category_store_successful()
    {
        $this->fail();
    }

    public function test_category_invalid_store_returns_error()
    {
        $this->fail();
    }

    public function test_category_show_successful()
    {
        $this->fail();
    }

    public function test_category_show_not_found()
    {
        $this->fail();
    }

    public function test_category_update_successful()
    {
        $this->fail();
    }

    public function test_category_invalid_update_returns_error()
    {
        $this->fail();
    }

    public function test_category_delete_successful()
    {
        $this->fail();
    }

    public function test_category_delete_restricted_by_policy()
    {
        $this->fail();
    }
}
