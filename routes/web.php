<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SiteController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Route::get('/', [PostController::class, 'index'])->name('home');
Route::get('/', [PostController::class, 'home'])->name('home');
Route::get('/all', [PostController::class, 'index'])->name('all');
Route::get('/about-us', [SiteController::class, 'about'])->name('about-us');
Route::get('/search', [PostController::class, 'search'])->name('search');

Route::get('/category/{category:slug}', [PostController::class, 'byCategory'])->name('post.byCategory');
Route::get('/{post:slug}', [PostController::class, 'show'])->name('post.show');