<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post('eqmcpt/user/login', [UserController::class, 'login'])->name('user.login');
Route::post('eqmcpt/user/register', [UserController::class, 'register'])->name('user.register');

Route::group(['middleware' => 'auth:employee,member', 'prefix' => 'eqmcpt/user'], function () {
    Route::controller(UserController::class)->group(function () {
        Route::get('profile', 'profile')->name('user.profile');
        Route::put('update', 'update')->name('user.update');
        Route::put('update/address', 'updateAddress')->name('user.updateAddress');
        Route::get('get/all/address', 'getAllAddress')->name('user.getAllAddress');
        Route::get('logout', 'logout')->name('user.logout');
    });
});
