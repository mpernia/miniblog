<?php

namespace MiniBlog\BoundedContext\Backend\Infrastructure\Controllers\V1\Backoffice;

use App\Http\Controllers\Controller;
use MiniBlog\BoundedContext\Backend\Infrastructure\Controllers\BackendController;
use MiniBlog\BoundedContext\Backend\Infrastructure\Resources\RoleCollection;
use MiniBlog\BoundedContext\Backend\Infrastructure\Resources\RoleResource;
use MiniBlog\BoundedContext\Shared\Application\Actions\Role\RoleCreator;
use MiniBlog\BoundedContext\Shared\Application\Actions\Role\RoleDestroyer;
use MiniBlog\BoundedContext\Shared\Application\Actions\Role\RoleFinder;
use MiniBlog\BoundedContext\Shared\Application\Actions\Role\RoleUpdater;
use MiniBlog\BoundedContext\Shared\Domain\DataTransferObjects\RoleDto;
use MiniBlog\BoundedContext\Shared\Infrastructure\Requests\StoreRoleRequest;
use MiniBlog\BoundedContext\Shared\Infrastructure\Requests\UpdateRoleRequest;
use Symfony\Component\HttpFoundation\Response;

class RoleController extends BackendController
{
    /**
     * Display a listing of the resource.
     * @return RoleCollection
     *
     * @OA\Get(
     *     path="/backoffice/roles",
     *     operationId="getRolesList",
     *     tags={"Backoffice/Roles"},
     *     summary="Get list of roles",
     *     description="Returns list of the roles",
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
        //abort_if(Gate::denies('role_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new RoleCollection(
            collect(RoleFinder::all())->map(function ($role) {
                return new RoleResource((object) $role);
            })
        );
    }

    /**
     * @OA\Post(
     *      path="/backoffice/roles",
     *      operationId="storeRole",
     *      tags={"Backoffice/Roles"},
     *      summary="Store new role",
     *      description="Returns role data",
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
    public function store(StoreRoleRequest $request)
    {
        //abort_if(Gate::denies('role_store'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new RoleResource(
            RoleCreator::create(new RoleDto($request->all()))
        );
    }

    /**
     * @param  int  $id
     * @return RoleResource
     * @OA\Get(
     *      path="/backoffice/roles/{id}",
     *      operationId="getRoleById",
     *      tags={"Backoffice/Roles"},
     *      summary="Get role information",
     *      description="Returns role data",
     *      security={{"sanctum":{}}},
     *      @OA\Parameter(
     *          name="id",
     *          description="Role id",
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
        //abort_if(Gate::denies('role_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new RoleResource(
            RoleFinder::find($id)
        );
    }

    /**
     * @param  int  $id
     * @param UpdateRoleRequest $request
     * @return RoleResource
     * @OA\Put(
     *      path="/backoffice/roles/{id}",
     *      operationId="updateRole",
     *      tags={"Backoffice/Roles"},
     *      summary="Update existing role",
     *      description="Returns updated role data",
     *      security={{"sanctum":{}}},
     *      @OA\Parameter(
     *          name="id",
     *          description="Role id",
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
    public function update(UpdateRoleRequest $request, int $id)
    {
        //abort_if(Gate::denies('role_update'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new RoleResource(
            RoleUpdater::update(
                new RoleDto($request->all()),
                $id
            )
        );
    }

    /**
     * @OA\Delete(
     *      path="/backoffice/roles/{id}",
     *      operationId="deleteRole",
     *      tags={"Backoffice/Roles"},
     *      summary="Delete existing role",
     *      description="Deletes a record and returns no content",
     *      security={{"sanctum":{}}},
     *      @OA\Parameter(
     *          name="id",
     *          description="Role id",
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
        //abort_if(Gate::denies('role_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        RoleDestroyer::destroy($id);

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
