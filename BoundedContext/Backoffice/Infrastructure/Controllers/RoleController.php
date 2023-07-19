<?php

namespace MiniBlog\BoundedContext\Backoffice\Infrastructure\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use MiniBlog\BoundedContext\Backoffice\Application\Actions\Role\RoleDataTable;
use MiniBlog\BoundedContext\Shared\Application\Actions\Permission\PermissionLister;
use MiniBlog\BoundedContext\Shared\Application\Actions\Role\RoleCreator;
use MiniBlog\BoundedContext\Shared\Application\Actions\Role\RoleDestroyer;
use MiniBlog\BoundedContext\Shared\Application\Actions\Role\RoleFinder;
use MiniBlog\BoundedContext\Shared\Application\Actions\Role\RoleUpdater;
use MiniBlog\BoundedContext\Shared\Domain\DataTransferObjects\RoleDto;
use MiniBlog\BoundedContext\Shared\Infrastructure\Requests\StoreRoleRequest;
use MiniBlog\BoundedContext\Shared\Infrastructure\Requests\UpdateRoleRequest;
use Yajra\DataTables\Facades\DataTables;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        //abort_if(Gate::denies('role_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $table = Datatables::of(RoleDataTable::source());

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

        $permissions = PermissionLister::list();

        return view('backoffice.role.create', compact('permissions'));
    }

    public function store(StoreRoleRequest $request)
    {
        //abort_if(Gate::denies('role_store'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        RoleCreator::create(
            new RoleDto($request->all())
        );

        return redirect()->route('backoffice.roles.index');
    }

    public function edit(int $id)
    {
        //abort_if(Gate::denies('role_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $permissions = PermissionLister::list();

        $role = RoleFinder::find($id);

        return view('backoffice.role.edit', compact('role', 'permissions'));
    }

    public function show(int $id)
    {
        //abort_if(Gate::denies('role_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        //RoleFinder::find($id);
        $role = RoleFinder::find($id);

        return view('backoffice.role.show', compact('role'));
    }

    public function update(UpdateRoleRequest $request, int $id)
    {
        //abort_if(Gate::denies('role_update'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        RoleUpdater::update(
            new RoleDto($request->all()),
            $id
        );

        return redirect()->route('backoffice.roles.index');
    }

    public function destroy(int $id)
    {
        //abort_if(Gate::denies('role_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        RoleDestroyer::destroy($id);

        return back();
    }
}
