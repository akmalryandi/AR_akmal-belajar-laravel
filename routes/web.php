<?php

use App\Http\Controllers\BiodataController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductsController;
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

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/biodata', [BiodataController::class, 'index']);

Route::get('/dashboard', [HomeController::class, 'show'])->name('dashboard');
Route::get('/products', [ProductsController::class, 'index'])->name('products');
Route::get('/products/create', [ProductsController::class, 'create'])->name('products.create');
Route::post('/products', [ProductsController::class, 'store'])->name('products.store');
Route::get('/products/edit/{id}', [ProductsController::class, 'edit'])->name('products.edit');
Route::put('/customers/{id}', [ProductsController::class, 'update'])->name('products.update');
Route::get('/customers/delete/{id}', [ProductsController::class, 'destroy'])->name('products.delete');

