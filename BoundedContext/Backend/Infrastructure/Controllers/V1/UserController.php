<?php

namespace MiniBlog\BoundedContext\Backend\Infrastructure\Controllers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use MiniBlog\BoundedContext\Backend\Infrastructure\Resources\UserCollection;
use MiniBlog\BoundedContext\Backend\Infrastructure\Resources\UserResource;
use MiniBlog\BoundedContext\Shared\Application\Actions\User\UserCreator;
use MiniBlog\BoundedContext\Shared\Application\Actions\User\UserDestroyer;
use MiniBlog\BoundedContext\Shared\Application\Actions\User\UserFinder;
use MiniBlog\BoundedContext\Shared\Application\Actions\User\UserUpdater;
use MiniBlog\BoundedContext\Shared\Domain\DataTransferObjects\UserDto;
use MiniBlog\BoundedContext\Shared\Infrastructure\Requests\StoreUserRequest;
use MiniBlog\BoundedContext\Shared\Infrastructure\Requests\UpdateUserRequest;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function index()
    {
        //abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new UserCollection(
            collect(UserFinder::all())->map(function ($user) {
                return new UserResource((object) $user);
            })
        );
    }

    public function store(StoreUserRequest $request)
    {
        //abort_if(Gate::denies('user_store'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new UserResource(
            UserCreator::create(new UserDto($request->all()))
        );
    }

    public function show(int $id)
    {
        //abort_if(Gate::denies('user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new UserResource(
            UserFinder::find($id)
        );
    }

    public function update(UpdateUserRequest $request, int $id)
    {
        //abort_if(Gate::denies('user_update'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new UserResource(
            UserUpdater::update(
                new UserDto($request->all()),
                $id
            )
        );
    }

    public function destroy(int $id)
    {
        //abort_if(Gate::denies('user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        UserDestroyer::destroy($id);

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
