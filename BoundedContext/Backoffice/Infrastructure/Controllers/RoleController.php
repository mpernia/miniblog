<?php

namespace MiniBlog\BoundedContext\Backoffice\Infrastructure\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use MiniBlog\BoundedContext\Shared\Application\Actions\Permission\PermissionFinder;
use MiniBlog\BoundedContext\Shared\Application\Actions\Role\RoleCreator;
use MiniBlog\BoundedContext\Shared\Application\Actions\Role\RoleDestroyer;
use MiniBlog\BoundedContext\Shared\Application\Actions\Role\RoleFinder;
use MiniBlog\BoundedContext\Shared\Application\Actions\Role\RoleUpdater;
use MiniBlog\BoundedContext\Shared\Infrastructure\Requests\StoreRoleRequest;
use MiniBlog\BoundedContext\Shared\Infrastructure\Requests\UpdateRoleRequest;
use MiniBlog\Shared\Infrastructure\Persistences\Models\Permission;
use MiniBlog\Shared\Infrastructure\Persistences\Models\Role;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        //abort_if(Gate::denies('role_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        //RoleFinder::all();
        if ($request->ajax()) {
            $query = Role::with(['permissions'])->select(sprintf('%s.*', (new Role)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'role_show';
                $editGate      = 'role_edit';
                $deleteGate    = 'role_delete';
                $crudRoutePart = 'roles';

                return view('partials.backoffice.actions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('title', function ($row) {
                return $row->title ? $row->title : '';
            });
            $table->editColumn('permissions', function ($row) {
                $labels = [];
                foreach ($row->permissions as $permission) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $permission->description);
                }

                return implode(' ', $labels);
            });

            $table->rawColumns(['actions', 'placeholder', 'permissions']);

            return $table->make(true);
        }
        return view('backoffice.role.index');
    }

    public function create()
    {
        //abort_if(Gate::denies('role_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        //PermissionFinder::all();
        $permissions = Permission::orderBy('description')->pluck('description', 'id');

        return view('backoffice.role.create', compact('permissions'));
    }

    public function store(StoreRoleRequest $request)
    {
        //abort_if(Gate::denies('role_store'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        //RoleCreator::create();
    }

    public function edit(int $id)
    {
        //abort_if(Gate::denies('role_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        //PermissionFinder::all();
        $permissions = Permission::pluck('description', 'id');
        $role = Role::find($id);
        return view('backoffice.role.edit', compact('role', 'permissions'));
    }

    public function show(int $id)
    {
        //abort_if(Gate::denies('role_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        //RoleFinder::find($id);
        $role = Role::find($id);
        return view('backoffice.role.show', compact('role'));
    }

    public function update(UpdateRoleRequest $request, int $id)
    {
        //abort_if(Gate::denies('role_update'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        //RoleUpdater::update();
    }

    public function destroy(int $id)
    {
        //abort_if(Gate::denies('role_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        //RoleDestroyer::destroy($id);

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
