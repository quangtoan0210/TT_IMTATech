<?php

use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VoucherController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\DashboardController;
use App\Models\Category;
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

Route::middleware('authAdmin')->prefix('admin')->as('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    //Cateogory
    Route::get('/categories/trash', [CategoryController::class, 'trashed'])->name('categories.trashed');
    Route::get('/categories/{id}/restore', [CategoryController::class, 'restore'])->name('categories.restore');
    Route::delete('/categories/{id}/force-delete', [CategoryController::class, 'forcedelete'])->name('categories.force_delete');
    Route::resource('categories', CategoryController::class);
    //Product
    Route::resource('products', ProductController::class);
    //Banner
    Route::resource('banners', BannerController::class);
    //Vouhcer
    Route::resource('vouchers', VoucherController::class);

    //User
    Route::get('users', [UserController::class, 'index'])->name('users');
    Route::post('users/promote/{id}', [UserController::class, 'promoteToAdmin'])->name('promoteToAdmin');
    Route::post('users/demote/{id}', [UserController::class, 'demoteToUser'])->name('demoteToUser');
    Route::get('users/create', [UserController::class, 'create'])->name('create');
    Route::post('/users/store', [UserController::class, 'store'])->name('store');
    Route::delete('users/delete/{id}', [UserController::class, 'deleteUser'])->name('deleteUser');
    Route::post('user/{id}/lock', [UserController::class, 'lock'])->name('user.lock');
    Route::post('user/{id}/unlock', [UserController::class, 'unlock'])->name('user.unlock');
    // routes/web.php
    Route::get('export-users', [UserController::class, 'export'])->name('export.users');


    //Order
    Route::resource('orders', OrderController::class)->only([
        'index',
        'show'
    ]);
    // routes/web.php
    Route::patch('orders/{id}/status', [OrderController::class, 'updateStatus'])->name('updateStatus');
    // routes/web.php
    Route::get('orders/{id}/invoice', [OrderController::class, 'invoice'])->name('invoice');
    // routes/web.php

    Route::get('orders/{id}/pdf-invoice', [OrderController::class, 'pdfInvoice'])->name('pdfInvoice');
});
