<?php


Route::get('/', 'HomeController@index')->name('home');

Route::view('404', 'errors.404');
Route::view('500', 'errors.500');
Route::view('under_maintenance', 'errors.under_maintenance');

Route::get('news', 'TranslationController@index')->name('news');
Route::get('articles', 'TranslationController@articles')->name('articles');
Route::get('translations', 'TranslationController@index')->name('translations');
Route::view('contact-us', 'contact-us')->name('contact-us');
