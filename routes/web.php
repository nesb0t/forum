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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/threads', 'ThreadController@index');
Route::post('/threads', 'ThreadController@store');
Route::get('/threads/{topic}/create', 'ThreadController@create');
Route::get('/threads/{topic}/{thread}', 'ThreadController@show');
Route::post('/threads/{topic}/{thread}/replies', 'ReplyController@store');

Route::post('/threads/{thread}/replies', 'ReplyController@store');
