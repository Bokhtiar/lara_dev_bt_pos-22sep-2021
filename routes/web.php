<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->middleware('auth');

//register route is disable another route is active
Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//category
Route::resource('category', CategoryController::class);