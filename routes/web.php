<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\WebhookController;

Route::get('/', [ProductController::class, 'index']);
Route::resource('products', ProductController::class);
Route::get('cart', [OrderController::class, 'cart'])->name('cart');
Route::post('cart/add', [OrderController::class, 'addToCart'])->name('cart.add');
Route::post('cart/remove', [OrderController::class, 'removeFromCart'])->name('cart.remove');
Route::get('checkout', [OrderController::class, 'checkout'])->name('checkout');
Route::post('order', [OrderController::class, 'store'])->name('order.store');
Route::post('/webhook/order', [WebhookController::class, 'handle']);
