<?php

namespace MiniBlog\BoundedContext\Backend\Infrastructure\Controllers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use MiniBlog\BoundedContext\Shared\Application\Actions\Categories\CategoryCreator;
use MiniBlog\BoundedContext\Shared\Application\Actions\Categories\CategoryDestroyer;
use MiniBlog\BoundedContext\Shared\Application\Actions\Categories\CategoryFinder;
use MiniBlog\BoundedContext\Shared\Application\Actions\Categories\CategoryUpdater;
use MiniBlog\BoundedContext\Shared\Infrastructure\Requests\StoreCategoryRequest;
use MiniBlog\BoundedContext\Shared\Infrastructure\Requests\UpdateCategoryRequest;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{
    public function index()
    {
        //abort_if(Gate::denies('category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        //CategoryFinder::all();
    }

    public function store(StoreCategoryRequest $request)
    {
        //abort_if(Gate::denies('category_store'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        //CategoryCreator::create();
    }

    public function show(int $id)
    {
        //abort_if(Gate::denies('category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        //CategoryFinder::find($id);
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