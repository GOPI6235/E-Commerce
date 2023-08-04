<?php

use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Frontend\RazorpayController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',[App\Http\Controllers\Frontend\FrontendController::class,'index']);
Route::get('category',[App\Http\Controllers\Frontend\FrontendController::class,'category']);
Route::get('view-category/{slug}',[App\Http\Controllers\Frontend\FrontendController::class,'viewcategory']);
Route::get('category/{cate_slug}/{prod_slug}',[App\Http\Controllers\Frontend\FrontendController::class,'productview'])->name('product');
Route::get('/product/{slug}', [App\Http\Controllers\Frontend\ProductController::class,'show'])->name('product.show');

Route::get('product-list',[App\Http\Controllers\Frontend\FrontendController::class,'productlistajax']);
Route::post('searchproduct',[App\Http\Controllers\Frontend\FrontendController::class,'searchproduct']);
Route::get('/product-quick-view/{id}', [App\Http\Controllers\Frontend\ProductController::class, 'quickView']);


Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// addtocart
Route::get('load-cart-data',[App\Http\Controllers\Frontend\CartController::class,'cartcount']);


Route::post('/add-to-cart',[App\Http\Controllers\Frontend\CartController::class,'addproduct']);
Route::post('delete-cart-item',[App\Http\Controllers\Frontend\CartController::class,'deleteproduct']);
Route::post('update-cart',[App\Http\Controllers\Frontend\CartController::class,'updatecart']);

Route::post('/add-to-wishlist', [App\Http\Controllers\Frontend\WishlistController::class, 'add']);
Route::post('/delete-wishlist-item', [App\Http\Controllers\Frontend\WishlistController::class, 'delete']);



Route::middleware(['auth'])->group(function(){
    Route::get('cart',[App\Http\Controllers\Frontend\CartController::class,'viewcart']);
    Route::get('checkout',[App\Http\Controllers\Frontend\CheckoutController::class,'index']);
    Route::post('place-order', [App\Http\Controllers\Frontend\CheckoutController::class,'placeorder']);

    Route::get('my-orders', [App\Http\Controllers\Frontend\UserController::class,'index']);
    Route::get('view-order/{id}', [App\Http\Controllers\Frontend\UserController::class,'view']);

    // Route::post('proceed-to-pay',[App\Http\Controllers\Frontend\CheckoutController::class,'razorpaycheck']);

    Route::post('razorpay-payment',[RazorpayController::class,'store'])->name('razorpay.payment.store');
    Route::post('add-rating',[App\Http\Controllers\Frontend\RatingController::class,'add']);

    Route::get('wishlist', [App\Http\Controllers\Frontend\WishlistController::class,'index']);
    
});


Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\FrontentController::class,'index']);
    // category
    Route::get('categories',[App\Http\Controllers\Admin\CatogoryController::class,'index']);
    Route::get('add-category',[App\Http\Controllers\Admin\CatogoryController::class,'add']);
    // Route::post('insert-category',[App\Http\Controllers\Admin\CatogoryController::class,'insert']);
    // category edit and delete
    Route::get('edit-category/{id}',[App\Http\Controllers\Admin\CatogoryController::class,'edit']);
    Route::put('update-category/{id}',[App\Http\Controllers\Admin\CatogoryController::class,'update']);
    Route::get('delete-category/{id}',[App\Http\Controllers\Admin\CatogoryController::class,'destroy']);
    // Subcategory
    Route::get('sub-category',[App\Http\Controllers\Admin\SubCategoryController::class,'index']);
    Route::get('add-subcategory',[App\Http\Controllers\Admin\SubCategoryController::class,'create']);
    // Route::post('insert-category',[App\Http\Controllers\Admin\SubCategoryController::class,'store']);
    // Subcategory edit and delete
    Route::get('edit-subcategory/{id}',[App\Http\Controllers\Admin\SubCategoryController::class,'edit']);
    Route::put('update-subcategory/{id}',[App\Http\Controllers\Admin\SubCategoryController::class,'update']);
    Route::get('delete-subcategory/{id}',[App\Http\Controllers\Admin\SubCategoryController::class,'destroy']);
    //product
    Route::get('products',[App\Http\Controllers\Admin\ProductController::class,'index']);
    Route::get('add-product',[App\Http\Controllers\Admin\ProductController::class,'add']);
    Route::post('insert-product',[App\Http\Controllers\Admin\ProductController::class,'insert']);
    //product Edit and Delete
    Route::get('edit-product/{id}',[App\Http\Controllers\Admin\ProductController::class,'edit']);
    Route::put('update-product/{id}',[App\Http\Controllers\Admin\ProductController::class,'update']);
    Route::get('delete-product/{id}',[App\Http\Controllers\Admin\ProductController::class,'destroy']);
    
    Route::get('orders',[App\Http\Controllers\Admin\OrderController::class,'index']);
    Route::get('admin/view-order/{id}',[App\Http\Controllers\Admin\OrderController::class,'view']);
    Route::put('update-order/{id}',[App\Http\Controllers\Admin\OrderController::class,'updateorder']);
    Route::get('order-history',[App\Http\Controllers\Admin\OrderController::class,'orderhistory']);

    Route::get('users',[App\Http\Controllers\Admin\DashboardController::class,'users']);
    Route::get('view-user/{id}',[App\Http\Controllers\Admin\DashboardController::class,'viewuser']);
});
 
//Google login
Route::get('login/google',[App\Http\Controllers\Auth\LoginController::class,'retirectToGoogle'])->name('login.google');
Route::get('login/google/callback',[App\Http\Controllers\Auth\LoginController::class,'handleGoogleCallback']);

//Facebook login
Route::get('login/facebook',[App\Http\Controllers\Auth\LoginController::class,'retirectToFacebook'])->name('login.facebook');
Route::get('login/facebook/callback',[App\Http\Controllers\Auth\LoginController::class,'handleFacebookCallback']);

//Github login
Route::get('login/github',[App\Http\Controllers\Auth\LoginController::class,'retirectToGithub'])->name('login.github');
Route::get('login/github/callback',[App\Http\Controllers\Auth\LoginController::class,'handleGithubCallback']);
