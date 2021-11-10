<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/setting', [App\Http\Controllers\SettingController::class, 'store'])->name('setting');

//Users
Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('user');
Route::get('/user-new', [App\Http\Controllers\UserController::class, 'show'])->name('user.new');
Route::post('/user', [App\Http\Controllers\UserController::class, 'store'])->name('user.store');
Route::get('/user/{id}', [App\Http\Controllers\UserController::class, 'edit'])->name('user.edit');
Route::post('/user/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('user.update');
Route::post('/user/{id}destroy/delete', [App\Http\Controllers\UserController::class, ''])->name('user.delete');

Route::get('/user/{id}/password-reset', [App\Http\Controllers\UserController::class, 'reset'])->name('user.reset');
Route::get('/user/{id}/password-change', [App\Http\Controllers\UserController::class, 'change'])->name('user.change');
Route::post('/user/{id}/password-reset', [App\Http\Controllers\UserController::class, 'resetPassword'])->name('user.reset');
Route::post('/user/{id}/password-change', [App\Http\Controllers\UserController::class, 'changePassword'])->name('user.change');


// Suppliers
Route::get('/suppliers', [App\Http\Controllers\SupplierController::class, 'index'])->name('supplier');
Route::get('/supplier-new', [App\Http\Controllers\SupplierController::class, 'create'])->name('supplier.new');
Route::get('/supplier/{id}', [App\Http\Controllers\SupplierController::class, 'edit'])->name('supplier.edit');
Route::post('/supplier/{id}', [App\Http\Controllers\SupplierController::class, 'update'])->name('supplier.update');
Route::post('/suppliers', [App\Http\Controllers\SupplierController::class, 'store'])->name('supplier.store');
Route::get('/supplier/{id}/delete', [App\Http\Controllers\SupplierController::class, 'destroy'])->name('supplier.delete');

//Categories
Route::get('/category', [App\Http\Controllers\CategoryController::class, 'index'])->name('category');
Route::get('/category-new', [App\Http\Controllers\CategoryController::class, 'create'])->name('category.new');
Route::get('/category/{id}', [App\Http\Controllers\CategoryController::class, 'edit'])->name('category.edit');
Route::post('/category/{id}', [App\Http\Controllers\CategoryController::class, 'update'])->name('category.update');
Route::post('/category', [App\Http\Controllers\CategoryController::class, 'store'])->name('category.store');
Route::get('/category/{id}/delete', [App\Http\Controllers\CategoryController::class, 'destroy'])->name('category.delete');


//Products
Route::get('/product', [App\Http\Controllers\ProductController::class, 'index'])->name('product');
Route::get('/product-new', [App\Http\Controllers\ProductController::class, 'create'])->name('product.new');
Route::get('/product/{id}', [App\Http\Controllers\ProductController::class, 'edit'])->name('product.edit');
Route::post('/product/{id}', [App\Http\Controllers\ProductController::class, 'update'])->name('product.update');
Route::post('/product', [App\Http\Controllers\ProductController::class, 'store'])->name('product.store');
Route::get('/product/{id}/delete', [App\Http\Controllers\ProductController::class, 'destroy'])->name('product.delete');

//Refill- Products
Route::get('/refill', [App\Http\Controllers\RefillController::class, 'index'])->name('refill');
Route::get('/refill/{id}', [App\Http\Controllers\RefillController::class, 'edit'])->name('refill.edit');
Route::post('/refill/{id}', [App\Http\Controllers\RefillController::class, 'store'])->name('refill.store');


//Sales
Route::get('/sales', [App\Http\Controllers\SaleController::class, 'show'])->name('sales');
Route::post('/sales', [App\Http\Controllers\SaleController::class, 'search'])->name('search');
Route::get('/sales/{name}', [App\Http\Controllers\SaleController::class, 'getProduct'])->name('getProduct');
Route::post('/sales/add', [App\Http\Controllers\SaleController::class, 'store'])->name('addSales');




