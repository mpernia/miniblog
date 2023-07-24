<?php

namespace MiniBlog\BoundedContext\Backend\Infrastructure\Controllers\V1\Frontend;

use Illuminate\Support\Facades\Gate;
use MiniBlog\BoundedContext\Backend\Infrastructure\Controllers\BackendController;
use MiniBlog\BoundedContext\Backend\Infrastructure\Resources\PostCollection;
use MiniBlog\BoundedContext\Backend\Infrastructure\Resources\PostResource;
use MiniBlog\BoundedContext\Shared\Application\Actions\Posts\PostFinder;
use Symfony\Component\HttpFoundation\Response;

class PostController extends BackendController
{
    /**
     * Display a listing of the resource.
     * @return PostCollection
     *
     * @OA\Get(
     *     path="/frontend/posts",
     *     operationId="getFrontendPostsList",
     *     tags={"Frontend/Posts"},
     *     summary="Get list of posts",
     *     description="Returns list of the posts",
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
    public function index() : PostCollection
    {
        return new PostCollection(
            collect(PostFinder::all())->map(function ($post) {
                return new PostResource((object) $post);
            })
        );
    }

    /**
     * @param  int  $id
     * @return PostResource
     * @OA\Get(
     *      path="/frontend/posts/{id}",
     *      operationId="getFrontendPostById",
     *      tags={"Frontend/Posts"},
     *      summary="Get post information",
     *      description="Returns post data",
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
    public function show(int $id): PostResource
    {
        return new PostResource(
            PostFinder::find($id)
        );
    }
}
