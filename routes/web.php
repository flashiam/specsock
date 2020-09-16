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

Route::get('/', function () {
    return redirect()->route('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/articles', 'articleController@index')->name('articles');
Route::get('/Assets', 'assetsController@index')->name('assets');
Route::get('/pages', 'pagesController@index')->name('pages');
Route::get('/campaigns', 'campaignsController@index')->name('campaigns');
Route::get('/live', function(){
    $window = "live";
    return view('preview')->with('window', $window);
})->name('live');
Route::post('/article/save', 'articleController@save_article')->name('article.post');
Route::get('/Assets/{dir}', ['uses'=>'assetsController@showDir']);
Route::get('/Assets/{dir}/{sdir}', ['uses'=>'assetsController@showdirDir']);
Route::get('/Assets/{dir}/{sdir}/{s1dir}', ['uses'=>'assetsController@showdirdirDir']);
Route::get('/Assets/{dir}/{sdir}/{s1dir}/{s2dir}', ['uses'=>'assetsController@showdirdirdirDir']);
Route::get('/Assets/{dir}/{sdir}/{s1dir}/{s2dir}/{s3dir}', ['uses'=>'assetsController@showdirdirdirdirDir']);