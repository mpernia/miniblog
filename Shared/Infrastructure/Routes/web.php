<?php

use Illuminate\Support\Facades\Route;
use MiniBlog\BoundedContext\Backoffice\Infrastructure\Controllers\DashboardController;
use MiniBlog\BoundedContext\Backoffice\Infrastructure\Controllers\PermissionController;
use MiniBlog\BoundedContext\Backoffice\Infrastructure\Controllers\RoleController;
use MiniBlog\BoundedContext\Backoffice\Infrastructure\Controllers\UserController;
use MiniBlog\BoundedContext\Backoffice\Infrastructure\Controllers\CategoryController;
use MiniBlog\BoundedContext\Backoffice\Infrastructure\Controllers\TagController;
use MiniBlog\BoundedContext\Backoffice\Infrastructure\Controllers\PostController;

use MiniBlog\BoundedContext\Frontend\Infrastructure\Controllers\AboutUsController;
use MiniBlog\BoundedContext\Frontend\Infrastructure\Controllers\CookieController;
use MiniBlog\BoundedContext\Frontend\Infrastructure\Controllers\FaqController;
use MiniBlog\BoundedContext\Frontend\Infrastructure\Controllers\HomeController;
use MiniBlog\BoundedContext\Frontend\Infrastructure\Controllers\PolicyController;
use MiniBlog\BoundedContext\Frontend\Infrastructure\Controllers\SitemapController;
use MiniBlog\BoundedContext\Frontend\Infrastructure\Controllers\TermController;
use MiniBlog\BoundedContext\Frontend\Infrastructure\Controllers\CategoryController as FrontendCategoryController;
use MiniBlog\BoundedContext\Frontend\Infrastructure\Controllers\TagController as FrontendTagController;
use MiniBlog\BoundedContext\Frontend\Infrastructure\Controllers\PostController as FrontendPostController;


Route::group(['as' => 'frontend.', 'middleware' => 'guest'], function (){
    Route::get('/', HomeController::class)->name('home');
    Route::get('sitemap.xml', SitemapController::class)->name('sitemap');
    Route::get('about-us', AboutUsController::class)->name('contacts');
    Route::get('policies', PolicyController::class)->name('policies');
    Route::get('terms', TermController::class)->name('terms');
    Route::get('cookies', CookieController::class)->name('cookies');
    Route::get('faqs', FaqController::class)->name('faqs');
    Route::resource('categories', FrontendCategoryController::class)->only('show');
    Route::resource('tags', FrontendTagController::class)->only('show');
    Route::resource('posts', FrontendPostController::class)->only('index', 'show');
});

Route::group(['prefix' => 'dashboard', 'as' => 'backoffice.'/*, 'middleware' => ['auth', 'admin']*/], function () {
    Route::get('/', DashboardController::class)->name('dashboard');
    Route::resource('permissions', PermissionController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('tags', TagController::class);
    Route::post('posts/media', [PostController::class, 'storeMedia'])->name('posts.storeMedia');
    Route::post('posts/ckmedia', [PostController::class, 'storeCKEditorImages'])->name('posts.storeCKEditorImages');
    Route::resource('posts', PostController::class);

});
