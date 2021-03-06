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
Route::get('dashboard', function () {
    return view('manage.dashboard');
});

Auth::routes();
Route::prefix('manage')->namespace('Manage')->group(function () {
    ///Admin
    Route::get('admin','AdminController@index')->name('admin.index');
    Route::post('admin/getdata', 'AdminController@getData')->name('admin.getdata');
    Route::get('admin/edit/{id}','AdminController@form')->name('admin.edit');
    Route::post('admin/edit/{id}','AdminController@save')->name('admin.edit');
    Route::get('admin/view','AdminController@view')->name('admin.view');

    ///Produk
    Route::get('produk','ProductController@index')->name('produk.index');
    Route::post('produk/getdata', 'ProductController@getData')->name('produk.getdata');
    Route::get('produk/add','ProductController@form')->name('produk.add');
    Route::post('produk/add','ProductController@save')->name('produk.add');
    Route::get('produk/edit/{id}','ProductController@form')->name('produk.edit');
    Route::post('produk/edit/{id}','ProductController@save')->name('produk.edit');
    Route::post('produk/delete/{id}','ProductController@delete')->name('produk.delete');
    Route::get('produk/view','ProductController@view')->name('produk.view');

    ///Produk Kategori
    Route::get('kategori_produk','ProductCategoryController@index')->name('produkkategori.index');
    Route::post('kategori_produk/getdata', 'ProductCategoryController@getData')->name('produkkategori.getdata');
    Route::get('kategori_produk/add','ProductCategoryController@form')->name('produkkategori.add');
    Route::post('kategori_produk/add','ProductCategoryController@save')->name('produkkategori.add');
    Route::get('kategori_produk/edit/{id}','ProductCategoryController@form')->name('produkkategori.edit');
    Route::post('kategori_produk/edit/{id}','ProductCategoryController@save')->name('produkkategori.edit');
    Route::post('kategori_produk/delete/{id}','ProductCategoryController@delete')->name('produkkategori.delete');
    Route::get('kategori_produk/view','ProductCategoryController@view')->name('produkkategori.view');

    ///Kontak
    Route::get('kontak','KontakController@index')->name('kontak.index');
    Route::post('kontak/getdata', 'KontakController@getData')->name('kontak.getdata');
    Route::get('kontak/add','KontakController@form')->name('kontak.add');
    Route::post('kontak/add','KontakController@save')->name('kontak.add');
    Route::get('kontak/edit/{id}','KontakController@form')->name('kontak.edit');
    Route::post('kontak/edit/{id}','KontakController@save')->name('kontak.edit');
    Route::get('kontak/view','KontakController@view')->name('kontak.view');

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
