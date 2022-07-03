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

/////////////// PUBLIC ///////////////////
//contoh static route -->data bukan dari database (hardcode)
// Route::get('/', function () {
//     return view('public.home');
// });

Auth::routes();

/////////////// MANAGE - ADMIN ACCESS ///////////////////
Route::namespace('Manage')->group(function () {
    Route::get('manage/product', 'ProductController@index')->name('product');
    Route::get('manage/admin', 'AdminController@index')->name('admin');
    Route::get('manage/produkkategori', 'ProductCategoryController@index')->name('produkkategori');
    Route::get('manage/kontak', 'KontakController@index')->name('kontak');
    Route::get('manage/sosmed', 'SosmedController@index')->name('sosmed');
});


/////////////// PUBLIC - COMMON USER ///////////////////
Route::namespace('Frontend')->group(function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/tentang-kami', 'AboutController@index')->name('about');
    Route::get('/produk', 'ProductController@index')->name('product');
    Route::get('/kategori-produk', 'ProductCateghoryController@index')->name('product_categhory');
});
