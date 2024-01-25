<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/{userId}/charge', [UserController::class, 'showChargeForm'])->name('users.chargeForm');
Route::post('/users/{userId}/charge', [UserController::class, 'charge'])->name('users.charge');

Route::post('/users/{userId}/accrue-points', [UserController::class, 'accruePoints'])->name('users.accruePoints');
Route::post('/users/{userId}/redeem-points', [UserController::class, 'redeemPoints'])->name('users.redeemPoints');
Route::get('/users/{userId}/charge-history', [UserController::class, 'getUserChargeHistory'])->name('users.chargeHistory');
