<?php

namespace MiniBlog\Tests\Unit;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use MiniBlog\BoundedContext\Shared\Application\Actions\Role\RoleFinder;
use MiniBlog\BoundedContext\Shared\Domain\DataTransferObjects\RoleDto;
use MiniBlog\Tests\BaseTestCase;

class RoleUnitTest extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    public function test_role_finder_all()
    {
        $result = RoleFinder::all();
        $this->assertNotEmpty($result);
    }

    public function test_role_finder_successful()
    {
        $role = new RoleDto(['id' => 1, 'title' => 'Admin']);
        $this->assertEquals($role, RoleFinder::find($role->id));
    }

    public function test_role_finder_returns_error()
    {
        $this->expectException(ModelNotFoundException::class);
        RoleFinder::find(9999);
    }
}
