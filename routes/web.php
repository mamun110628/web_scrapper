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

Route::get('/', 'IndexController@search')->middleware('admin');
Route::get('login', 'AdminUserController@login');
Route::post('login_process', 'AdminUserController@login_process');
Route::get('logout', 'AdminUserController@logout');
Route::get('scrap', 'IndexController@index')->middleware('admin');
Route::get('collect_news', 'IndexController@collectNews')->middleware('admin');
Route::post('get_news', 'IndexController@NewsCollect')->middleware('admin');
Route::get('news-list', 'IndexController@NewsList')->middleware('admin');
Route::get('newsAjaxList', 'IndexController@newsAjaxList')->middleware('admin');
Route::post('make_pdf', 'IndexController@makePdf')->middleware('admin');
Route::get('search-news', 'IndexController@searchNews')->middleware('admin');
Route::get('search_tag', 'IndexController@searchByTag')->middleware('admin');
Route::get('newsSerchList', 'IndexController@newsSearchList')->middleware('admin');


Route::group(['middleware' => 'admin'], function() {
    Route::resource('newspaper', 'NewspaperController');
});
Route::get('newspaperlist', 'NewspaperController@AjaxList')->middleware('admin');
Route::post('newspaper_status', 'NewspaperController@NewspaperStatus')->middleware('admin');