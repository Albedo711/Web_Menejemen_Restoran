<?php

use Illuminate\Support\Facades\Route;
use App\http\Controllers\AuthController;
use App\http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
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

Route::get('home', [HomeController::class, 'index'])->name('home')->middleware('auth');



// Menampilkan form create category
Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');

// Menyimpan kategori
Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');

Route::get('/category', [CategoryController::class, 'index'])->name('category')->middleware('auth');
Route::delete('/category/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');



// Route untuk halaman profil
Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');


Route::resource('orders', OrderController::class);


Route::get('/menu', [MenuController::class, 'index'])->name('menu')->middleware('auth');

Route::resource('menus', MenuController::class);

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register',[AuthController::class, 'register'])->name('register');
Route::post('/register',[AuthController::class, 'registerPost'])->name('register');

Route::get('/login',[AuthController::class, 'login'])->name('login');
Route::post('/login',[AuthController::class, 'loginPost'])->name('login');