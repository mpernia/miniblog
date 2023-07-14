<?php

use Illuminate\Support\Facades\Route;
use MiniBlog\BoundedContext\Backend\Infrastructure\Controllers\V1\PermissionController;
use MiniBlog\BoundedContext\Backend\Infrastructure\Controllers\V1\RoleController;
use MiniBlog\BoundedContext\Backend\Infrastructure\Controllers\V1\UserController;
use MiniBlog\BoundedContext\Backend\Infrastructure\Controllers\V1\CategoryController;
use MiniBlog\BoundedContext\Backend\Infrastructure\Controllers\V1\PostController;

Route::group(['prefix' => 'v1', 'as' => 'api.'], function () {

    Route::group(['prefix' => 'backoffice', 'as' => 'backoffice.', 'middleware' => ['auth:sanctum']], function () {
        Route::apiResource('permissions', PermissionController::class);
        Route::apiResource('roles', RoleController::class);
        Route::apiResource('users', UserController::class);
        Route::apiResource('categories', CategoryController::class);
        Route::apiResource('posts', PostController::class);
    });

    Route::group(['prefix' => 'frontend', 'as' => 'frontend.'], function () {
        Route::apiResource('categories', CategoryController::class)->only('index', 'show');
        Route::apiResource('posts', PostController::class)->only('index', 'show');
    });
});
