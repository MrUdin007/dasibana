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

/////////////// MANAGE - ADMIN ACCESS ///////////////////
Auth::routes();
Route::namespace('Manage')->group(function () {
    Route::get('manage/produk', 'ProductController@index')->name('manage.product');
    Route::get('manage/admin', 'AdminController@index')->name('manage.admin');
    Route::get('manage/produk-kategori', 'ProductCategoryController@index')->name('manage.produkkategori');
    Route::get('manage/kontak', 'KontakController@index')->name('manage.kontak');
    Route::get('manage/sosmed', 'SosmedController@index')->name('manage.sosmed');
});


/////////////// PUBLIC - COMMON USER ///////////////////
Route::namespace('Frontend')->group(function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('tentang-kami', 'AboutController@index')->name('about');
    Route::get('produk', 'ProductController@index')->name('product');
    Route::get('kategori-produk', 'ProductCateghoryController@index')->name('product_categhory');
    Route::get('kategori-produk/{slug}', 'ProductCateghoryController@detail')->name('detail_categhory');
});
