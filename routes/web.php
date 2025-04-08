<?php

use App\Http\Controllers\backend\BrandController;
use App\Http\Controllers\backend\ColorController;
use App\Http\Controllers\backend\ProductColorController;
use App\Http\Controllers\backend\ProductController;
use App\Http\Controllers\backend\ProductFeaturesController;
use App\Http\Controllers\backend\ProductImageController;
use App\Http\Controllers\backend\SizeController;
use App\Http\Controllers\frontend\CartController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\frontend\IndexController as FrontendIndexController;
use App\Http\Controllers\backend\IndexController as BackendIndexController;
use App\Http\Controllers\backend\CategoryController;
use App\Http\Controllers\backend\UserController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// auth route
Route::get('/register', function () {return view('auth.register');})->name('register');
Route::get('/login', function () {return view('auth.login');})->name('login');

Route::get('/', [FrontendIndexController::class, 'index'])->name('frontend.index');
Route::get('/category/{slug}', [FrontendIndexController::class, 'categoryProducts'])->name('frontend.category.products');
Route::get('/product/{slug}', [FrontendIndexController::class, 'product'])->name('frontend.product');


Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(function () {
    Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('frontend-add-to-cart');
    Route::get('/delete-from-cart/{cartId}', [CartController::class, 'deleteFromCart'])->name('frontend-delete-from-cart');
});

Route::middleware(['auth','admin'])->prefix('dashboard')->group(function () {
    // dashboard
    Route::get('/', [BackendIndexController::class, 'index'])->name('backend.index');

    // users
    Route::get('/users', [UserController::class, 'index'])->name('backend.user.index');

    // category
    Route::get('/category', [CategoryController::class, 'index'])->name('backend.category.index');
    Route::post('/category/store', [CategoryController::class, 'store'])->name('backend.category.store');
    Route::get('/category/delete/{id}', [CategoryController::class, 'delete'])->name('backend.category.delete');
    Route::post('/category/update/{id}', [CategoryController::class, 'update'])->name('backend.category.update');

    // product
    Route::get('/product', [ProductController::class, 'index'])->name('backend.product.index');
    Route::post('/product/store', [ProductController::class, 'store'])->name('backend.product.store');
    Route::get('/product/delete/{id}', [ProductController::class, 'delete'])->name('backend.product.delete');
    Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('backend.product.edit');
    Route::post('/product/update/{id}', [ProductController::class, 'update'])->name('backend.product.update');
    Route::get('/product/update/detach-size/{sizeId}/{productId}', [ProductController::class, 'detachSize'])->name('backend.product.detachSize');
    Route::get('/images/{image}', [ProductController::class, 'showImage'])->name('backend.product.showImage');

    // product image
    Route::get('/product-image/delete/{id}', [ProductImageController::class, 'delete'])->name('backend.productImage.delete');

    // product color
    Route::get('/product-color/delete/{id}', [ProductColorController::class, 'delete'])->name('backend.productColor.delete');

    // product feature
    Route::get('/product-feature/delete/{id}', [ProductFeaturesController::class, 'delete'])->name('backend.productFeature.delete');

    // size
    Route::get('/size', [SizeController::class, 'index'])->name('backend.size.index');
    Route::post('/size/store', [SizeController::class, 'store'])->name('backend.size.store');
    Route::get('/size/delete/{id}', [SizeController::class, 'delete'])->name('backend.size.delete');
    Route::get('/size/edit/{id}', [SizeController::class, 'edit'])->name('backend.size.edit');
    Route::post('/size/update/{id}', [SizeController::class, 'update'])->name('backend.size.update');

    // brand
    Route::get('/brand', [BrandController::class, 'index'])->name('backend.brand.index');
    Route::post('/brand/store', [BrandController::class, 'create'])->name('backend.brand.store');
    Route::get('/brand/delete/{id}', [BrandController::class, 'delete'])->name('backend.brand.delete');
    Route::get('/brand/edit/{id}', [BrandController::class, 'edit'])->name('backend.brand.edit');
    Route::post('/brand/update/{id}', [BrandController::class, 'update'])->name('backend.brand.update');

    //color
    Route::get('/color', [ColorController::class, 'index'])->name('backend.color.index');
    Route::post('/color/store', [ColorController::class, 'store'])->name('backend.color.store');
    Route::get('/color/delete/{id}', [ColorController::class, 'delete'])->name('backend.color.delete');
    Route::post('/color/update/{id}', [ColorController::class, 'update'])->name('backend.color.update');

});


//Route::get('/{locale}', function ($locale = 'en'){
//    if(! in_array($locale, ['en', 'ru', 'uz'])) {
//        abort(400);
//    }
//    App::setLocale($locale);
//    return view('frontend.index');
//});
