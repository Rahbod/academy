<?php

Route::get('/', 'HomeController@index')->name('home');

Route::group(['prefix' => 'payment'], function () {
    Route::get('/pay','PaymentController@pay');
    Route::post('/callback','PaymentController@callback');
});

Route::get('news', 'ContentController@index');
Route::get('news/{id}/{slug?}', 'ContentController@show');


Route::get('article', 'ContentController@index');
Route::get('article/{id}/{slug?}', 'ContentController@show');

Route::get('editing-request', 'TranslateRequestController@editing')->name('editing');
Route::get('translate-request', 'TranslateRequestController@index')->name('translations');
Route::post('request-store', 'TranslateRequestController@store');

Route::get('courses/register/{course_id}/{slug?}', 'CourseController@termShow');
Route::get('class-show/{term_id}', 'CourseController@classShow');
Route::get('verify/{class_id}', 'CourseController@verify');
Route::post('payment', 'PaymentController@store');

Route::get('courses', 'CourseController@index')->name('courses');
Route::get('courses/{id}/{slug?}', 'CourseController@show');

Route::get('pages', 'PageController@index')->name('pages');
Route::get('pages/{id}/{slug?}', 'PageController@show');

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

Route::get('messages', function () {
    return view('main_template.pages.message')->with([
        'type' => 'success',
        'title' => 'ثبت نام با موفقیت انجام شد.',
        'message' => 'ثبت نام شما با موفقیت انجام شد.لطفا جهت فعال سازی حسابتان به پست الکترونیکی خود مراجعه و بر روی لینک فعال سازی کلیک نمایید.'
    ]);
});

Route::get('renew-captcha-image', function () {
    return captcha_img('flat');
});

Route::get('test-static-page', 'ContactUsController@test');

Route::get('{resource}/tags/show/{id}/{slug}', 'TagController@show');

Route::get('test/mailable', function () {
    $user = new App\User();
    $user->username = 'mustafa';
    $user->name = 'mustafa';
    $user->type = 'user';
    $user->is_admin = '0';
    $user->status = '1';
    $user->verified = '0';
    $user->access_level = 1;
    $user->password = bcrypt('mustafa');
    $user->verify_email_link = 'mustafa';
    $user->email = 'mustafa.rezae01@gmail.com';
    $user->save();

    Log::info($user);

    Mail::to($user)->send(new App\Mail\VerifyAccount($user));
    return (new App\Mail\VerifyAccount($user))->render();


//    return (new App\Mail\Notification('عنوان ازمایشی','متن ازمایشی'));


    return response()->json([
        'success' => 'ارسال ایمیل با موفقیت انجام شد.'
    ]);
});