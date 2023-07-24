<?php

use Illuminate\Support\Facades\Route;
use MiniBlog\BoundedContext\Auth\ForgotPasswordController;
use MiniBlog\BoundedContext\Auth\LoginController;
use MiniBlog\BoundedContext\Auth\RegisterController;
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

Route::group([], function (){
    Route::middleware('isguest')->group(function () {
        Route::get('/login', [LoginController::class, 'showLoginForm']);
        Route::post('login', [LoginController::class, 'login'])->name('login');
        Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register.form');
        Route::post('/register', [RegisterController::class, 'register'])->name('register');
        Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    });

    Route::middleware('auth')->group(function () {
        Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    });
});

Route::group(['as' => 'frontend.', 'middleware' => 'frontend'], function (){
    Route::get('/', HomeController::class)->name('home');
    Route::get('sitemap.xml', SitemapController::class)->name('sitemap');
    Route::get('about-us', AboutUsController::class)->name('contacts');
    Route::get('policies', PolicyController::class)->name('policies');
    Route::get('terms', TermController::class)->name('terms');
    Route::get('cookies', CookieController::class)->name('cookies');
    Route::get('faqs', FaqController::class)->name('faqs');

    Route::group(['prefix' => 'categories', 'as' => 'categories.'], function (){
        Route::get('/', [FrontendCategoryController::class, 'index'])->name('index');
        Route::get('/{categoryId}', [FrontendCategoryController::class, 'show'])->name('show');
        Route::group(['prefix' => 'posts', 'as' => 'posts.'], function () {
            Route::get('/', [FrontendCategoryController::class, 'allPost'])->name('index');
            Route::get('/{postId}', [FrontendCategoryController::class, 'showPost'])->name('show');
        });
    });
    Route::group(['prefix' => 'tags/{tagId}/posts', 'as' => 'tags.'], function (){
        Route::get('/', [FrontendTagController::class, 'allPost'])->name('posts.index');
        Route::get('/{postId}', [FrontendTagController::class, 'showPost'])->name('posts.show');
    });
    Route::get('posts/{id}', [FrontendPostController::class, 'show'])->name('posts.show');
});

Route::group(['prefix' => 'dashboard', 'as' => 'backoffice.', 'middleware' => ['auth'/*, 'admin'*/]], function () {
    Route::get('/', DashboardController::class)->name('dashboard');
    Route::resource('categories', CategoryController::class);
    Route::resource('tags', TagController::class);
    Route::post('posts/media', [PostController::class, 'storeMedia'])->name('posts.storeMedia');
    Route::post('posts/ckmedia', [PostController::class, 'storeCKEditorImages'])->name('posts.storeCKEditorImages');
    Route::resource('posts', PostController::class);

    Route::group(['middleware' => ['admin']], function () {
        Route::resource('permissions', PermissionController::class);
        Route::resource('roles', RoleController::class);
        Route::resource('users', UserController::class);
    });
});
