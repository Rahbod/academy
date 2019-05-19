<?php

Route::get('/', 'HomeController@index')->name('home');

Route::get('news', 'ContentController@index');
Route::get('news/{id}/{slug?}', 'ContentController@show');


Route::get('article', 'ContentController@index');
Route::get('article/{id}/{slug?}', 'ContentController@show');

Route::get('translation-requests/create', 'TranslateRequestController@index')->name('translations');
Route::post('translation-requests/', 'TranslateRequestController@store');

Route::get('courses/register/{course_id}/{slug?}', 'CourseController@termShow');
Route::get('class-show/{term_id}', 'CourseController@classShow');
Route::get('verify/{class_id}', 'CourseController@verify');
Route::post('payment', 'PaymentController@pay');

Route::get('courses', 'CourseController@index');
Route::get('courses/{id}/{slug?}', 'CourseController@show');

Route::get('contact-us', 'ContactUsController@index')->name('contact-us');
Route::post('contact-us', 'ContactUsController@store');
Route::post('newsletter', 'ContactUsController@newsletter');

Route::get('search', 'ContentController@search');
Route::post('search', 'ContentController@search');

Route::get('about-us', 'ContactUsController@aboutUs')->name('about-us');
//payment/class-room || translation /

Route::view('404', 'errors.404');
Route::view('500', 'errors.500');
Route::view('under_maintenance', 'errors.under_maintenance');
