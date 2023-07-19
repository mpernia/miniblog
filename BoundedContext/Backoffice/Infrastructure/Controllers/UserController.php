<?php

namespace MiniBlog\BoundedContext\Backoffice\Infrastructure\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use MiniBlog\BoundedContext\Backoffice\Application\Actions\User\UserDataTable;
use MiniBlog\BoundedContext\Shared\Application\Actions\Role\RoleLister;
use MiniBlog\BoundedContext\Shared\Application\Actions\User\UserCreator;
use MiniBlog\BoundedContext\Shared\Application\Actions\User\UserDestroyer;
use MiniBlog\BoundedContext\Shared\Application\Actions\User\UserFinder;
use MiniBlog\BoundedContext\Shared\Application\Actions\User\UserUpdater;
use MiniBlog\BoundedContext\Shared\Domain\DataTransferObjects\UserDto;
use MiniBlog\BoundedContext\Shared\Infrastructure\Requests\StoreUserRequest;
use MiniBlog\BoundedContext\Shared\Infrastructure\Requests\UpdateUserRequest;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index(Request $request)
    {
        //abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $table = Datatables::of(UserDataTable::source());

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'user_show';
                $editGate      = 'user_edit';
                $deleteGate    = 'user_delete';
                $crudRoutePart = 'users';

                return view('partials.backoffice.actions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('name', function ($row) {
                return $row->name ?? '';
            });
            $table->editColumn('email', function ($row) {
                return $row->email ?? '';
            });

            $table->editColumn('roles', function ($row) {
                $labels = [];
                foreach ($row->roles as $role) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $role->title);
                }

                return implode(' ', $labels);
            });

            $table->rawColumns(['actions', 'placeholder', 'roles']);

            return $table->make(true);
        }
        return view('backoffice.user.index');
    }

    public function create()
    {
        //abort_if(Gate::denies('user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = RoleLister::list();

        return view('backoffice.user.create', compact('roles'));
    }

    public function store(StoreUserRequest $request)
    {
        //abort_if(Gate::denies('user_store'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        UserCreator::create(
            new UserDto($request->all())
        );
    }

    public function edit(int $id)
    {
        //abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = RoleLister::list();
        $user = UserFinder::find($id);

        return view('backoffice.user.edit', compact('roles', 'user'));
    }

    public function show(int $id)
    {
        //abort_if(Gate::denies('user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user = UserFinder::find($id);

        return view('backoffice.user.show', compact('user'));
    }

    public function update(UpdateUserRequest $request, int $id)
    {
        //abort_if(Gate::denies('user_update'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        UserUpdater::update(
            new UserDto($request->all()),
            $id
        );
    }

    public function destroy(int $id)
    {
        //abort_if(Gate::denies('user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        UserDestroyer::destroy($id);

        return back();
    }
}
