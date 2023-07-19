<?php

namespace MiniBlog\Tests\Unit;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Artisan;
use MiniBlog\BoundedContext\Shared\Application\Actions\Permission\PermissionFinder;
use MiniBlog\BoundedContext\Shared\Domain\DataTransferObjects\PermissionDto;
use MiniBlog\Tests\BaseTestCase;

class PermissionUnitTest extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    public function test_permission_finder_all()
    {
        $permissions = PermissionFinder::all();
        $this->assertNotEmpty($permissions);
    }

    public function test_permission_finder_successful()
    {
        $permission = new PermissionDto([
            'id' => 1,
            'title' => 'user_management_access',
            'description' => 'Full Management Access'
        ]);
        $this->assertEquals($permission, PermissionFinder::find($permission->id));
    }

    public function test_permission_finder_returns_error()
    {
        $this->expectException(ModelNotFoundException::class);
        PermissionFinder::find(9999);
    }
}
