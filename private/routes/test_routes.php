<?php

Route::get('/', 'HomeController@index')->name('home');

Route::get('news', 'ContentController@index')->name('news');
Route::get('articles', 'ContentController@index')->name('articles');

Route::get('translations', 'TranslationController@index')->name('translations');
Route::resource('courses', 'CourseController');

Route::view('contact-us', 'main_template.pages.contact-us')->name('contact-us');
Route::view('about-us', 'main_template.pages.about-us')->name('about-us');

Route::view('404', 'errors.404');
Route::view('500', 'errors.500');
Route::view('under_maintenance', 'errors.under_maintenance');
