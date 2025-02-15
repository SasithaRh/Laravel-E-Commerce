<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\DiscountCodeController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Home\ProductController as ProductFront;
use App\Http\Controllers\Home\PaymentController;
use App\Http\Controllers\Home\UserController;
use App\Http\Controllers\Admin\SliderController;

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/',[HomeController::class,'index'])->name("home");

Route::get('admin',[AuthController::class,'login_admin'])->name('login');
Route::post('admin',[AuthController::class,'auth_login_admin']);
Route::get('admin/logout',[AuthController::class,'auth_logout_admin'])->name('logout');

Route::group(['middleware'=>'user'],function () {
    Route::get('user/dashboard',[UserController::class,'index'])->name("user/dashboard");
    Route::get('user/orders',[UserController::class,'user_orders'])->name("user/orders");
    Route::get('user/orders/details/{id}',[UserController::class,'user_orders_details'])->name("details.users.order");
    Route::get('user/editprofile',[UserController::class,'user_editprofile'])->name("user/editprofile");
    Route::get('user/change_password',[UserController::class,'change_password'])->name("user/change_password");
    Route::get('user/logout',[UserController::class,'auth_logout_user'])->name('logout/user');
    Route::post('add_to_wishlist',[UserController::class,'add_to_wishlist']);
    Route::get('my-wishlist',[ProductFront::class,'my_wishlist'])->name('my-wishlist');
    Route::post('make_review',[UserController::class,'make_review'])->name('make_review');

});


Route::group(['middleware'=>'admin'],function () {

    Route::get('admin/dashboard',[DashboardController::class,'dashboard'])->name("dashboard");
    Route::get('admin/admin/list',[AdminController::class,'list'])->name('list');
    Route::get('admin/admin/add',[AdminController::class,'add'])->name('add');
    Route::post('admin/admin/add',[AdminController::class,'store'])->name('create');
    Route::get('admin/admin/edit/{id}',[AdminController::class,'edit'])->name('edit');
    Route::put('admin/admin/edit/{user}', [AdminController::class, 'update'])->name('update');
    Route::get('admin/admin/list/{user}', [AdminController::class, 'destroy'])->name('delete');


    Route::get('admin/customers/list',[AdminController::class,'customers_list'])->name('customers');

    Route::get('admin/order/list',[OrderController::class,'index'])->name('category');
    Route::get('admin/order/details/{id}',[OrderController::class,'details'])->name('details.order');
    Route::get('admin/orders_status',[OrderController::class,'orders_status']);


    Route::get('admin/category/list',[CategoryController::class,'index'])->name('category');
    Route::get('admin/category/add',[CategoryController::class,'create'])->name('create.category');
    Route::post('admin/category/add',[CategoryController::class,'store'])->name('store.category');
    Route::get('admin/category/edit/{id}',[CategoryController::class,'edit'])->name('edit.category');
    Route::put('admin/category/edit/{item}', [CategoryController::class, 'update'])->name('update.category');
    Route::get('admin/category/list/{item}', [CategoryController::class, 'destroy'])->name('delete.category');

    Route::post('admin/get_subcategory', [SubCategoryController::class, 'get_subcategory']);

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
    Route::get('admin/product/delete/{id}',[ProductController::class,'destroy'])->name('delete.product');
    Route::post('admin/product/edit/{item}', [ProductController::class, 'update'])->name('update.product');
    Route::get('admin/product/image_delete/{item}', [ProductController::class, 'delete'])->name('image.delete');
    // Route::post('admin/product_image_sortable', [ProductController::class, 'product_image_sortable']);


    // Route::get('admin/sub_category/list/{item}', [ProductController::class, 'destroy'])->name('delete.sub_category');

    Route::get('admin/brand/list',[BrandController::class,'index'])->name('brand');
    Route::get('admin/brand/add',[BrandController::class,'create'])->name('create.brand');
    Route::post('admin/brand/add',[BrandController::class,'store'])->name('store.brand');
    Route::get('admin/brand/edit/{id}',[BrandController::class,'edit'])->name('edit.brand');
    Route::put('admin/brand/edit/{item}', [BrandController::class, 'update'])->name('update.brand');
    Route::get('admin/brand/list/{item}', [BrandController::class, 'destroy'])->name('delete.brand');


    Route::get('admin/color/list',[ColorController::class,'index'])->name('color');
    Route::get('admin/color/add',[ColorController::class,'create'])->name('create.color');
    Route::post('admin/color/add',[ColorController::class,'store'])->name('store.color');
    Route::get('admin/color/edit/{id}',[ColorController::class,'edit'])->name('edit.color');
    Route::put('admin/color/edit/{item}', [ColorController::class, 'update'])->name('update.color');
    Route::get('admin/color/list/{item}', [ColorController::class, 'destroy'])->name('delete.color');

    Route::get('admin/discountcode/list',[DiscountCodeController::class,'index'])->name('discountcode');
    Route::get('admin/discountcode/add',[DiscountCodeController::class,'create'])->name('create.discountcode');
    Route::post('admin/discountcode/add',[DiscountCodeController::class,'store'])->name('store.discountcode');
    Route::get('admin/discountcode/edit/{id}',[DiscountCodeController::class,'edit'])->name('edit.discountcode');
    Route::put('admin/discountcode/edit/{item}', [DiscountCodeController::class, 'update'])->name('update.discountcode');
    Route::get('admin/discountcode/list/{item}', [DiscountCodeController::class, 'destroy'])->name('delete.discountcode');

    Route::get('admin/slider/list',[SliderController::class,'index'])->name('slider');
    Route::get('admin/slider/add',[SliderController::class,'create'])->name('create.slider');
    Route::post('admin/slider/add',[SliderController::class,'store'])->name('store.slider');


});


Route::post('auth_register',[AuthController::class,'auth_register']);
Route::post('auth_signin',[AuthController::class,'auth_signin']);
Route::get('activate/{id}',[AuthController::class,'activate_email']);
Route::get('logout',[AuthController::class,'user_logout'])->name('user_logout');
Route::get('cart',[PaymentController::class,'cart'])->name('cart');
Route::get('notification/remove',[PaymentController::class,'remove']);
Route::get('cart/delete/{id}',[PaymentController::class,'cart_delete'])->name('cart.delete');
Route::post('cart',[PaymentController::class,'cart_update'])->name('update_cart');
Route::get('checkout',[PaymentController::class,'checkout'])->name('checkout');
Route::post('checkout/place_order',[PaymentController::class,'checkout_place_order'])->name('checkout/place_order');
Route::get('checkout/payment',[PaymentController::class,'checkout_payment']);
Route::get('about_us',[UserController::class,'about_us'])->name("about_us");
Route::get('contact_us',[UserController::class,'contact_us'])->name("contact_us");
Route::post('checkout/apply_discount',[PaymentController::class,'apply_discount']);
Route::get('search',[ProductFront::class,'getProductsearch']);
Route::get('/home/layouts/header',[CategoryController::class,'indexs']);
Route::post('get_product_filter',[ProductFront::class,'get_product_filter']);
Route::get('{slug?}/{subslug?}',[ProductFront::class,'getCategory']);
Route::post('prodcut/add-to-cart',[PaymentController::class,'addtocart'])->name('prodcut/add-to-cart');
Route::post('submit_contact',[HomeController::class,'submit_contact'])->name('submit_contact');



