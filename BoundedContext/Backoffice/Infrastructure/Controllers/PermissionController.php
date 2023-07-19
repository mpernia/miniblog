<?php

namespace MiniBlog\BoundedContext\Backoffice\Infrastructure\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use MiniBlog\BoundedContext\Shared\Application\Actions\Permission\PermissionFinder;
use MiniBlog\BoundedContext\Shared\Infrastructure\Requests\StorePermissionRequest;
use MiniBlog\BoundedContext\Shared\Infrastructure\Requests\UpdatePermissionRequest;
use MiniBlog\Shared\Infrastructure\Persistences\Models\Permission;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PermissionController extends Controller
{
    public function index(Request $request)
    {
        //abort_if(Gate::denies('permission_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Permission::query()->select(sprintf('%s.*', (new Permission)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'permission_show';
                $editGate      = 'permission_edit';
                $deleteGate    = 'permission_delete';
                $crudRoutePart = 'permissions';

                return view('partials.backoffice.datatablesActions', compact(
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
            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }
        return view('backoffice.permission.index');
    }

    public function create()
    {
        abort_if(Gate::denies('permission_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
    }

    public function store(StorePermissionRequest $request)
    {
        abort_if(Gate::denies('permission_store'), Response::HTTP_FORBIDDEN, '403 Forbidden');
    }

    public function edit(int $id)
    {
        abort_if(Gate::denies('permission_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
    }

    public function show(int $id)
    {
        //abort_if(Gate::denies('permission_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $permission = PermissionFinder::find($id);

        return view('backoffice.permission.show', compact('permission'));
    }

    public function update(UpdatePermissionRequest $request, int $id)
    {
        abort_if(Gate::denies('permission_update'), Response::HTTP_FORBIDDEN, '403 Forbidden');
    }

    public function destroy(int $id)
    {
        abort_if(Gate::denies('permission_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return back();
    }
}
