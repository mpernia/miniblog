<?php

namespace MiniBlog\Tests\Feature\Backoffice;

use Tests\TestCase;

class DashboardTest extends TestCase
{
    public function test_unauthenticated_user_cannot_access_to_dashboard()
    {
        $this->fail();
    }

    public function test_login_redirects_to_dashboard()
    {
        $this->fail();
    }
}
