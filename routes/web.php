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
    ///Admin
    Route::get('manage/admin', 'AdminController@index')->name('manage.admin');
    Route::get('manage/admin/add', 'AdminController@add')->name('manage.admin.create');
    Route::get('manage/admin/edit', 'AdminController@edit')->name('manage.admin.edit');

    ///Produk
    Route::get('manage/produk', 'ProductController@index')->name('manage.product');
    Route::get('manage/produk/add', 'ProductController@add')->name('manage.product.create');
    Route::get('manage/produk/edit', 'ProductController@edit')->name('manage.product.edit');

    ///Produk Kategori
    Route::get('manage/produk-kategori', 'ProductCategoryController@index')->name('manage.produkkategori');
    Route::get('manage/produk-kategori/add', 'ProductCategoryController@add')->name('manage.produkkategori.create');
    Route::get('manage/produk-kategori/edit', 'ProductCategoryController@edit')->name('manage.produkkategori.edit');

    ///Kontak
    Route::get('manage/kontak', 'KontakController@index')->name('manage.kontak');
    Route::get('manage/kontak/add', 'KontakController@add')->name('manage.kontak.create');
    Route::get('manage/kontak/edit', 'KontakController@edit')->name('manage.kontak.edit');

    ///Sosmed
    Route::get('manage/sosmed', 'SosmedController@index')->name('manage.sosmed');
    Route::get('manage/sosmed/add', 'SosmedController@add')->name('manage.sosmed.create');
    Route::get('manage/sosmed/edit', 'SosmedController@edit')->name('manage.sosmed.edit');
});


/////////////// PUBLIC - COMMON USER ///////////////////
Route::namespace('Frontend')->group(function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('tentang-kami', 'AboutController@index')->name('about');
    Route::get('produk', 'ProductController@index')->name('product');
    Route::get('kategori-produk', 'ProductCateghoryController@index')->name('product_categhory');
    Route::get('kategori-produk/{slug}', 'ProductCateghoryController@detail')->name('detail_categhory');
});
