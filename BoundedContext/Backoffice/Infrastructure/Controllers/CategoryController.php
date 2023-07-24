<?php

namespace MiniBlog\BoundedContext\Backoffice\Infrastructure\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use MiniBlog\BoundedContext\Backoffice\Application\Actions\Category\CategoryDataTable;
use MiniBlog\BoundedContext\Backoffice\Application\Actions\Category\CategoryLister;
use MiniBlog\BoundedContext\Shared\Application\Actions\Categories\CategoryCreator;
use MiniBlog\BoundedContext\Shared\Application\Actions\Categories\CategoryDestroyer;
use MiniBlog\BoundedContext\Shared\Application\Actions\Categories\CategoryFinder;
use MiniBlog\BoundedContext\Shared\Application\Actions\Categories\CategoryUpdater;
use MiniBlog\BoundedContext\Shared\Domain\DataTransferObjects\CategoryDto;
use MiniBlog\BoundedContext\Shared\Infrastructure\Requests\StoreCategoryRequest;
use MiniBlog\BoundedContext\Shared\Infrastructure\Requests\UpdateCategoryRequest;
use MiniBlog\Shared\Infrastructure\Persistences\Models\Category;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        //abort_if(Gate::denies('category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $table = Datatables::of(CategoryDataTable::source());

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
            $table->addColumn('parent_name', function ($row) {
                return $row->parent ? $row->parent->name : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        $categories = CategoryLister::list();

        return view('backoffice.category.index', compact('categories'));
    }

    public function create()
    {
        //abort_if(Gate::denies('category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $parents = CategoryLister::list()->prepend(trans('global.pleaseSelect'), '');

        return view('backoffice.category.create', compact('parents'));
    }

    public function store(StoreCategoryRequest $request)
    {
        //abort_if(Gate::denies('category_store'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        CategoryCreator::create(
            new CategoryDto($request->all())
        );

        return redirect()->route('backoffice.categories.index');
    }

    public function edit(int $id)
    {
        //abort_if(Gate::denies('category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $category = CategoryFinder::find($id);
        $parents = CategoryLister::list()->prepend(trans('global.pleaseSelect'), '');

        return view('backoffice.category.edit', compact('category', 'parents'));
    }

    public function show(int $id)
    {
        //abort_if(Gate::denies('category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $category = CategoryFinder::find($id);

        return view('backoffice.category.show', compact('category'));
    }

    public function update(UpdateCategoryRequest $request, int $id)
    {
        //abort_if(Gate::denies('category_update'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        CategoryUpdater::update(
            new CategoryDto($request->all()), $id
        );

        return redirect()->route('backoffice.categories.index');
    }

    public function destroy(int $id)
    {
        //abort_if(Gate::denies('category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        CategoryDestroyer::destroy($id);

        return back();
    }
}
