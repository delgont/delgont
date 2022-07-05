<?php

use Illuminate\Support\Facades\Route;

use Delgont\Cms\Http\Controllers\Auth\AuthController;
use Delgont\Cms\Http\Controllers\UserController;
use Delgont\Cms\Http\Controllers\Account\AccountController;
use Delgont\Cms\Http\Controllers\Account\AccountSettingController;

use Delgont\Cms\Http\Controllers\Page\PageController;
use Delgont\Cms\Http\Controllers\Post\PostController;
use Delgont\Cms\Http\Controllers\Post\PostTrashController;
use Delgont\Cms\Http\Controllers\Category\CategoryController;

use Delgont\Cms\Http\Controllers\TestController;

/**
 * Web Routes
 */
Route::group(['prefix' => config('delgont.route_prefix', 'dashboard'), 'middleware' => 'web'], function(){

    Route::group(['middleware' => 'guest:auth'], function(){
        Route::get('/login', [AuthController::class, 'index'])->name('delgont.login');
        Route::post('/login', [AuthController::class, 'login'])->name('delgont.login');
        Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('delgont.password.resetEmailForm');
        Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('delgont.password.reset.link');
    });

    Route::group(['middleware' => ['auth']], function(){
        Route::post('/logout', [AuthController::class, 'logout'])->name('delgont.logout');

        Route::get('/account', [AccountController::class, 'index'])->name('delgont.account');
        Route::get('/account/activitylog', [AccountController::class, 'activityLog'])->name('delgont.account.activitylog');
        Route::post('/account/change/password', [AccountController::class, 'changePassword'])->name('delgont.account.change.password');
        Route::post('/account/change/avator', [AccountController::class, 'updateAvator'])->name('delgont.account.change.avator');
        Route::get('/account/settings', [AccountSettingController::class, 'index'])->name('delgont.account.settings');

        Route::get('/users', [UserController::class, 'index'])->name('delgont.users');
        Route::get('/users/create', [UserController::class, 'create'])->name('delgont.users.create');
        Route::post('/users/store', [UserController::class, 'store'])->name('delgont.users.store');
        Route::get('/users/{username}/{id}', [UserController::class, 'show'])->name('delgont.users.show');
        Route::get('/users/edit/{username}/{id}', [UserController::class, 'edit'])->name('delgont.users.edit');
        Route::post('/users/update/{id}', [UserController::class, 'update'])->name('delgont.users.update');
        Route::get('/users/destroy/{id}', [UserController::class, 'destroy'])->name('delgont.users.destroy');
        Route::post('/users/change/password/{id}', [UserController::class, 'changePassword'])->name('delgont.users.change.password');
        Route::get('/users/{username}/activitylog', [UserController::class, 'index'])->name('delgont.admins.activitylog');

        Route::get('/pages', [PageController::class, 'index'])->name('delgont.pages');
        Route::get('/pages/create', [PageController::class, 'create'])->name('delgont.pages.create');
        Route::post('/pages/create', [PageController::class, 'store'])->name('delgont.pages.store');
        Route::get('/pages/show/{id}', [PageController::class, 'show'])->name('delgont.pages.show');
        Route::get('/pages/edit/{id}', [PageController::class, 'edit'])->name('delgont.pages.edit');
        Route::post('/pages/edit/{id}', [PageController::class, 'update'])->name('delgont.pages.update');

        Route::get('/posts', [PostController::class, 'index'])->name('delgont.posts');
        Route::get('/posts/create', [PostController::class, 'create'])->name('delgont.posts.create');
        Route::post('/posts/create', [PostController::class, 'store'])->name('delgont.posts.store');
        Route::get('/posts/show/{id}', [PostController::class, 'show'])->name('delgont.posts.show');
        Route::post('/posts/update/{id}', [PostController::class, 'update'])->name('delgont.posts.update');
        Route::get('/posts/destroy/{id}', [PostController::class, 'destroy'])->name('delgont.posts.destroy');

        Route::get('/posts/trash', [PostTrashController::class, 'index'])->name('delgont.posts.trash');
        Route::get('/posts/trash/{id}', [PostTrashController::class, 'show'])->name('delgont.posts.trash.show');

        Route::get('/categories', [CategoryController::class, 'index'])->name('delgont.categories');
        Route::post('/categories/store', [CategoryController::class, 'store'])->name('delgont.categories.store');
        Route::get('/categories/edit/{id}', [CategoryController::class, 'edit'])->name('delgont.categories.edit');
        Route::get('/categories/destroy/{id}', [CategoryController::class, 'destroy'])->name('delgont.categories.destroy');

        Route::get('/', [TestController::class, 'index'])->name('delgont.dashboard');
    });

});


/**
 * API Routes
 */
Route::group(['prefix' => 'api'], function(){
    Route::group(['prefix' => config('delgont.route_prefix', 'dashboard')], function(){

        Route::group(['middleware' => ['api','guest:api']], function(){
            Route::post('/login', [AuthController::class, 'apiLogin']);
        });
 
        Route::group(['middleware' => ['api','auth:api']], function(){

            Route::get('/account', [AccountController::class, 'index']);
            Route::get('/account/activitylog', [AccountController::class, 'activityLog']);
            Route::post('/account/change/password', [AccountController::class, 'changePassword']);
            Route::post('/account/change/avator', [AccountController::class, 'updateAvator']);
            Route::get('/account/settings', [AccountSettingController::class, 'index']);

            Route::get('/users', [UserController::class, 'index']);
            Route::get('/users/create', [UserController::class, 'create']);
            Route::post('/users/store', [UserController::class, 'store']);
            Route::get('/users/{username}/{id}', [UserController::class, 'show']);
            Route::get('/users/edit/{username}/{id}', [UserController::class, 'edit']);
            Route::post('/users/update/{id}', [UserController::class, 'update']);
            Route::get('/users/destroy/{id}', [UserController::class, 'destroy']);
            Route::post('/users/change/password/{id}', [UserController::class, 'changePassword']);
            Route::get('/users/{username}/activitylog', [UserController::class, 'index']);

            Route::get('/pages', [PageController::class, 'index']);
            Route::get('/pages/create', [PageController::class, 'create']);
            Route::post('/pages/create', [PageController::class, 'store']);
            Route::get('/pages/show/{id}', [PageController::class, 'show']);
            Route::get('/pages/edit/{id}', [PageController::class, 'edit']);
            Route::post('/pages/edit/{id}', [PageController::class, 'update']);

            Route::get('/posts', [PostController::class, 'index']);
            Route::get('/posts/create', [PostController::class, 'create']);
            Route::post('/posts/create', [PostController::class, 'store']);
            Route::get('/posts/show/{id}', [PostController::class, 'show']);
            Route::post('/posts/update/{id}', [PostController::class, 'update']);
            Route::get('/posts/destroy/{id}', [PostController::class, 'destroy']);

            Route::get('/posts/trash', [PostTrashController::class, 'index']);
            Route::get('/posts/trash/{id}', [PostTrashController::class, 'show']);

            Route::get('/categories', [CategoryController::class, 'index']);
            Route::post('/categories/store', [CategoryController::class, 'store']);
            Route::get('/categories/edit/{id}', [CategoryController::class, 'edit']);
            Route::get('/categories/destroy/{id}', [CategoryController::class, 'destroy']);

            Route::get('/', [TestController::class, 'index']);



        });
 
    });
 });