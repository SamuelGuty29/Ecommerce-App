<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;


Auth::routes();
Route::get('/', [ProductController::class, 'home'])->name('products.home');

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::group(['middleware' => ['auth']], function () {

	// Users
	Route::group(['prefix' => 'users', 'middleware' => ['role:admin'], 'controller' => UserController::class], function () {
		Route::get('/', 'index')->name('users.index')->middleware('can:users.index');
		Route::get('/create', 'create')->name('users.create')->middleware('can:users.create');
		Route::post('/store', 'store')->name('users.store')->middleware('can:users.store');
		Route::post('/update/{user}', 'update')->name('users.update')->middleware('can:users.update');
		Route::get('/{user}/edit', 'edit')->name('users.edit')->middleware('can:users.edit');
		Route::delete('/{user}', 'destroy')->name('users.destroy')->middleware('can:users.destroy');
	});

	// Products
	Route::group(['prefix' => 'products', 'controller' => ProductController::class], function () {
		Route::get('/', 'index')->name('products.index')->middleware('can:products.index');
		Route::get('/create', 'create')->name('products.create')->middleware('can:products.create');
		Route::post('/store', 'store')->name('products.store')->middleware('can:products.store');
		Route::post('/update/{product}', 'update')->name('products.update')->middleware('can:products.update');
		Route::get('/{product}/edit', 'edit')->name('products.edit')->middleware('can:products.edit');
		Route::delete('/{product}', 'destroy')->name('products.destroy')->middleware('can:products.destroy');
	});

	// Category
	Route::group(['prefix' => 'categories', 'controller' => CategoryController::class], function () {
		Route::get('/', 'index')->name('categories.index')->middleware('can:categories.index');
		Route::get('/create', 'create')->name('categories.create')->middleware('can:categories.create');
		Route::post('/', 'store')->name('categories.store')->middleware('can:categories.store');
		Route::get('/{category}/edit', 'edit')->name('categories.edit')->middleware('can:categories.edit');
		Route::put('/{category}', 'update')->name('categories.update')->middleware('can:categories.update');
		Route::delete('/{category}', 'destroy')->name('categories.destroy')->middleware('can:categories.destroy');
	});
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
