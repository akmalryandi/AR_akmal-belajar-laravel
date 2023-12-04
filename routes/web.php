<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BiodataController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\SalesDetailsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::middleware(['guest'])->group(function () {
    Route::get('/biodata', [BiodataController::class, 'index']);
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'index'])->name('register');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
});

Route::get('/home', function () {
    return redirect('dashboard');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [HomeController::class, 'productStats'])->name('dashboard');
    Route::get('/products', [ProductsController::class, 'index'])->name('products');
    Route::get('/category', [CategoryController::class, 'index'])->name('category');
    Route::get('/customers', [CustomersController::class, 'index'])->name('customers');
    Route::get('/sales', [SalesController::class, 'index'])->name('sales');
    Route::get('/salesdetail', [SalesDetailsController::class, 'index'])->name('salesdetail');
    Route::get('/logout', [AuthController::class, 'logout']);

    Route::middleware(['userAkses:admin'])->group(function () {
        Route::get('/products/create', [ProductsController::class, 'create'])->name('products.create');
        Route::post('/products', [ProductsController::class, 'store'])->name('products.store');
        Route::get('/products/edit/{id}', [ProductsController::class, 'edit'])->name('products.edit');
        Route::put('/products/{id}', [ProductsController::class, 'update'])->name('products.update');
        Route::get('/products/delete/{id}', [ProductsController::class, 'destroy'])->name('products.delete');

        Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
        Route::post('/category', [CategoryController::class, 'store'])->name('category.store');
        Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
        Route::put('/category/{id}', [CategoryController::class, 'update'])->name('category.update');
        Route::get('/category/delete/{id}', [CategoryController::class, 'destroy'])->name('category.delete');

        Route::get('/customers/create', [CustomersController::class, 'create'])->name('customers.create');
        Route::post('/customers', [CustomersController::class, 'store'])->name('customers.store');
        Route::get('/customers/edit/{id}', [CustomersController::class, 'edit'])->name('customers.edit');
        Route::put('/customers/{id}', [CustomersController::class, 'update'])->name('customers.update');
        Route::get('/customers/delete/{id}', [CustomersController::class, 'destroy'])->name('customers.delete');

        Route::get('/sales/create', [SalesController::class, 'create'])->name('sales.create');
        Route::post('/sales', [SalesController::class, 'store'])->name('sales.store');
        Route::get('/sales/edit/{id}', [SalesController::class, 'edit'])->name('sales.edit');
        Route::put('/sales/{id}', [SalesController::class, 'update'])->name('sales.update');
        Route::get('/sales/delete/{id}', [SalesController::class, 'destroy'])->name('sales.delete');

        Route::get('/salesdetail/create', [SalesDetailsController::class, 'create'])->name('salesdetail.create');
        Route::post('/salesdetail', [SalesDetailsController::class, 'store'])->name('salesdetail.store');
        Route::get('/salesdetail/edit/{id}', [SalesDetailsController::class, 'edit'])->name('salesdetail.edit');
        Route::put('/salesdetail/{id}', [SalesDetailsController::class, 'update'])->name('salesdetail.update');
        Route::get('/salesdetail/delete/{id}', [SalesDetailsController::class, 'destroy'])->name('salesdetail.delete');

        Route::get('/users', [UserController::class, 'index'])->name('users');
        Route::get('/users/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
        Route::get('/users/delete/{id}', [UserController::class, 'destroy'])->name('users.delete');
    });
});





