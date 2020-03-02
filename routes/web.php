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

//Route::get('/', function () {
    //return view('index');
//});

Route::get('/', 'PostController@index');
Route::get('/main', 'PostController@index3');



Route::get('about/us', 'PostController@index')->name('about');

Route::get('write/post', 'PostController@create')->name('write.post');

Route::get('add/category', 'CategoryController@create')->name('add.category');
Route::get('all/category', 'CategoryController@index')->name('all.category');
Route::get('view/category/{id}', 'CategoryController@show');
Route::get('delete/category/{id}', 'CategoryController@destroy');
Route::get('edit/category/{id}', 'CategoryController@edit');
Route::post('store/category', 'CategoryController@store')->name('category.store');
Route::post('update/category/{id}', 'CategoryController@update');

//Post
Route::post('store/post', 'PostController@store')->name('store.post');
Route::get('all/post', 'PostController@index2')->name('all.post');
Route::get('view/post/{id}', 'PostController@show');
Route::get('edit/post/{id}', 'PostController@edit');
Route::post('update/post/{id}', 'PostController@update');
Route::get('delete/post/{id}', 'PostController@destroy');


Route::get('/students','StudentController@student')->name('student');
Route::post('store/student','StudentController@store')->name('store.student');
Route::get('all/student','StudentController@index')->name('all.student');
Route::get('view/student/{id}','StudentController@show');
Route::get('delete/student/{id}','StudentController@destroy');
Route::get('edit/student/{id}','StudentController@edit');
Route::post('update/student/{id}','StudentController@update');
