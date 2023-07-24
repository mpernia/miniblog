<?php

namespace MiniBlog\BoundedContext\Backend\Infrastructure\Controllers\V1\Backoffice;

use App\Http\Controllers\Controller;
use MiniBlog\BoundedContext\Backend\Infrastructure\Controllers\BackendController;
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

class TagController extends BackendController
{
    /**
     * Display a listing of the resource.
     * @return TagCollection
     *
     * @OA\Get(
     *     path="/backoffice/tags",
     *     operationId="getTagsList",
     *     tags={"Backoffice/Tags"},
     *     summary="Get list of tags",
     *     description="Returns list of the tags",
     *     security={{"sanctum":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Ok"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized"
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Forbidden"
     *     )
     * )
     */
    public function index()
    {
        //abort_if(Gate::denies('tag_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TagCollection(
            collect(TagFinder::all())->map(function ($tag) {
                return new TagResource((object) $tag);
            })
        );
    }

    /**
     * @OA\Post(
     *      path="/backoffice/tags",
     *      operationId="storeTag",
     *      tags={"Backoffice/Tags"},
     *      summary="Store new tag",
     *      description="Returns tag data",
     *      security={{"sanctum":{}}},
     *      @OA\RequestBody(
     *          required=true
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation"
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     */
    public function store(StoreTagRequest $request)
    {
        //abort_if(Gate::denies('tag_store'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TagResource(
            TagCreator::create(new TagDto($request->all()))
        );
    }

    /**
     * @param  int  $id
     * @return TagResource
     * @OA\Get(
     *      path="/backoffice/tags/{id}",
     *      operationId="getTagById",
     *      tags={"Backoffice/Tags"},
     *      summary="Get tag information",
     *      description="Returns tag data",
     *      security={{"sanctum":{}}},
     *      @OA\Parameter(
     *          name="id",
     *          description="Tag id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation"
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     */
    public function show(int $id)
    {
        //abort_if(Gate::denies('tag_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TagResource(
            TagFinder::find($id)
        );
    }

    /**
     * @param  int  $id
     * @param UpdateTagRequest $request
     * @return TagResource
     * @OA\Put(
     *      path="/backoffice/tags/{id}",
     *      operationId="updateTag",
     *      tags={"Backoffice/Tags"},
     *      summary="Update existing tag",
     *      description="Returns updated tag data",
     *      security={{"sanctum":{}}},
     *      @OA\Parameter(
     *          name="id",
     *          description="Tag id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true
     *      ),
     *      @OA\Response(
     *          response=202,
     *          description="Successful operation"
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      )
     * )
     */
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

    /**
     * @OA\Delete(
     *      path="/backoffice/tags/{id}",
     *      operationId="deleteTag",
     *      tags={"Backoffice/Tags"},
     *      summary="Delete existing tag",
     *      description="Deletes a record and returns no content",
     *      security={{"sanctum":{}}},
     *      @OA\Parameter(
     *          name="id",
     *          description="Tag id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=204,
     *          description="Successful operation",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      )
     * )
     */
    public function destroy(int $id)
    {
        //abort_if(Gate::denies('tag_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        TagDestroyer::destroy($id);

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
