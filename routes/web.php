<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserpageController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified' , 'roles:admin,moderator'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/userpage' , [ProductController::class , 'index'])->name('userpage');
Route::get('/showusers' , [ProductController::class , 'showusers'])->name('showusers');
Route::get('/userpage/product' , [ProductController::class , 'create'])->name('userpage.create')->middleware('roles:admin,moderator');

Route::resource('users', UserpageController::class)->middleware('roles:admin');

Route::post('/userpage/store' , [ProductController::class , 'store'])->middleware('roles:admin')->name('userpage.store');


Route::put('/userpage/update/{userId}', [RegisteredUserController::class, 'changeuser'])
    ->middleware('roles:admin')
    ->name('userpage.update');





Route::get('/cards' , [UserpageController::class , 'index2']);
Route::post('/cards/store' , [UserpageController::class , 'store'])->name('cards.store');

Route::post('/cart/decrement/{productId}', [UserpageController::class, 'decrementQuantity'])->name('cart.decrement');

require __DIR__.'/auth.php';
