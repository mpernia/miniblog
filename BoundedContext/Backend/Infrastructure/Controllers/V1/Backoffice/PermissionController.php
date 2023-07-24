<?php

namespace MiniBlog\BoundedContext\Backend\Infrastructure\Controllers\V1\Backoffice;

use MiniBlog\BoundedContext\Backend\Infrastructure\Controllers\BackendController;
use MiniBlog\BoundedContext\Backend\Infrastructure\Resources\PermissionCollection;
use MiniBlog\BoundedContext\Backend\Infrastructure\Resources\PermissionResource;
use MiniBlog\BoundedContext\Shared\Application\Actions\Permission\PermissionFinder;

class PermissionController extends BackendController
{
    /**
     * Display a listing of the resource.
     * @return PermissionCollection
     *
     * @OA\Get(
     *     path="/backoffice/permissions",
     *     operationId="getPermissionsList",
     *     tags={"Backoffice/Permissions"},
     *     summary="Get list of projects",
     *     description="Returns list of the permissions",
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
    public function index() : PermissionCollection
    {
        //abort_if(Gate::denies('permission_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PermissionCollection(
            collect(PermissionFinder::all())->map(function ($permission) {
                return new PermissionResource((object) $permission);
            })
        );
    }


    /**
     * Display the specified resource.
     * @param  int  $id
     * @return PermissionResource
     * @OA\Get(
     *     path="/backoffice/permissions/{id}",
     *     tags={"Backoffice/Permissions"},
     *     summary="Ged permission information",
     *     description="Returns permission data",
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         in="path",
     *         name="id",
     *         description="Permissions id",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Ok"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad Request"
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
    public function show(int $id)
    {
        //abort_if(Gate::denies('permission_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PermissionResource(
            PermissionFinder::find($id)
        );
    }
}
