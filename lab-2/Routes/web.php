<?php

use App\Controllers\DashboardController;
use App\Controllers\LoginController;
use Src\Http\Route;

Route::get('/', "HomeController@index");
Route::get('/login', [LoginController::class, 'index']);
Route::get('/dashboard', [DashboardController::class, 'index']);
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout']);
Route::post('/update-email', [DashboardController::class, 'update_email']);
Route::get('/update-email', [DashboardController::class, 'update_email']);