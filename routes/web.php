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
    Route::middleware('auth.be')->prefix('manage')->namespace('Manage')->group(function () {
    ///Admin
    Route::get('admin', 'AdminController@index')->name('manage.admin');
    Route::get('admin/add', 'AdminController@add')->name('manage.admin.create');
    Route::get('admin/edit', 'AdminController@edit')->name('manage.admin.edit');

    ///Produk
    Route::get('produk', 'ProductController@index')->name('manage.product');
    Route::get('produk/add', 'ProductController@add')->name('manage.product.create');
    Route::get('produk/edit', 'ProductController@edit')->name('manage.product.edit');

    ///Produk Kategori
    Route::get('produk-kategori', 'ProductCategoryController@index')->name('manage.produkkategori');
    Route::get('produk-kategori/add', 'ProductCategoryController@add')->name('manage.produkkategori.create');
    Route::get('produk-kategori/edit', 'ProductCategoryController@edit')->name('manage.produkkategori.edit');

    ///Kontak
    Route::get('kontak', 'KontakController@index')->name('manage.kontak');
    Route::get('kontak/add', 'KontakController@add')->name('manage.kontak.create');
    Route::get('kontak/edit', 'KontakController@edit')->name('manage.kontak.edit');

    ///Sosmed
    Route::get('sosmed', 'SosmedController@index')->name('manage.sosmed');
    Route::get('sosmed/add', 'SosmedController@add')->name('manage.sosmed.create');
    Route::get('sosmed/edit', 'SosmedController@edit')->name('manage.sosmed.edit');
});


/////////////// PUBLIC - COMMON USER ///////////////////
Route::namespace('Frontend')->group(function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('tentang-kami', 'AboutController@index')->name('about');
    Route::get('produk', 'ProductController@index')->name('product');
    Route::get('kategori-produk', 'ProductCateghoryController@index')->name('product_categhory');
    Route::get('kategori-produk/{slug}', 'ProductCateghoryController@detail')->name('detail_categhory');
});
