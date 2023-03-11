<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

// Auth::routes(['register' => false]);

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

// Admin dashboard

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('/', [AdminController::class, 'admin'])->name('admin');
});

// Banner
Route::resource('/banner', BannerController::class);
Route::post('banner_status', [BannerController::class, 'bannerStatus'])->name('banner.status');

// Category
Route::resource('/category', CategoryController::class);
Route::post('category_status', [CategoryController::class, 'categoryStatus'])->name('category.status');

// Brand
Route::resource('/brand', BrandController::class);
Route::post('brand_status', [BrandController::class, 'brandStatus'])->name('brand.status');

// Product
Route::resource('/product', ProductController::class);
Route::post('product_status', [ProductController::class, 'productStatus'])->name('product.status');
