<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NetworkController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/register', [LoginController::class, 'register']);

Route::get('/ping', [NetworkController::class, 'index']);
Route::post('/ping', [NetworkController::class, 'ping']);

Route::get('/comments', [CommentController::class, 'index']);
Route::post('/comments', [CommentController::class, 'store']);

Route::get('/profile/{id}', [ProfileController::class, 'show']);

Route::get('/files', [FileController::class, 'index']);
Route::post('/files', [FileController::class, 'upload']);
