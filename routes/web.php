<?php

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





Auth::routes();

Route::get('/', 'ProductController@read')->middleware('auth');

Route::get('/add-product', function (){
    return view('addProduct');
})->middleware('auth');

Route::get('product/{id}/{userId}', "productController@show")->middleware("auth");
Route::get('edit-product/{id}/{userId}', "productController@edit")->middleware("auth");

Route::post('/add-product/confirm', "ProductController@create");
Route::post('/edit-product/confirm', "ProductController@update");
