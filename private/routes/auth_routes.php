<?php

Route::get('login', 'AdminLoginController@showLoginForm')->name('admin.login_form');
Route::post('login', 'AdminLoginController@login')->name('admin.login');
Route::post('logout', 'AdminLoginController@logout')->name('admin.logout');