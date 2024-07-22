<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('admin',[AuthController::class,'login_admin']);
Route::post('admin',[AuthController::class,'auth_login_admin']);
Route::get('admin/logout',[AuthController::class,'auth_logout_admin'])->name('logout');


Route::group(['middleware'=>'admin'],function () {

    Route::get('admin/dashboard',[DashboardController::class,'dashboard'])->name("dashboard");
    Route::get('admin/admin/list',[AdminController::class,'list'])->name('list');
    Route::get('admin/admin/add',[AdminController::class,'add'])->name('add');
    Route::post('admin/admin/add',[AdminController::class,'store'])->name('create');
    Route::get('admin/admin/edit/{id}',[AdminController::class,'edit'])->name('edit');
    // Route::post('admin/admin/edit/{id}',[AdminController::class,'update'])->name('update');
    Route::put('admin/admin/edit/{user}', [AdminController::class, 'update'])->name('update');
    Route::get('admin/admin/list/{user}', [AdminController::class, 'destroy'])->name('delete');




});
