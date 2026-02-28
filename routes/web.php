<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\PostsController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::post('/follow/create', [FollowController::class, 'create'])->name('follow.create');
    Route::delete('/follow/delete', [FollowController::class, 'delete'])->name('follow.delete');
});

Route::middleware('auth')->group(function () {
    Route::get('/posts', [PostsController::class, 'index'])->name('posts.index');
    Route::post('/posts', [PostsController::class, 'store'])->name('posts.store');
});
