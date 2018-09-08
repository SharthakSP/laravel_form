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

Route::get('/', 'ApplicationController@index');

Route::get('/home', 'ApplicationController@index')->name('home');

Route::get('/about','ApplicationController@about');

Route::get('/contact','ApplicationController@contact');

Route::any('/add','ApplicationController@addUser')->name('add');

Route::any('delete/{user_id?}','ApplicationController@deleteUser')->name('delete');

Route::any('edit/{user_id?}','ApplicationController@editUser')->name('edit');

Route::any('/edit_action','ApplicationController@editAction')->name('edit_action');




