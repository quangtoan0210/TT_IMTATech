<?php

use App\Http\Controllers\Client\AuthController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\HistoryController;

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
//login 
Route::get('/login', [AuthController::class,'showFormLogin'])->name('formLogin');
Route::post('/login', [AuthController::class,'login'])->name('login');

Route::get('/register', [AuthController::class,'showFormRegister'])->name('formRegister');
Route::post('/register', [AuthController::class,'register'])->name('register');
Route::post('/logout', [AuthController::class,'logout'])->name('logout');

//Login Google
Route::get('/login/google', [AuthController::class,'redirectToGoogle'])->name('login.google');
Route::get('/login/google/callback', [AuthController::class,'handleGoogleCallback']);


//Home
Route::get('/', [HomeController::class,'index'])->name('home');
Route::get('/shop', [HomeController::class,'shop'])->name('shop');
Route::get('/contact', [HomeController::class,'contact'])->name('contact');
Route::get('/products/search', [HomeController::class, 'search'])->name('products.search');
Route::get('/shop/category/{iddm}', [HomeController::class, 'shopByCategory'])->name('shop.category');
Route::get('/product/{id}/detail', [HomeController::class, 'detail'])->name('product.detail');


//Cart
Route::get('/cart', [CartController::class, 'cart'])->name('cart');
Route::get('/add-to-cart/{product_id}', [CartController::class, 'addToCart'])->name('add-to-cart');
Route::get('qty-increment/{rowId}',  [CartController::class, 'qtyIncrement'])->name('qty-increment');
Route::get('qty-decrement/{rowId}',  [CartController::class, 'qtyDecrement'])->name('qty-decrement');
Route::get('remove-product/{rowId}',  [CartController::class, 'removeProduct'])->name('remove-product');
Route::post('/cart/apply-voucher', [CartController::class, 'applyVoucher'])->name('cart.applyVoucher');

//Order
Route::middleware(['auth'])->group(function () {
    Route::get('/orders',[HistoryController::class,'index'])->name('orders.index');
    Route::post('/orders/{id}/cancel', [HistoryController::class, 'cancel'])->name('orders.cancel');
});

// web.php
Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout')->middleware('auth');
Route::post('/checkout', [CartController::class, 'processCheckout'])->name('processCheckout');
Route::get('/thankyou', function () {
    return view('client.layouts.thankyou');
})->name('thankyou');



