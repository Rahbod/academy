<?php

Route::get('/', 'HomeController@index')->name('home');

Route::get('news', 'ContentController@index');
Route::get('news/{id}/{slug?}', 'ContentController@show');


Route::get('article', 'ContentController@index');
Route::get('article/{id}/{slug?}', 'ContentController@show');


Route::get('translation-requests/create', 'TranslateRequestController@index')->name('translations');
Route::post('translation-requests/', 'TranslateRequestController@store');


Route::get('courses/register/{course_id}/{slug?}', 'CourseController@termShow');
Route::get('courses/register/step2/{term_id}', 'CourseController@classShow');
Route::get('courses/register/step3/{class_id}', 'CourseController@verify');

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
