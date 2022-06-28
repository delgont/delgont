<?php

use Illuminate\Support\Facades\Route;

use Delgont\Cms\Http\Controllers\Auth\AuthController;
use Delgont\Cms\Http\Controllers\UserController;

use Delgont\Cms\Http\Controllers\Page\PageController;

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

        Route::get('/', [TestController::class, 'index'])->name('delgont.dashboard');
    });

});


/**
 * API Routes
 */
Route::group(['prefix' => 'api'], function(){
    Route::group(['prefix' => config('delgont.route_prefix', 'dashboard')], function(){
 
        Route::group(['middleware' => ['api','auth:api']], function(){


        });
 
    });
 });