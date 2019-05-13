<?php

Route::get('/', 'HomeController@index')->name('home');

Route::get('news', 'ContentController@index');
Route::get('news/{id}/{slug?}', 'ContentController@show');

Route::get('article', 'ContentController@index');
Route::get('article/{id}/{slug?}', 'ContentController@show');

Route::get('translations', 'TranslationController@index')->name('translations');

Route::get('courses', 'CourseController@index');
Route::get('courses/{id}/{slug?}', 'CourseController@show');


Route::get('contact-us', 'ContactUsController@index')->name('contact-us');
Route::post('contact-us', 'ContactUsController@store');
Route::post('newsletter', 'ContactUsController@newsletter');
Route::get('search', 'contentController@search');
Route::post('search', 'contentController@search');

Route::view('about-us', 'main_template.pages.about-us')->name('about-us');
Route::view('404', 'errors.404');
Route::view('500', 'errors.500');
Route::view('under_maintenance', 'errors.under_maintenance');
