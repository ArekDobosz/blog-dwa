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

Route::get('/', 'BlogController@index')->name('/');
Route::get('article/{slug}', 'BlogController@showArticle')->name('show-article');

Route::group(['prefix' => 'admin'], function(){
	Route::group(['middleware' => 'admin'], function(){
		Route::get('/', 'AdminController@index');
		Route::resource('article', 'ArticleController');
	});
});
