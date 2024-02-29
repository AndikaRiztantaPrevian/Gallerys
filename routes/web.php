<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
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

    Route::resource('like', LikeController::class);
    Route::resource('notification', NotificationController::class);
    Route::resource('album', AlbumController::class);
    Route::resource('comment', CommentController::class);
    
    Route::controller(PostController::class)->group(function () {
        Route::get('post', 'index')->name('post.index');
        Route::post('post/store', 'store')->name('post.store');
        Route::post('post/update/{post}', 'update')->name('post.update');
        Route::delete('post/destroy/{post}', 'destroy')->name('post.destroy');
        Route::get('post/getData', 'getData')->name('post.getData');
    });
});

require __DIR__.'/auth.php';
