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



/////////////// MANAGE - ADMIN ACCESS ///////////////////
Route::namespace('Manage')->group(function () {
    Auth::routes();
    Route::get('manage/product', 'ProductController@product')->name('product');
});
