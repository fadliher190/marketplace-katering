<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\Merchant\RegisterController;
use App\Http\Controllers\Merchant\DashboardController;
use App\Http\Controllers\Merchant\ProductController;

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

Route::get('/', [MainController::class, 'index'])->name('main.index');
Route::get('/{pluck}', [MainController::class, 'detail'])->name('main.detail');
Route::post('/buy-now', [MainController::class, 'buying'])->name('main.buying');
Route::get('/detail-order/{orderId}', [MainController::class, 'detailOrder'])->name('main.detail-order');
Route::post('/payment/{orderId}', [MainController::class, 'payment'])->name('main.payment');

Route::get('/auth/sign-in',[AuthController::class, 'signIn'])->name('auth.sign-in');
Route::get('/auth/sign-up',[AuthController::class, 'signUp'])->name('auth.sign-up');
Route::post('/auth/sign-in',[AuthController::class, 'signInAction'])->name('auth.sign-in.action');
Route::post('/auth/sign-up',[AuthController::class, 'signUpAction'])->name('auth.sign-up.action');

Route::middleware(['auth'])->group(function () {
    Route::prefix('merchant')->group(function () {
        Route::get('register', [RegisterController::class, 'index'])->name('merchant.register');
        Route::post('register', [RegisterController::class, 'store'])->name('merchant.register.action');
        Route::middleware(['auth.merchant'])->group(function () {
            Route::get('dashboard', [DashboardController::class, 'index'])->name('merchant.dashboard');
            Route::resource('product', ProductController::class, ['names' => 'merchant.product']);
        });
    });
});

