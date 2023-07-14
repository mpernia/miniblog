<?php

namespace MiniBlog\Tests\Feature\Backend;

use Tests\TestCase;

class PostTest extends TestCase
{
    public function test_unauthenticated_user_cannot_access_to_post()
    {
        $response = $this->getJson('/api/v1/posts/1');
        $response->assertUnauthorized();
    }

    public function test_returns_posts_list()
    {
        $this->fail();
    }

    public function test_post_store_successful()
    {
        $this->fail();
    }

    public function test_post_invalid_store_returns_error()
    {
        $this->fail();
    }

    public function test_post_show_successful()
    {
        $this->fail();
    }

    public function test_post_show_not_found()
    {
        $this->fail();
    }

    public function test_post_update_successful()
    {
        $this->fail();
    }

    public function test_post_invalid_update_returns_error()
    {
        $this->fail();
    }

    public function test_post_delete_successful()
    {
        $this->fail();
    }

    public function test_post_delete_restricted_by_policy()
    {
        $this->fail();
    }
}
