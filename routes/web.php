<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

//? Home Route
Route::get('/', [CarController::class,"showAll"]);

//? Cart Routes

Route::get('cart', [CarController::class, 'cart'])->name('cart');
Route::get('add-to-cart/{id}', [CarController::class, 'addToCart'])->name('add.to.cart');
Route::patch('update-cart', [CarController::class, 'updateCart'])->name('update.cart');
Route::delete('remove-from-cart', [CarController::class, 'removeCart'])->name('remove.from.cart');

//? Car Routes
Route::get('/cars', [CarController::class,"list"]);
Route::get('/car/create', [CarController::class,"create"]);
Route::post('/car/store', [CarController::class,"store"]);
Route::patch('/car/update/{car}', [CarController::class, "update"]);
Route::get('/car/edit/{id}', [CarController::class, "edit"]);
Route::delete('/car/delete/{car}', [CarController::class, "delete"]);

//? Category Routes
Route::get('/categories', [CategoryController::class, "index"]);
Route::get('/category/create', [CategoryController::class,"create"]);
Route::post('/category/store', [CategoryController::class,"store"]);
Route::patch('/category/update/{category}', [CategoryController::class,"update"]);
Route::get('/category/edit/{id}', [CategoryController::class,"edit"]);
Route::delete('/category/delete/{category}', [CategoryController::class,"delete"]);

//? Auth Routes
Route::get('/login', [AuthController::class,"loginView"]);
Route::get('/register', [AuthController::class,"registerView"]);
Route::post('/do-login', [AuthController::class,"doLogin"]);
Route::post('/do-register', [AuthController::class,"doRegister"]);
Route::get('/dashboard', [AuthController::class,"dashboard"]);
Route::get('/logout', [AuthController::class,"logout"]);
