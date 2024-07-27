<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\BrandController;
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
    Route::put('admin/admin/edit/{user}', [AdminController::class, 'update'])->name('update');
    Route::get('admin/admin/list/{user}', [AdminController::class, 'destroy'])->name('delete');

    Route::get('admin/category/list',[CategoryController::class,'index'])->name('category');
    Route::get('admin/category/add',[CategoryController::class,'create'])->name('create.category');
    Route::post('admin/category/add',[CategoryController::class,'store'])->name('store.category');
    Route::get('admin/category/edit/{id}',[CategoryController::class,'edit'])->name('edit.category');
    Route::put('admin/category/edit/{item}', [CategoryController::class, 'update'])->name('update.category');
    Route::get('admin/category/list/{item}', [CategoryController::class, 'destroy'])->name('delete.category');

    Route::get('admin/sub_category/list',[SubCategoryController::class,'index'])->name('sub_category');
    Route::get('admin/sub_category/add',[SubCategoryController::class,'create'])->name('create.sub_category');
    Route::post('admin/sub_category/add',[SubCategoryController::class,'store'])->name('store.sub_category');
    Route::get('admin/sub_category/edit/{id}',[SubCategoryController::class,'edit'])->name('edit.sub_category');
    Route::put('admin/sub_category/edit/{item}', [SubCategoryController::class, 'update'])->name('update.sub_category');
    Route::get('admin/sub_category/list/{item}', [SubCategoryController::class, 'destroy'])->name('delete.sub_category');

    Route::get('admin/product/list',[ProductController::class,'index'])->name('prodcut');
    Route::get('admin/product/add',[ProductController::class,'create'])->name('create.product');
    Route::post('admin/product/add',[ProductController::class,'store'])->name('store.product');
    Route::get('admin/product/edit/{id}',[ProductController::class,'edit'])->name('edit.product');
    // Route::put('admin/sub_category/edit/{item}', [ProductController::class, 'update'])->name('update.sub_category');
    // Route::get('admin/sub_category/list/{item}', [ProductController::class, 'destroy'])->name('delete.sub_category');

    Route::get('admin/brand/list',[BrandController::class,'index'])->name('brand');
    Route::get('admin/brand/add',[BrandController::class,'create'])->name('create.brand');
    Route::post('admin/brand/add',[BrandController::class,'store'])->name('store.brand');
    Route::get('admin/brand/edit/{id}',[BrandController::class,'edit'])->name('edit.brand');
    Route::put('admin/brand/edit/{item}', [BrandController::class, 'update'])->name('update.brand');
    Route::get('admin/brand/list/{item}', [BrandController::class, 'destroy'])->name('delete.brand');


});
