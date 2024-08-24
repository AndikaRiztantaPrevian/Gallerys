<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LikeController;
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

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'edit')->name('profile.edit');
        Route::patch('/profile', 'update')->name('profile.update');
        Route::delete('/profile', 'destroy')->name('profile.destroy');
        Route::post('/profile', 'photoStore')->name('profile.photoStore');
        Route::put('/profile', 'photoUpdate')->name('profile.photoUpdate');
    });

    Route::controller(PostController::class)->group(function () {
        Route::get('post', 'index')->name('post.index');
        Route::post('post/store', 'store')->name('post.store');
        Route::get('post/show/{post}', 'show')->name('post.show');
        Route::get('post/edit/{post}', 'edit')->name('post.edit');
        Route::put('post/update/{post}', 'update')->name('post.update');
        Route::get('post/getData', 'getData')->name('post.getData');
        Route::delete('post/destroy/{post}', 'destroy')->name('post.destroy');
    });

    Route::controller(LikeController::class)->group(function () {
        Route::post('like/store', 'store')->name('like.store');
        Route::delete('like/delete/{like}', 'destroy')->name('like.destroy');
    });

    Route::controller(AlbumController::class)->group(function () {
        Route::post('album/store', 'store')->name('album.store');
        Route::post('album/update', 'update')->name('album.update');
        Route::delete('album/delete/{album}', 'destroy')->name('album.destroy');
    });

    Route::controller(CommentController::class)->group(function () {
        Route::post('comment/store', 'store')->name('comment.store');
        Route::put('comment/update/{comment}', 'update')->name('comment.update');
        Route::delete('comment/destroy/{comment}', 'destroy')->name('comment.destory');
    });
});

require __DIR__ . '/auth.php';
