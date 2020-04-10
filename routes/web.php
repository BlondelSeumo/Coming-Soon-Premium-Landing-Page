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


Route::get('/', 'IndexController@index');

Route::post('/', 'IndexController@savesubs');

Route::get('/installer', 'InstallerController@index');

Route::get('/admin', 'AdminController@index')->middleware('auth');

Route::post('/admin', 'AdminController@index')->middleware('auth');

Route::get('/admin/subscriptions','AdminController@listallsubs')->middleware('auth');

Route::get('/admin/subscriptions/download','AdminController@download')->middleware('auth');


Route::get('/admin/background/delete/{id}', 'AdminController@deletebackground')->middleware('auth');

Auth::routes();
