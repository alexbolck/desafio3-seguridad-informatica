<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NetworkController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->middleware('throttle:5,1');
Route::get('/register', function () { return view('register'); });
Route::post('/register', [LoginController::class, 'register']);
Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index']);

Route::get('/network/ping', [NetworkController::class, 'index']);
Route::post('/network/ping', [NetworkController::class, 'ping']);

Route::get('/comments', [CommentController::class, 'index']);
Route::post('/comments', [CommentController::class, 'store']);

Route::get('/profile/{id}', [ProfileController::class, 'show'])->middleware('auth');

Route::get('/files', [FileController::class, 'index']);
Route::post('/files', [FileController::class, 'upload']);
