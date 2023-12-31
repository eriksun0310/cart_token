<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

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

//在這個Route才去使用 這'verified'的 middleware
// Route::group(
//     [
//         'middleware' => 'verified'
//     ],
//     function(){
//         Route::resource('fakeProducts', 'FakeProductController');
//     }
// );


Route::group([
    'middleware' =>'check.dirty'
], function(){
    Route::resource('products', 'ProductController');    
});
Route::get('/', function () {
    return view('welcome');
});


Route::post('signup', 'AuthController@signup');
Route::post('login', 'AuthController@login');
Route::group([
    'middleware' =>'auth:api' //  auth.api:原生用來檢查token的
],function(){
    Route::get('user', 'AuthController@user');
    Route::get('logout', 'AuthController@logout');
    //---------------------使用購物車,先經過token的檢查-------------------
    Route::post('carts/checkout', 'CartController@checkout');
    Route::resource('carts', 'CartController'); 
    Route::resource('cart_items', 'CartItemController');
});