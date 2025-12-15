<?php

use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController; 
use App\Http\Controllers\SignatureController;  
use App\Http\Controllers\PostCategoryController; 


Route::get('/', [ProductsController::class, 'index'])->name('products.index');
Route::get('/create-product', [ProductsController::class, 'create'])->name('products.create');
Route::post('/store-product', [ProductsController::class, 'store'])->name('products.store');
Route::get('/settings', [ProfileController::class,'index'])->name('profile.index');
Route::post('/add-user', [ProfileController::class,'update'])->name('profile.update');
Route::get('/view-users', [UserController::class, 'index'])->name('users.users');
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/create-post', [PostController::class, 'create'])->name('posts.create');
Route::post('/store-post', [PostController::class, 'store'])->name('posts.store');
Route::get('/create-post-category', [PostCategoryController::class, 'index'])->name('postscategories.index');
Route::post('/create-categories', [PostCategoryController::class, 'store'])->name('postscategories.store');
Route::delete('/comments/{comment}', [PostController::class, 'destroyComment'])->name('comments.destroy');
Route::post('/store-signatures', [SignatureController::class, 'store'])->name('signatures.store');
Route::get('/signatures', [SignatureController::class, 'index'])->name('signatures.index');