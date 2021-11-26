<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Home\CartController;
use App\Http\Controllers\Home\CustomerController;
use App\Http\Controllers\Home\MailController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\OrderDetailController;
use App\Http\Controllers\Admin\StockController;

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



//Admin
Route::prefix('admin')->group(function (){
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/login', [AuthController::class, 'loginView']);
    Route::get('/logout', [AuthController::class, 'logout'])->name('admin.logout');
});

Route::middleware(['checklogin'])->group(function(){
    Route::prefix('admin')->group(function (){
        Route::get('index',[AdminController::class,'index'])->name('admin.index');
        Route::get('/',[AdminController::class,'index'])->name('admin.index');
        Route::get('/onlyfan',[AdminController::class,'onlyfan'])->name('onlyfan');
        Route::get('/profile',[AdminController::class,'viewProfile'])->name('profile');


        //categories
        Route::prefix('category')->group(function (){
            Route::get('add-category', [CategoryController::class, 'create'])->name('add-category.index');
            Route::post('add-category', [CategoryController::class, 'store'])->name('add-category.create');
            Route::get('list-category', [CategoryController::class, 'index'])->name('list-category.index');
            Route::get('delete-category/{id}', [CategoryController::class, 'destroy'])->name('category.delete');
            Route::get('edit-category/{id}', [CategoryController::class, 'show'])->name('category.edit');
            Route::post('edit-category/{id}', [CategoryController::class, 'update']);
        });


        //Brand
        Route::prefix('brand')->group(function (){
            Route::get('add-brand', [BrandController::class, 'create'])->name('add-brand.index');
            Route::post('add-brand', [BrandController::class, 'store'])->name('add-brand.create');
            Route::get('list-brand', [BrandController::class, 'index'])->name('list-brand.index');
            Route::get('delete-brand/{id}', [BrandController::class, 'destroy'])->name('brand.delete');
            Route::get('edit-brand/{id}', [BrandController::class, 'show'])->name('brand.edit');
            Route::post('edit-brand/{id}', [BrandController::class, 'update']);
        });


        //Product
        Route::prefix('product')->group(function (){
            Route::get('add-product', [ProductController::class, 'create'])->name('add-product.index');
            Route::post('add-product', [ProductController::class, 'store'])->name('add-product.create');
            Route::get('list-product', [ProductController::class, 'index'])->name('list-product.index');
            Route::get('delete-product/{id}', [ProductController::class, 'destroy'])->name('product.delete');
            Route::get('edit-product/{id}', [ProductController::class, 'show'])->name('product.edit');
            Route::post('edit-product/{id}', [ProductController::class, 'update']);
            Route::post('export-file',[ProductController::class,'export'])->name('export');
        });

        //Order
        Route::prefix('order')->group(function (){
            Route::get('list-order',[OrderController::class,'index'])->name('list-order.index');
            Route::get('view-order/{id}',[OrderDetailController::class,'index'])->name('order.view');
            Route::get('view-order/confirm/{id}',[OrderController::class,'confirm'])->name('order.confirm');
            Route::get('view-order/shipping/{id}',[OrderController::class,'shipping'])->name('order.shipping');
        });

        //Stock
        Route::prefix('stock')->group(function (){
            Route::get('in-stock',[StockController::class,'index'])->name('stock.index');
            Route::get('update-stock/{id}',[StockController::class,'update'])->name('stock.update.view');
            Route::post('update-stock/{id}',[StockController::class,'confirmUpdate'])->name('stock.update');
        });
    });
});

//customer
Route::prefix('customer')->group(function (){
    Route::get('/login',[CustomerController::class,'index'])->name('customer-login-page');
    Route::post('/login', [CustomerController::class, 'login'])->name('customer-login');
    Route::get('/register',[CustomerController::class,'registerForm'])->name('customer-register-page');
    Route::post('/register',[CustomerController::class,'register'])->name('customer-register');
    Route::get('/verify/{customer}/{token}',[CustomerController::class,'verify'])->name('verify-account');
    Route::get('/history',[CustomerController::class,'history'])->name('history.index');
    Route::get('/history-order/{id}',[CustomerController::class,'viewOrderHistory'])->name('order-details.history');
});

Route::get('/',[HomeController::class,'index'])->name('home');
Route::get('/home',[HomeController::class,'index'])->name('home');
Route::get('/logout',[HomeController::class,'logout'])->name('customer-logout');
Route::get('/category/{id}',[HomeController::class,'showCategoryItems'])->name('category');
Route::get('/product',[HomeController::class,'getAll'])->name('all-product');
Route::get('/product/{id}',[HomeController::class,'productDetail'])->name('view-product');
Route::post('/search-by-price',[HomeController::class,'searchByPrice'])->name('search-by-price');
Route::get('/search',[HomeController::class,'search'])->name('search');
Route::get('/add-to-cart',[CartController::class,'add'])->name('add-to-cart');
Route::get('/view-cart',[CartController::class,'index'])->name('view-cart');
Route::prefix('cart')->group(function(){
    Route::get('/remove-cart' ,[CartController::class,'delete'])->name('remove-cart');
    Route::get('/update-cart',[CartController::class,'update'])->name('update-cart');
    Route::get('/check-out',[CartController::class,'checkOut'])->name('check-out');
    Route::post('/check-out',[CartController::class,'addOrder'])->name('confirm-check-out');
});

