<?php

namespace MiniBlog\BoundedContext\Backoffice\Infrastructure\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use MiniBlog\BoundedContext\Shared\Application\Actions\Categories\CategoryCreator;
use MiniBlog\BoundedContext\Shared\Application\Actions\Categories\CategoryDestroyer;
use MiniBlog\BoundedContext\Shared\Application\Actions\Categories\CategoryFinder;
use MiniBlog\BoundedContext\Shared\Application\Actions\Categories\CategoryUpdater;
use MiniBlog\BoundedContext\Shared\Infrastructure\Requests\StoreCategoryRequest;
use MiniBlog\BoundedContext\Shared\Infrastructure\Requests\UpdateCategoryRequest;
use MiniBlog\Shared\Infrastructure\Persistences\Models\Category;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        //abort_if(Gate::denies('category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        //CategoryFinder::all();
        if ($request->ajax()) {
            $query = Category::query()->select(sprintf('%s.*', (new Category())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'category_show';
                $editGate = 'category_edit';
                $deleteGate = 'category_delete';
                $crudRoutePart = 'categories';

                return view('partials.backoffice.actions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('slug', function ($row) {
                return $row->slug ? $row->slug : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }
        return view('backoffice.category.index');
    }

    public function create()
    {
        //abort_if(Gate::denies('category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('backoffice.category.create');
    }

    public function store(StoreCategoryRequest $request)
    {
        //abort_if(Gate::denies('category_store'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        //CategoryCreator::create();
    }

    public function edit(int $id)
    {
        //abort_if(Gate::denies('category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        //CategoryFinder::find($id);
        $category = Category::find($id);
        return view('backoffice.category.edit', compact('category'));
    }

    public function show(int $id)
    {
        //abort_if(Gate::denies('category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        //CategoryFinder::find($id);
        $category = Category::find($id);
        return view('backoffice.category.show', compact('category'));
    }

    public function update(UpdateCategoryRequest $request, int $id)
    {
        //abort_if(Gate::denies('category_update'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        //CategoryUpdater::update();
    }

    public function destroy(int $id)
    {
        //abort_if(Gate::denies('category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        //CategoryDestroyer::destroy($id);

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
