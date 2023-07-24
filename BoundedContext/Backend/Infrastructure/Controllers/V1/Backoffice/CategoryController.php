<?php

namespace MiniBlog\BoundedContext\Backend\Infrastructure\Controllers\V1\Backoffice;

use App\Http\Controllers\Controller;
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
     *     path="/backoffice/categories",
     *     operationId="getCategoriesList",
     *     tags={"Backoffice/Categories"},
     *     summary="Get list of categories",
     *     description="Returns list of the categories",
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
        //abort_if(Gate::denies('category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CategoryCollection(
            collect(CategoryFinder::all())->map(function ($category) {
                return new CategoryResource((object) $category);
            })
        );
    }

    /**
     * @OA\Post(
     *      path="/backoffice/categories",
     *      operationId="storeCategory",
     *      tags={"Backoffice/Categories"},
     *      summary="Store new category",
     *      description="Returns category data",
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
    public function store(StoreCategoryRequest $request)
    {
        //abort_if(Gate::denies('category_store'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CategoryResource(
            CategoryCreator::create(new CategoryDto($request->all()))
        );
    }

    /**
     * @param  int  $id
     * @return CategoryResource
     * @OA\Get(
     *      path="/backoffice/categories/{id}",
     *      operationId="getCategoryById",
     *      tags={"Backoffice/Categories"},
     *      summary="Get category information",
     *      description="Returns category data",
     *      security={{"sanctum":{}}},
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
    public function show(int $id)
    {
        //abort_if(Gate::denies('category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CategoryResource(
            CategoryFinder::find($id)
        );
    }

    /**
     * @param  int  $id
     * @param UpdateCategoryRequest $request
     * @return CategoryResource
     * @OA\Put(
     *      path="/backoffice/categories/{id}",
     *      operationId="updateCategory",
     *      tags={"Backoffice/Categories"},
     *      summary="Update existing category",
     *      description="Returns updated category data",
     *      security={{"sanctum":{}}},
     *      @OA\Parameter(
     *          name="id",
     *          description="Category id",
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
    public function update(UpdateCategoryRequest $request, int $id)
    {
        //abort_if(Gate::denies('category_update'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CategoryResource(
            CategoryUpdater::update(
                new CategoryDto($request->all()), $id
            )
        );
    }

    /**
     * @OA\Delete(
     *      path="/backoffice/categories/{id}",
     *      operationId="deleteCategory",
     *      tags={"Backoffice/Categories"},
     *      summary="Delete existing category",
     *      description="Deletes a record and returns no content",
     *      security={{"sanctum":{}}},
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
        //abort_if(Gate::denies('category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        CategoryDestroyer::destroy($id);

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
