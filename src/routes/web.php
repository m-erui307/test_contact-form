<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AuthController;

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



Route::get('/', [ContactController::class, 'index']);

Route::post('/contacts/confirm', [ContactController::class, 'confirm']);
Route::post('/contacts', [ContactController::class, 'store']);

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'showRegisterForm']);
Route::post('/register', [AuthController::class, 'register']);

Route::middleware('auth')->group(function () {
    Route::get('/admin', [ContactController::class, 'admin'])->name('admin');
});

Route::get('/contacts/search', [ContactController::class, 'search']);
Route::delete('/contacts/{id}', [ContactController::class, 'destroy'])->name('contacts.destroy');