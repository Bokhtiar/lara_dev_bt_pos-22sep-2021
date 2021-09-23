<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SubcategoryController;
use App\Models\Subcategory;

Route::get('/', function () {
    return view('welcome');
})->middleware('auth');

//register route is disable another route is active
Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//category
Route::resource('category', CategoryController::class);
Route::get('/category/status/{id}', [App\Http\Controllers\CategoryController::class, 'status'])->name('category.status');

//subcategory
Route::resource('subcategory', SubcategoryController::class);
Route::get('/subcategory/status/{id}', [App\Http\Controllers\SubcategoryController::class, 'status'])->name('subcategory.status');

//brand
Route::resource('brand', BrandController::class);
Route::get('/brand/status/{id}', [App\Http\Controllers\BrandController::class, 'status'])->name('brand.status');

//setting
Route::get('/subAdmin/index', [SettingController::class, 'index'])->name('subAdmin.index');
Route::get('/subAdmin/create', [SettingController::class, 'create'])->name('subAdmin.create');
Route::post('/subAdmin/store', [SettingController::class, 'store'])->name('subAdmin.store');
Route::get('/subAdmin/delete/{id}', [SettingController::class, 'destroy'])->name('subAdmin.delete');