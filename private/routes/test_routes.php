<?php


Route::get('/', 'HomeController@index')->name('home');

Route::view('404', 'errors.404');
Route::view('500', 'errors.500');
Route::view('under_maintenance', 'errors.under_maintenance');


Route::view('news', 'news')->name('news');
Route::view('articles', 'articles')->name('articles');
Route::view('translation', 'translation')->name('translation');
