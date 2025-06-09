<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');

    Route::prefix('admin')->middleware(['auth', 'verified'])->group(function () {
        Route::prefix('users')->name('admin.users.')->group(function () {
            Route::get('/', ['as' => 'index', 'uses' => 'App\Http\Controllers\Admin\UserController@index']);
            Route::get('create', ['as' => 'create', 'uses' => 'App\Http\Controllers\Admin\UserController@create']);
            Route::post('/', ['as' => 'store', 'uses' => 'App\Http\Controllers\Admin\UserController@store']);
            Route::get('{user}', ['as' => 'show', 'uses' => 'App\Http\Controllers\Admin\UserController@show']);
            Route::get('{user}/edit', ['as' => 'edit', 'uses' => 'App\Http\Controllers\Admin\UserController@edit']);
            Route::put('{user}', ['as' => 'update', 'uses' => 'App\Http\Controllers\Admin\UserController@update']);
            Route::delete('{user}', ['as' => 'destroy', 'uses' => 'App\Http\Controllers\Admin\UserController@destroy']);
            Route::get('trash/list', ['as' => 'trash', 'uses' => 'App\Http\Controllers\Admin\UserController@trash']);
            Route::post('{id}/restore', ['as' => 'restore', 'uses' => 'App\Http\Controllers\Admin\UserController@restore']);
            Route::delete('{id}/purge', ['as' => 'purge', 'uses' => 'App\Http\Controllers\Admin\UserController@purge']);
        });
    });
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
