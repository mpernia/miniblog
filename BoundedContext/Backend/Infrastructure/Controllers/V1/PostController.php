<?php

namespace MiniBlog\BoundedContext\Backend\Infrastructure\Controllers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use MiniBlog\BoundedContext\Shared\Application\Actions\Posts\PostCreator;
use MiniBlog\BoundedContext\Shared\Application\Actions\Posts\PostDestroyer;
use MiniBlog\BoundedContext\Shared\Application\Actions\Posts\PostFinder;
use MiniBlog\BoundedContext\Shared\Application\Actions\Posts\PostUpdater;
use MiniBlog\BoundedContext\Shared\Infrastructure\Requests\StorePostRequest;
use MiniBlog\BoundedContext\Shared\Infrastructure\Requests\UpdatePostRequest;
use Symfony\Component\HttpFoundation\Response;

class PostController extends Controller
{
    public function index()
    {
        //abort_if(Gate::denies('post_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        //PostFinder::all();
    }

    public function store(StorePostRequest $request)
    {
        //abort_if(Gate::denies('post_store'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        //PostCreator::create();
    }

    public function show(int $id)
    {
        //abort_if(Gate::denies('post_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        //PostFinder::find($id);
    }

    public function update(UpdatePostRequest $request, int $id)
    {
        //abort_if(Gate::denies('post_update'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        //PostUpdater::update();
    }

    public function destroy(int $id)
    {
        //abort_if(Gate::denies('post_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        //PostDestroyer::destroy($id);

        return response(null, Response::HTTP_NO_CONTENT);
    }
}