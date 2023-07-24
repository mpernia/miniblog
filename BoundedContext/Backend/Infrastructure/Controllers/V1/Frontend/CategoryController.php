<?php

namespace MiniBlog\BoundedContext\Backend\Infrastructure\Controllers\V1\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use MiniBlog\BoundedContext\Backend\Infrastructure\Controllers\BackendController;
use MiniBlog\BoundedContext\Backend\Infrastructure\Resources\CategoryCollection;
use MiniBlog\BoundedContext\Backend\Infrastructure\Resources\CategoryResource;
use MiniBlog\BoundedContext\Shared\Application\Actions\Categories\CategoryCreator;
use MiniBlog\BoundedContext\Shared\Application\Actions\Categories\CategoryDestroyer;
use MiniBlog\BoundedContext\Shared\Application\Actions\Categories\CategoryFinder;
use MiniBlog\BoundedContext\Shared\Application\Actions\Categories\CategoryUpdater;
use MiniBlog\BoundedContext\Shared\Domain\DataTransferObjects\CategoryDto;
use MiniBlog\BoundedContext\Shared\Infrastructure\Requests\StoreCategoryRequest;
use MiniBlog\BoundedContext\Shared\Infrastructure\Requests\UpdateCategoryRequest;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends BackendController
{

    /**
     * Display a listing of the resource.
     * @return CategoryCollection
     *
     * @OA\Get(
     *     path="/frontend/categories",
     *     operationId="getFrontendCategoriesList",
     *     tags={"Frontend/Categories"},
     *     summary="Get list of categories",
     *     description="Returns list of the categories",
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
    public function index(): CategoryCollection
    {
        return new CategoryCollection(
            collect(CategoryFinder::all())->map(function ($category) {
                return new CategoryResource((object) $category);
            })
        );
    }

    /**
     * @param  int  $id
     * @return CategoryResource
     * @OA\Get(
     *      path="/frontend/categories/{id}",
     *      operationId="getFrontendCategoryById",
     *      tags={"Frontend/Categories"},
     *      summary="Get category information",
     *      description="Returns category data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Category id",
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
    public function show(int $id): CategoryResource
    {
        return new CategoryResource(
            CategoryFinder::find($id)
        );
    }
}
