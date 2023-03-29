<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SiteController;

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

Route::get('/', [PostController::class, 'index'])->name('home');
Route::get('/about-me', [SiteController::class, 'about'])->name('about-me');

Route::get('/category/{category:slug}', [PostController::class, 'byCategory'])->name('post.byCategory');
Route::get('/{post:slug}', [PostController::class, 'show'])->name('post.show');