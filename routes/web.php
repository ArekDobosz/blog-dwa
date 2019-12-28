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

Route::get('/{slug?}', 'BlogController@index')->name('/');

Route::get('login/{provider}', 'SocialLoginController@redirectToProvider')->name('social-login');
Route::get('login/{provider}/callback', 'SocialLoginController@handleProviderCallback');

Route::get('artykul/{slug}', 'BlogController@showArticle')->name('show-article');
Route::get('archiwum/{date}', 'BlogController@showArchiveArticles')->name('archive');

// regulamin || polityka prywatnosci
Route::get('blog/{arg}', 'BlogController@showRegulations')->name('regulations');
Route::post('contact/send-message', 'ContactController@sendMessage')->name('contact');

Route::post('comment/{articleId}', 'CommentController@addComment')->name('comment.add');
Route::patch('comment/{comment}', 'CommentController@update')->name('comment.update');

Route::resource('message', 'MessageController');

Route::group(['prefix' => 'admin'], function(){
	Route::group(['middleware' => 'admin'], function(){
		Route::get('/dashboard', 'AdminController@index')->name('admin');
		Route::resource('user', 'UserController');
		Route::resource('article', 'ArticleController');
		Route::resource('category', 'CategoryController');
		Route::resource('message', 'MessageController');

		Route::post('article-filtered', 'ArticleController@getArticlesByFilter')->name('article.filtered');
		Route::patch('article-restore/{articleId}', 'ArticleController@restore')->name('article.restore');
		Route::patch('article-status/{articleId}', 'ArticleController@switchPublishedStatus')->name('article.status');
	});
});
