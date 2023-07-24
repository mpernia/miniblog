<?php

use Illuminate\Support\Facades\Route;
use MiniBlog\BoundedContext\Backend\Infrastructure\Controllers\V1\Backoffice\CategoryController;
use MiniBlog\BoundedContext\Backend\Infrastructure\Controllers\V1\Backoffice\PermissionController;
use MiniBlog\BoundedContext\Backend\Infrastructure\Controllers\V1\Backoffice\PostController;
use MiniBlog\BoundedContext\Backend\Infrastructure\Controllers\V1\Backoffice\RoleController;
use MiniBlog\BoundedContext\Backend\Infrastructure\Controllers\V1\Backoffice\TagController;
use MiniBlog\BoundedContext\Backend\Infrastructure\Controllers\V1\Backoffice\UserController;

use MiniBlog\BoundedContext\Backend\Infrastructure\Controllers\V1\Frontend\CategoryController as FrontendCategoryController;
use MiniBlog\BoundedContext\Backend\Infrastructure\Controllers\V1\Frontend\PostController as FrontendPostController;

Route::group(['prefix' => 'v1', 'as' => 'api.'], function () {

    Route::group(['prefix' => 'backoffice', 'as' => 'backoffice.', 'middleware' => ['auth:sanctum']], function () {
        Route::apiResource('permissions', PermissionController::class)->only('index', 'show');
        Route::apiResource('roles', RoleController::class);
        Route::apiResource('users', UserController::class);
        Route::apiResource('categories', CategoryController::class);
        Route::apiResource('posts', PostController::class);
        Route::apiResource('tags', TagController::class);
    });

    Route::group(['prefix' => 'frontend', 'as' => 'frontend.'], function () {
        Route::apiResource('categories', FrontendCategoryController::class)->only('index', 'show');
        Route::apiResource('posts', FrontendPostController::class)->only('index', 'show');
    });
});
