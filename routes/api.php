<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


// Public routes
Route::middleware('guest')->group(function () {
    Route::post('auth/login', 'Auth\AuthController@login')->name('auth.login');
    Route::post('auth/register', 'Auth\AuthController@register')->name('auth.register');
    Route::post('auth/forgot-password', 'Auth\AuthController@sendForgotPasswordLink')->name('password.send');
    Route::post('auth/reset-password', 'Auth\AuthController@resetPassword')->name('password.reset');
});

// Private routes
Route::middleware('auth:api')->group(function () {
    Route::post('auth/logout', 'Auth\AuthController@logout')->name('auth.logout');
    Route::get('auth/me', 'Auth\AuthController@me')->name('auth.me');

    Route::post('permissions/{permission}/sync-roles', 'PermissionController@syncRoles');
    Route::post('roles/{role}/sync-permissions', 'RoleController@syncPermissions');

    Route::apiResources([
        'permissions' => 'PermissionController',
        'roles'       => 'RoleController',
        'users'       => 'UserController',
    ]);
});


