<?php

namespace MiniBlog\BoundedContext\Backend\Infrastructure\Controllers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use MiniBlog\BoundedContext\Shared\Application\Actions\Permission\PermissionCreator;
use MiniBlog\BoundedContext\Shared\Application\Actions\Permission\PermissionDestroyer;
use MiniBlog\BoundedContext\Shared\Application\Actions\Permission\PermissionFinder;
use MiniBlog\BoundedContext\Shared\Application\Actions\Permission\PermissionUpdater;
use MiniBlog\BoundedContext\Shared\Infrastructure\Requests\StorePermissionRequest;
use MiniBlog\BoundedContext\Shared\Infrastructure\Requests\UpdatePermissionRequest;
use Symfony\Component\HttpFoundation\Response;

class PermissionController extends Controller
{
    public function index()
    {
        //abort_if(Gate::denies('permission_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        //PermissionFinder::all();
    }

    public function store(StorePermissionRequest $request)
    {
        //abort_if(Gate::denies('permission_store'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        //PermissionCreator::create();
    }

    public function show(int $id)
    {
        //abort_if(Gate::denies('permission_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        //PermissionFinder::find($id);
    }

    public function update(UpdatePermissionRequest $request, int $id)
    {
        //abort_if(Gate::denies('permission_update'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        //PermissionUpdater::update();
    }

    public function destroy(int $id)
    {
        //abort_if(Gate::denies('permission_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        //PermissionDestroyer::destroy($id);

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
