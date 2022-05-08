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

//contoh static route -->data bukan dari database (hardcode)
Route::get('/', function () {
    return view('manage.product');
});
Route::get('admin', function () {
    return view('manage.admin.index');
});
Route::get('produk', function () {
    return view('manage.produk.index');
});

Auth::routes();

//contoh dynamic route -->data dari database
Route::get('/home', 'HomeController@index')->name('home');
