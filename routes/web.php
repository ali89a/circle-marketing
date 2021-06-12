<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\Admin\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth:admin')->prefix('access-control')->group(function () {
    Route::resource('permission', PermissionController::class);
    Route::resource('role', RoleController::class);
    Route::resource('admin', AdminController::class);
});
Route::middleware('auth:admin')->prefix('admin')->group(function () {

    Route::resource('user', UserController::class);
});
require('admin.php');