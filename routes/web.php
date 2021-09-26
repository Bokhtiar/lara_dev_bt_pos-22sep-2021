<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
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

//product
Route::resource('product', ProductController::class);
Route::get('/product/status/{id}', [App\Http\Controllers\ProductController::class, 'status'])->name('product.status');

//setting
Route::get('/subAdmin/index', [SettingController::class, 'index'])->name('subAdmin.index');
Route::get('/subAdmin/create', [SettingController::class, 'create'])->name('subAdmin.create');
Route::post('/subAdmin/store', [SettingController::class, 'store'])->name('subAdmin.store');
Route::get('/subAdmin/delete/{id}', [SettingController::class, 'destroy'])->name('subAdmin.delete');

//purchase product
Route::resource('purchase', PurchaseController::class);
Route::get('/product_purchase_search/{id}', [PurchaseController::class, 'show']);

//contact controller
Route::resource('contact', ContactController::class);
Route::get('/contact/status/{id}', [App\Http\Controllers\ContactController::class, 'status'])->name('contact.status');