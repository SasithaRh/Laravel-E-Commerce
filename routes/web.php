<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
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

Route::get('admin/dashboard', function () {
    return view('admin.dashboard');

});
Route::get('admin/admin/list', function () {
    return view('admin.admin.list');

});
// Route::controller(AuthController::class)->group(function(){
//     Route::get('/admin/logout', 'destroy' )->name('admin.logout');
    // Route::get('/admin/profile', 'profile' )->name('admin.profile');
    // Route::get('/edit/profile', 'editprofile' )->name('edit.profile');
    // Route::post('/store/profile', 'stroreprofile' )->name('strore.profile');
    // Route::get('/change/password', 'changepassword' )->name('change.password');
    // Route::post('/update/password', 'updatepassword' )->name('update.password');
    // Route::post('/update/password', 'updatepassword' )->name('update.password');

// });
