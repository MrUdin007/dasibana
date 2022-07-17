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
Route::prefix('manage')->namespace('Manage')->group(function () {
    ///Admin
    Route::get('admin','AdminController@index')->name('admin.index');
    Route::post('admin/getdata', 'AdminController@getData')->name('admin.getdata');
    Route::get('admin/add','AdminController@form')->name('admin.add');
    Route::post('admin/add','AdminController@save')->name('admin.add');
    Route::get('admin/edit/{id}','AdminController@form')->name('admin.edit');
    Route::post('admin/edit/{id}','AdminController@save')->name('admin.edit');
    Route::post('admin/delete/{id}','AdminController@delete')->name('admin.delete');
    Route::get('admin/view','AdminController@view')->name('admin.view');

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
    Route::get('sosmed','SosmedController@index')->name('sosmed.index');
    Route::post('sosmed/getdata', 'SosmedController@getData')->name('sosmed.getdata');
    Route::get('sosmed/add','SosmedController@form')->name('sosmed.add');
    Route::post('sosmed/add','SosmedController@save')->name('sosmed.add');
    Route::get('sosmed/edit/{id}','SosmedController@form')->name('sosmed.edit');
    Route::post('sosmed/edit/{id}','SosmedController@save')->name('sosmed.edit');
    Route::post('sosmed/delete/{id}','SosmedController@delete')->name('sosmed.delete');
    Route::get('sosmed/view','SosmedController@view')->name('sosmed.view');
});


/////////////// PUBLIC - COMMON USER ///////////////////
Route::namespace('Frontend')->group(function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('tentang-kami', 'AboutController@index')->name('about');
    Route::get('produk', 'ProductController@index')->name('product');
    Route::get('kategori-produk', 'ProductCateghoryController@index')->name('product_categhory');
    Route::get('kategori-produk/{slug}', 'ProductCateghoryController@detail')->name('detail_categhory');
});
