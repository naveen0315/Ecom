<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;
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
Route::get('/', function(){
    return view('index');

});

Auth::routes();

// Admin Dashboard Routes Start
Route::prefix('/')->middleware(['auth','isAdmin'])->group(function(){

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // Add Brand Route
    Route::get('/brands', [App\Http\Controllers\BrandController::class, 'index'])->name('brands');
    Route::post('/brands', [App\Http\Controllers\BrandController::class, 'AddBrands'])->name('brands');

    // Add Products Category Route
    Route::get('/category', [App\Http\Controllers\CategoryController::class, 'index'])->name('category');
    Route::post('/category', [App\Http\Controllers\CategoryController::class, 'AddCategory'])->name('category');

    // Add Products Route
    Route::get('/products', [App\Http\Controllers\ProductsController::class, 'index'])->name('products');
    Route::post('/products', [App\Http\Controllers\ProductsController::class, 'Addproducts'])->name('products');
    Route::get('/allproducts', [App\Http\Controllers\ProductsController::class, 'Products'])->name('allproducts');

    // Admin Profile Edit
    Route::get('/adminProfile/{id}', [App\Http\Controllers\UserController::class, 'profile'])->name('adminProfile');
    Route::post('/adminProfile/{id}', [App\Http\Controllers\UserController::class, 'editprofile'])->name('adminProfile');

    // Add New User
    // Route::get('/addUser', [App\Http\Controllers\UserController::class, 'newUserShow']);
    Route::post('/addUser', [App\Http\Controllers\UserController::class, 'newUser']);

    // Admin Orders
    Route::get('/orders', [App\Http\Controllers\OrderController::class, 'index'])->name('orders');

    // All User and Edit User Status
    Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('users');
    Route::get('/changeStatus', [App\Http\Controllers\UserController::class, 'changeStatus'])->name('users');

    //Delete Products/Brand/Category
    Route::get('/deleteProducts/{id}',[App\Http\Controllers\ProductsController::class, 'delete'])->name('deleteProducts');
    // Brand
    Route::get('/deleteBrands/{id}',[App\Http\Controllers\BrandController::class, 'delete'])->name('deleteProducts');
    // Category
    Route::get('/deleteCategory/{id}',[App\Http\Controllers\CategoryController::class, 'delete'])->name('deleteProducts');

    // // Edit Products/Brand/Category
    Route::get('/editBrands/{id}',[App\Http\Controllers\BrandController::class, 'showBrand'])->name('editBrands');
    Route::post('/editBrands/{id}',[App\Http\Controllers\BrandController::class, 'editBrand'])->name('editBrands');

    // Category
    Route::get('/editCategory/{id}',[App\Http\Controllers\CategoryController::class, 'showCategory'])->name('editCategory');
    Route::post('/editCategory/{id}',[App\Http\Controllers\CategoryController::class, 'editCategory'])->name('editCategory');

    // // Products
    Route::get('/editProducts/{id}',[App\Http\Controllers\ProductsController::class, 'showProduct'])->name('editProducts');
    Route::post('/editProducts/{id}',[App\Http\Controllers\ProductsController::class, 'editProduct'])->name('editProducts');

    // Product Details Route
    Route::get('/adminProductView/{id}', [App\Http\Controllers\ProductsController::class, 'view'])->name('ProductView');

    // Admin Shopping Cart Route
    Route::get('/adminCart', [App\Http\Controllers\ProductsController::class, 'cart'])->name('adminCart');

    Route::get('/editOrder/{id}', [App\Http\Controllers\OrderController::class, 'ShowEditOrders']);
    Route::post('/editOrder/{id}', [App\Http\Controllers\OrderController::class, 'editOrders']);

    Route::get('/payments', [App\Http\Controllers\PaymentController::class, 'index']);
    // Route::get('/editPayments/{id}', [App\Http\Controllers\PaymentController::class, 'ShowEditpayments']);
    // Route::post('/editPayments/{id}', [App\Http\Controllers\PaymentController::class, 'editpayments']);


});

// User Dashboard Profile
Route::prefix('/')->middleware(['auth','isUser'])->group(function(){

    Route::get('/userProfile/{id}', [App\Http\Controllers\UserProfileController::class, 'UserProfile']);
    Route::post('/userProfile/{id}', [App\Http\Controllers\UserProfileController::class, 'editUserProfile']);

});

//Dashboard Routes Start
Route::group([], function()
{
    Route::get('/', [App\Http\Controllers\IndexController::class, 'AllProducts']);
    Route::get('/AllProducts', [App\Http\Controllers\IndexController::class, 'index']);
    Route::get('/ProductView/{id}', [App\Http\Controllers\IndexController::class, 'view']);

    Route::get('/Cart', [App\Http\Controllers\ProductsController::class, 'userCart'])->name('Cart');

    Route::get('load-cart-data', [App\Http\Controllers\CheckoutController::class, 'cartcount']);
    Route::get('load-wish-data', [App\Http\Controllers\WishlistController::class, 'wishcount']);

    Route::get('/addToCart/{id}', [App\Http\Controllers\CheckoutController::class, 'AddToCart'])->name('Cart');

    Route::post('/updateCart', [App\Http\Controllers\CheckoutController::class, 'update'])->name('updateCart');

    Route::get('removeCart/{id}', [App\Http\Controllers\CheckoutController::class, 'remove']);

    Route::get('checkout', [App\Http\Controllers\CheckoutController::class, 'checkoutCart']);

    Route::get('/useraddress', [App\Http\Controllers\CheckoutController::class, 'address']);
    Route::post('/userAddess', [App\Http\Controllers\CheckoutController::class, 'userAddesses']);

    Route::get('/placeOrder', [App\Http\Controllers\CheckoutController::class, 'orderPlace']);
    Route::post('/placeOrder', [App\Http\Controllers\CheckoutController::class, 'afterPayment']);

    // Route::post('/userAddess', [App\Http\Controllers\CheckoutController::class, 'userAddesses']);

    Route::get('/thanks', [App\Http\Controllers\CheckoutController::class, 'Thanku']);

    Route::get('/userOrders', [App\Http\Controllers\OrderController::class, 'UserOrder']);
    Route::get('/orderView/{id}', [App\Http\Controllers\OrderController::class, 'view']);

    Route::get('/buyNow/{id}', [App\Http\Controllers\OrderController::class, 'buy']);

    Route::get('/returnOrder/{id}', [App\Http\Controllers\OrderController::class, 'OrderReturn']);
    Route::post('/returnOrder/{id}', [App\Http\Controllers\OrderController::class, 'returnedOrder']);

    Route::get('/orderCancel/{id}', [App\Http\Controllers\OrderController::class, 'OrderCancel']);

    Route::get('/wishlist', [App\Http\Controllers\WishlistController::class, 'wish']);
    Route::get('/addwishlist/{id}', [App\Http\Controllers\WishlistController::class, 'addWish']);
    Route::get('/removeWish/{id}', [App\Http\Controllers\WishlistController::class, 'wishRemove']);


    Route::get('/userAddress/{id}', [App\Http\Controllers\UserProfileController::class, 'index']);
    Route::post('/userAddress/{id}', [App\Http\Controllers\UserProfileController::class, 'editUserAddress']);
    Route::post('/addUserAddress', [App\Http\Controllers\UserProfileController::class, 'AddAddress']);


    // Route::get('lang/home', [App\Http\Controllers\LangController::class, 'index']);
    // Route::get('lang/change', [App\Http\Controllers\LangController::class, 'change'])->name('changeLang');

});


