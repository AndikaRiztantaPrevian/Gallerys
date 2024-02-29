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
    
    Route::controller(PostController::class)->group(function () {
        Route::get('post', 'index')->name('post.index');
        Route::post('post/store', 'store')->name('post.store');
        Route::post('post/update/{post}', 'update')->name('post.update');
        Route::get('post/getData', 'getData')->name('post.getData');
        Route::delete('post/destroy/{post}', 'destroy')->name('post.destroy');
    });

    Route::controller(LikeController::class)->group(function () {
        Route::post('like/store', 'store')->name('like.store');
        Route::post('like/delete/{like}', 'destroy')->name('like.destroy');
    });

    Route::controller(NotificationController::class)->group(function () {
        Route::post('notification/store', 'store')->name('notification.store');
        Route::post('notification/update/{notification}', 'update')->name('notification.update');
    });

    Route::controller(AlbumController::class)->group(function () {
        Route::post('album/store', 'store')->name('album.store');
        Route::post('album/update', 'update')->name('album.update');
    });

    Route::controller(CommentController::class)->group(function () {
        Route::post('comment/store', 'store')->name('comment.store');
        Route::delete('comment/delete', 'destroy')->name('comment.destory');
    });
});

require __DIR__.'/auth.php';
