<?php

namespace MiniBlog\BoundedContext\Backend\Infrastructure\Controllers\V1\Backoffice;

use App\Http\Controllers\Controller;
use MiniBlog\BoundedContext\Backend\Infrastructure\Controllers\BackendController;
use MiniBlog\BoundedContext\Backend\Infrastructure\Resources\PostCollection;
use MiniBlog\BoundedContext\Backend\Infrastructure\Resources\PostResource;
use MiniBlog\BoundedContext\Shared\Application\Actions\Posts\PostCreator;
use MiniBlog\BoundedContext\Shared\Application\Actions\Posts\PostDestroyer;
use MiniBlog\BoundedContext\Shared\Application\Actions\Posts\PostFinder;
use MiniBlog\BoundedContext\Shared\Application\Actions\Posts\PostUpdater;
use MiniBlog\BoundedContext\Shared\Domain\DataTransferObjects\PostDto;
use MiniBlog\BoundedContext\Shared\Infrastructure\Requests\StorePostRequest;
use MiniBlog\BoundedContext\Shared\Infrastructure\Requests\UpdatePostRequest;
use Symfony\Component\HttpFoundation\Response;

class PostController extends BackendController
{
    /**
     * Display a listing of the resource.
     * @return PostCollection
     *
     * @OA\Get(
     *     path="/backoffice/posts",
     *     operationId="getPostsList",
     *     tags={"Backoffice/Posts"},
     *     summary="Get list of posts",
     *     description="Returns list of the posts",
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
        //abort_if(Gate::denies('post_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PostCollection(
            collect(PostFinder::all())->map(function ($post) {
                return new PostResource((object) $post);
            })
        );
    }

    /**
     * @OA\Post(
     *      path="/backoffice/posts",
     *      operationId="storePost",
     *      tags={"Backoffice/Posts"},
     *      summary="Store new post",
     *      description="Returns post data",
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
    public function store(StorePostRequest $request)
    {
        //abort_if(Gate::denies('post_store'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PostResource(
            PostCreator::create(new PostDto($request->all()))
        );
    }

    /**
     * @param  int  $id
     * @return PostResource
     * @OA\Get(
     *      path="/backoffice/posts/{id}",
     *      operationId="getPostById",
     *      tags={"Backoffice/Posts"},
     *      summary="Get post information",
     *      description="Returns post data",
     *      security={{"sanctum":{}}},
     *      @OA\Parameter(
     *          name="id",
     *          description="Post id",
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
        //abort_if(Gate::denies('post_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PostResource(
            PostFinder::find($id)
        );
    }

    /**
     * @param  int  $id
     * @param UpdatePostRequest $request
     * @return PostResource
     * @OA\Put(
     *      path="/backoffice/posts/{id}",
     *      operationId="updatePost",
     *      tags={"Backoffice/Posts"},
     *      summary="Update existing post",
     *      description="Returns updated post data",
     *      security={{"sanctum":{}}},
     *      @OA\Parameter(
     *          name="id",
     *          description="Post id",
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
    public function update(UpdatePostRequest $request, int $id)
    {
        //abort_if(Gate::denies('post_update'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PostResource(
            PostUpdater::update(
                new PostDto($request->all()),
                $id
            )
        );
    }

    /**
     * @OA\Delete(
     *      path="/backoffice/posts/{id}",
     *      operationId="deletePost",
     *      tags={"Backoffice/Posts"},
     *      summary="Delete existing post",
     *      description="Deletes a record and returns no content",
     *      security={{"sanctum":{}}},
     *      @OA\Parameter(
     *          name="id",
     *          description="Post id",
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
        //abort_if(Gate::denies('post_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        PostDestroyer::destroy($id);

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
