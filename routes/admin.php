<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{
AuthController,
CartController,
CategoryController,
CommentController,
OrderController,
ProductController,
WishlistController
};

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/




Route::controller(AuthController::class)->prefix('auth/admin')->group(function () {
    Route::post('/login', 'login');
    Route::post('/logout', 'logout');
    Route::get('/profile', 'profile');
    Route::post('/deleteUser/{id}', 'deleteUser');
    Route::post('/updateProfile', 'updateProfile');

});

// CART
Route::controller(CartController::class)->middleware('auth:admin')->prefix('admin')->group(function () {
    Route::get('/getCarts', 'getCarts');
});
Route::controller(CartController::class)->middleware('auth:admin')->prefix('admin')->group(function () {
    Route::post('/desoryCart/{id}', 'desoryCart');
});
// CATEGORIES
Route::controller(CategoryController::class)->prefix('admin')->group(function () {
    Route::get('/getCats', 'getCats');
    Route::post('/storeCategory', 'storeCategory');
    Route::post('/updateCategory/{id}', 'updateCategory');
    Route::post('/desoryCategory/{id}', 'desoryCategory');
});
// COMMENTS
Route::controller(CommentController::class)->middleware('auth:admin')->prefix('admin')->group(function () {
    Route::get('/getComments', 'getComments');
    Route::post('/desoryComment/{id}', 'desoryComment');
});
// ORDERS
Route::controller(OrderController::class)->middleware('auth:admin')->prefix('admin')->group(function () {
    Route::get('/getOrders', 'getOrders');
    Route::post('/desoryOrder/{id}', 'desoryOrder');
});
// PRODUCTS
Route::controller(ProductController::class)->middleware('auth:admin')->prefix('admin')->group(function () {
    Route::get('/getProducts', 'getProducts');
    Route::post('/storetProduct', 'storetProduct');
    Route::post('/updatetProduct/{id}', 'updatetProduct');
    Route::post('/desorytProduct/{id}', 'desorytProduct');
});
// WISHLIST
Route::controller(WishlistController::class)->middleware('auth:admin')->prefix('admin')->group(function () {
    Route::get('/getWishlists', 'getWishlists');
    //cron job
    // Route::post('/notifyWishlist/{id}', 'desoryWishlist');
});

?>