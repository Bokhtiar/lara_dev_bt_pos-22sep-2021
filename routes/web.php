<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FitController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SellController;
use App\Http\Controllers\SellProductController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\TinController;
use App\Http\Controllers\TinVariantController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\WarrantyController;
use App\Models\Contact;
use App\Models\Order;
use App\Models\Product;
use App\Models\Sell;
use App\Models\Subcategory;
use App\Models\User;
use App\Models\Warranty;
use Facade\FlareClient\Report;

Route::get('/', function () {
    $product = Product::count();
    $contact = Contact::count();
    $user = User::count();
    $sell = Sell::count();
    $sells = Sell::latest()->get();
    return view('welcome', compact('product', 'contact', 'user', 'sell', 'sells'));

})->middleware('auth');
//register route is disable another route is active
Auth::routes();
//['register' => false]

Route::get('/pos', [App\Http\Controllers\PosController::class, 'index']);
Route::get('/search/product/{search_key}', [App\Http\Controllers\PosController::class, 'search']);

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

//Unit
Route::resource('unit', UnitController::class);

//warranty
Route::resource('warranty', WarrantyController::class);

//product
Route::resource('product', ProductController::class);
Route::get('aleart', [App\Http\Controllers\ProductController::class, 'aleart']);
Route::get('/all/data', [App\Http\Controllers\ProductController::class, 'product_all']);
Route::get('/category/product/{id}', [App\Http\Controllers\ProductController::class, 'category_product']);
Route::get('/product/status/{id}', [App\Http\Controllers\ProductController::class, 'status'])->name('product.status');
//tin fit
Route::resource('fit', FitController::class);
//tin variant
Route::resource('tinvariant', TinVariantController::class);
//tin
Route::resource('tin', TinController::class);
//setting
Route::get('/subAdmin/index', [SettingController::class, 'index'])->name('subAdmin.index');
Route::get('/subAdmin/create', [SettingController::class, 'create'])->name('subAdmin.create');
Route::post('/subAdmin/store', [SettingController::class, 'store'])->name('subAdmin.store');
Route::get('/subAdmin/delete/{id}', [SettingController::class, 'destroy'])->name('subAdmin.delete');
Route::get('/logout', [App\Http\Controllers\SettingController::class, 'logout']);

//purchase product
Route::resource('purchase', PurchaseController::class);
Route::post('/purchase/due/pay//{id}', [PurchaseController::class, 'duePay']);
Route::get('/product_purchase_search/{id}', [PurchaseController::class, 'product_show']);
Route::get('/purchae_edit_product/{id}', [PurchaseController::class, 'purchase_edit_product']);

Route::get('/purchase/date/filtering', [PurchaseController::class, 'purchase_date_filtering'])->name('purchase.date.filtering');
Route::post('/purchase/date/range/search', [PurchaseController::class, 'purchase_date_filtering_search'])->name('purchase.date.range.search');

//contact controller
Route::resource('contact', ContactController::class);
Route::get('/customer/index', [App\Http\Controllers\ContactController::class, 'customer_list'])->name('customer.index');
Route::get('/supplier/index', [App\Http\Controllers\ContactController::class, 'supplier_list'])->name('supplier.index');
Route::get('/contact/status/{id}', [App\Http\Controllers\ContactController::class, 'status'])->name('contact.status');
Route::get('/customer/info/{id}', [App\Http\Controllers\ContactController::class, 'customer_info']);


//sell product
Route::resource('sell', SellController::class);
Route::get('store/sell/{id}', [SellController::class, 'store']);
Route::post('sell/quantity/{id}', [SellController::class, 'quantity_update'])->name('sell.quantity');
Route::get('sell/author/all', [SellController::class, 'sell_author_all']);
Route::post('quantity-update/{id}', [SellController::class, 'quantity_update']);
Route::get('sell/delete/{id}', [SellController::class, 'destroy']);
Route::post('percentage-update/{id}', [SellController::class, 'discount_percentage']);
Route::get('/sell/product/search/{id}', [SellController::class, 'sell_product_show']);
Route::get('sell/status/{id}', [SellController::class, 'status'])->name('sell.status');

//order
Route::resource('order', OrderController::class);
Route::get('order/status/{id}', [OrderController::class, 'status'])->name('order.status');

//report
Route::get('day/report', [ReportController::class, 'day'])->name('day.report');
Route::get('month/report', [ReportController::class, 'month'])->name('month.report');
Route::get('week/report', [ReportController::class, 'week'])->name('week.report');
Route::get('year/report', [ReportController::class, 'year'])->name('year.report');
Route::get('date/range', [ReportController::class, 'date_range'])->name('date.range');
Route::post('date/range/search', [ReportController::class, 'date_range_search'])->name('date.range.search');

// permission
Route::get('permission/index', [PermissionController::class, 'index'])->name('permission.index');
Route::get('permission/create', [PermissionController::class, 'create'])->name('permission.create');
Route::post('permission/store', [PermissionController::class, 'store']);
Route::get('permission/edit/{id}', [PermissionController::class, 'edit']);
Route::post('permission/update/{id}', [PermissionController::class, 'update']);

//role
Route::resource('role', RoleController::class);

