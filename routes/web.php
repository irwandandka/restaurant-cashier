<?php

use App\Http\Controllers\{AuthController, CashierController, CategoryController, FoodController, OwnerController, SettingController, TableController, TransactionController, UserController};
use App\Http\Livewire\Order;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('login', [AuthController::class, 'login'])->name('post-login');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');
Route::middleware(['auth'])->group(function() {
    Route::middleware('checkRole:owner')->prefix('owner')->group(function() {
        Route::get('/dashboard', [OwnerController::class, 'index'])->name('owner.dashboard');
        Route::resource('user', UserController::class);
        Route::resource('setting', SettingController::class);
    });

    Route::middleware('checkRole:cashier')->prefix('cashier')->group(function() {
        Route::get('/dashboard', [CashierController::class, 'index'])->name('cashier.dashboard');
    });

    Route::resource('category', CategoryController::class);
    Route::resource('food', FoodController::class);
    Route::resource('table', TableController::class);
    Route::get('order', Order::class)->name('order');
    Route::get('transaction', [TransactionController::class, 'index'])->name('transaction.index');
    Route::delete('transaction/{order}', [TransactionController::class, 'destroy'])->name('transaction.destroy');
});

