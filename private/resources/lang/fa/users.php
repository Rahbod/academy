<?php
return [
    "title"=>'کاربران',
    'table_title' => 'لیست تمام کاربران سیستم',
    'create_form_title' => 'فرم ایجاد کاربر',
    'edit_form_title' => 'فرم ویرایش کاربر',
    'items' => [
        'id' => 'شناسه',
        'role_id' => 'نقش ها',
        'department_id' => 'دپارتمان ها',
        'username' => 'نام کاربری',
        'name' => 'نام',
        'family' => 'نام خانوادگی',
        'email' => 'ایمیل',
        'password' => 'رمز عبور',
        'password_confirmation' => 'تکرار رمز عبور',
        'avatar' => 'تصویر آواتار',
        'is_admin' => 'دسترسی به مدیریت',
        'type' => 'نوع',
        'status' => 'وضعیت',
        'verified' => 'وضعیت تایید',
        'access_level' => 'سطح دسترسی',
        'updated_at' => 'تاریخ بروزرسانی',
        'created_at' => 'تاریخ ایجاد',
    ],
    'relations' => [
        'roles' => 'نقش ها',
        'departments' => 'دپارتمان ها',
        'profile' => 'پروفایل'
    ],
    'values' => [
        'create_new_record' => 'ایجاد کاربر جدید'
    ],
    'attributes' => [
        'basic_info'=>'اطلاعات پایه',
        'personal_info'=>'اطلاعات انفرادی',
        'about_user'=>'درباره کاربر',
        'password'=>'بروزرسانی رمز عبور',
    ],
    'messages' => [
        'table_loading' => 'لیست کاربران در حال بارگذاری است ...',
        'table_not_found_record' => 'هیچ اطلاعاتی در جدول کاربران پیدا نشد.'
    ]
];