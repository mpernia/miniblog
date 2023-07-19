<?php

namespace MiniBlog\BoundedContext\Backend\Infrastructure\Controllers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use MiniBlog\BoundedContext\Backend\Infrastructure\Resources\RoleCollection;
use MiniBlog\BoundedContext\Backend\Infrastructure\Resources\RoleResource;
use MiniBlog\BoundedContext\Shared\Application\Actions\Role\RoleCreator;
use MiniBlog\BoundedContext\Shared\Application\Actions\Role\RoleDestroyer;
use MiniBlog\BoundedContext\Shared\Application\Actions\Role\RoleFinder;
use MiniBlog\BoundedContext\Shared\Application\Actions\Role\RoleUpdater;
use MiniBlog\BoundedContext\Shared\Domain\DataTransferObjects\RoleDto;
use MiniBlog\BoundedContext\Shared\Infrastructure\Requests\StoreRoleRequest;
use MiniBlog\BoundedContext\Shared\Infrastructure\Requests\UpdateRoleRequest;
use Symfony\Component\HttpFoundation\Response;

class RoleController extends Controller
{
    public function index()
    {
        //abort_if(Gate::denies('role_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new RoleCollection(
            collect(RoleFinder::all())->map(function ($role) {
                return new RoleResource((object) $role);
            })
        );
    }

    public function store(StoreRoleRequest $request)
    {
        //abort_if(Gate::denies('role_store'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new RoleResource(
            RoleCreator::create(new RoleDto($request->all()))
        );
    }

    public function show(int $id)
    {
        //abort_if(Gate::denies('role_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new RoleResource(
            RoleFinder::find($id)
        );
    }

    public function update(UpdateRoleRequest $request, int $id)
    {
        //abort_if(Gate::denies('role_update'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new RoleResource(
            RoleUpdater::update(
                new RoleDto($request->all()),
                $id
            )
        );
    }

    public function destroy(int $id)
    {
        //abort_if(Gate::denies('role_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        RoleDestroyer::destroy($id);

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
