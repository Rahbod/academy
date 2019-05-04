<?php

Route::group(['middleware' => ['lang', 'remove_additional_params'], 'prefix' => '{lang}'], function () {
    Route::get('/', function () {
        return view('welcome');
    });
});