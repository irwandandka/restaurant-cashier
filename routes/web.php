<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CashierController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\OwnerController;
use App\Models\Category;
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
    });

    Route::middleware('checkRole:cashier')->prefix('cashier')->group(function() {
        Route::get('/dashboard', [CashierController::class, 'index'])->name('cashier.dashboard');
    });

    Route::resource('category', CategoryController::class);
    Route::resource('food', FoodController::class);
});

