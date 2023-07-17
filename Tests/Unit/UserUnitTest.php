<?php

namespace MiniBlog\Tests\Unit;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use MiniBlog\BoundedContext\Shared\Application\Actions\User\UserCreator;
use MiniBlog\BoundedContext\Shared\Application\Actions\User\UserDestroyer;
use MiniBlog\BoundedContext\Shared\Application\Actions\User\UserFinder;
use MiniBlog\BoundedContext\Shared\Application\Actions\User\UserUpdater;
use MiniBlog\BoundedContext\Shared\Domain\DataTransferObjects\UserDto;
use MiniBlog\Tests\BaseTestCase;
use MiniBlog\Tests\Factories\UserFactory;

class UserUnitTest extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    public function test_user_creator_successful()
    {
        $user = UserCreator::create(UserFactory::create());
        $this->assertDatabaseHas('users', [
            'name' => $user->name,
            'email' => $user->email,
        ]);
    }

    public function test_user_creator_returns_error()
    {
        $this->expectException(QueryException::class);
        UserCreator::create(new UserDto([]));
        $this->expectExceptionCode(23000);
    }

    public function test_user_updater_successful()
    {
        $currentUser = UserCreator::create(UserFactory::create());
        $newUser = UserUpdater::update(UserFactory::create(), $currentUser->id);
        $this->assertEquals($currentUser->id, $newUser->id);
        $this->assertDatabaseHas('users', [
            'name' => $newUser->name,
            'email' => $newUser->email,
        ]);
    }

    public function test_user_updater_returns_error()
    {
        $this->expectException(QueryException::class);
        $currentUser = UserCreator::create(UserFactory::create());
        UserUpdater::update(new UserDto([]), $currentUser->id);
        $this->expectExceptionCode(23000);
    }

    public function test_user_destroyer_successful()
    {
        $user = UserCreator::create(UserFactory::create());
        UserDestroyer::destroy($user->id);
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }

    public function test_user_destroyer_returns_error()
    {
        $this->expectException(ModelNotFoundException::class);
        UserDestroyer::destroy(9999);
    }

    public function test_user_finder_all()
    {
        $users = UserFactory::create(5);
        foreach ($users as $user) {
            UserCreator::create($user);
        }
        $result = UserFinder::all();
        $this->assertNotEmpty($result);
    }

    public function test_user_finder_successful()
    {
        $list = [];
        $users = UserFactory::create(5);
        foreach ($users as $user) {
            $list[] = UserCreator::create($user);
        }
        $target = $list[rand(1, 5)];
        $this->assertEquals($target, UserFinder::find($target->id));
    }

    public function test_user_finder_returns_error()
    {
        $this->expectException(ModelNotFoundException::class);
        UserFinder::find(9999);
    }
}
