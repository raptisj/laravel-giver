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
    return view('layout.home');
});

Route::get('/about', function () {
    return view('layout.about');
});

Route::get('/create', function () {
    return view('layout.create');
});

Route::get('/show', function () {
    return view('layout.show');
});

Route::get('/all-tips', function () {
	return view('tips.all-tips');
});

Route::get('/tips', 'TipsController@index');
Route::post('/tips', 'TipsController@store');
Route::post('/total-tips', 'TipsController@addTotal');
Route::get('/end-day', 'TipsController@endDay');
Route::delete('/tips/{id}', 'TipsController@destroy');