<?php

namespace MiniBlog\BoundedContext\Backend\Infrastructure\Controllers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use MiniBlog\BoundedContext\Backend\Infrastructure\Resources\TagCollection;
use MiniBlog\BoundedContext\Backend\Infrastructure\Resources\TagResource;
use MiniBlog\BoundedContext\Shared\Application\Actions\Tags\TagCreator;
use MiniBlog\BoundedContext\Shared\Application\Actions\Tags\TagDestroyer;
use MiniBlog\BoundedContext\Shared\Application\Actions\Tags\TagFinder;
use MiniBlog\BoundedContext\Shared\Application\Actions\Tags\TagUpdater;
use MiniBlog\BoundedContext\Shared\Domain\DataTransferObjects\TagDto;
use MiniBlog\BoundedContext\Shared\Infrastructure\Requests\StoreTagRequest;
use MiniBlog\BoundedContext\Shared\Infrastructure\Requests\UpdateTagRequest;
use Symfony\Component\HttpFoundation\Response;

class TagController extends Controller
{
    public function index()
    {
        //abort_if(Gate::denies('tag_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TagCollection(
            collect(TagFinder::all())->map(function ($tag) {
                return new TagResource((object) $tag);
            })
        );
    }

    public function store(StoreTagRequest $request)
    {
        //abort_if(Gate::denies('tag_store'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TagResource(
            TagCreator::create(new TagDto($request->all()))
        );
    }

    public function show(int $id)
    {
        //abort_if(Gate::denies('tag_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TagResource(
            TagFinder::find($id)
        );
    }

    public function update(UpdateTagRequest $request, int $id)
    {
        //abort_if(Gate::denies('tag_update'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TagResource(
            TagUpdater::update(
                new TagDto($request->all()),
                $id
            )
        );
    }

    public function destroy(int $id)
    {
        //abort_if(Gate::denies('tag_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        TagDestroyer::destroy($id);

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
