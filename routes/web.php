<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SettingController;

Route::get('/', function () {
    return view('welcome');
})->middleware('auth');

//register route is disable another route is active
Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//category
Route::resource('category', CategoryController::class);

//setting
Route::get('/subAdmin/index', [SettingController::class, 'index'])->name('subAdmin.index');
Route::get('/subAdmin/create', [SettingController::class, 'create'])->name('subAdmin.create');
Route::post('/subAdmin/store', [SettingController::class, 'store'])->name('subAdmin.store');