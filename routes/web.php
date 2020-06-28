<?php

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


Route::get('products', 'ProductController@index')->name('products.index');

Route::get('/search', 'ProductController@search')->name('products.search');

Route::get('products/cat_id={id}','ProductController@Cat_products')->name('cat_prod');


// Route::get('categories', 'CategoryController@index')->name('categories.index');
// Route::get('Admin/categories/create', 'CategoryController@create');
// Route::post('Admin/categories', 'CategoryController@store')->name('categories.store');
Route::resource('categories', 'CategoryController');

Route::group(['middleware' => ['auth']], function () {
    Route::post('Admin/products', 'ProductController@store')->name('products.store');
    Route::get('Admin/products/create', 'ProductController@create');
});

// Cart Routes
Route::get('cart', 'CartController@index')->name('cart.index');
Route::post('cart/add', 'CartController@store')->name('cart.store');
Route::patch('/cart/{rowId}/update', 'CartController@update')->name('cart.update');
Route::delete('cart/{rowId}', 'CartController@destroy')->name('cart.destroy');

Route::delete('cart/trash', 'CartController@deleteAll')->name('deleteAll');
    
// Route::post('cart/add', 'CartController@store')->name('cart.store');

Route::group(['middleware' => ['auth']], function () {

Route::resource('checkout', 'CheckoutController');
Route::get('thanks', 'CheckoutController@thanks')->name('checkout.thanks');
Route::post('/coupon', 'CartController@storeCoupon')->name('cart.store.coupon');
Route::delete('/coupon', 'CartController@destroyCoupon')->name('cart.destroy.coupon');

});


Route::get('contact', function(){
    return view('contact');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::group(['prefix' => 'admin'], function () {
    Route::get('/dash', function (){
        return view('Admin.dash');
    });
});
