<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');
Route::group(['middleware' => 'auth'], function()
{
    Route::get('users/{name?}', [UsersController::class, 'index']);
    Route::get('roles', [RolesController::class, 'index']);
    Route::get('permissions', [PermissionsController::class, 'index']);
});

require __DIR__.'/auth.php';
