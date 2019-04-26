<?php

return [
    "title"=>'مسیرها',
    'table_title' => 'لیست تمام مسیر های سیستم',
    'create_form_title' => 'فرم ایجاد مسیر ها',
    'edit_form_title' => 'فرم ویرایش مسیر ها',
    'items' => [
        'id' => 'شناسه',
        'department_id' => 'دپارتمان',
        'action_id' => 'عملیات',
        'name' => 'نام',
        'display_name' => 'نام جهت نمایش',
        'middleware' => 'میان افزار',
        'slug' => 'آدرس',
        'method' => 'متد',
        'order' => 'ترتیب نمایش',
        'description' => 'توضیحات',
        'department' => [
            'id' => 'شناسه دپارتمان',
            'namespace_id' => 'شناسه فضای نام',
            'name' => 'نام دپارتمان',
            'display_name' => 'نام نمایشی دپارتمان',
            'prefix' => 'پیشوند',
            'middleware' => 'میان افزار',
            'description' => 'توضیحات',
        ],
        'action' => [
            'id' => 'شناسه عملیات',
            'department_id' => 'شناسه دپارتمان عملیات',
            'resource_id' => 'شناسه منبع عملیات',
            'name' => 'نام عملیات',
            'display_name' => 'نام نمایشی عملیات',
            'type' => 'نوع',
            'need_allow' => 'نیاز به اجازه دسترسی',
            'status' => 'وضعیت',
            'description' => 'توضیحات',
        ],

    ],
    'relations'=>[
        'department'=>'دپارتمان',
        'action'=>'عملیات',
    ],
    'values' => [
        'submit' => 'تایید',
        'cancel' => 'انصراف',
        'get' => 'get',
        'post' => 'post',
        'put' => 'put',
        'delete' => 'delete',
        'create_new_record' => 'ایجاد مسیر جدید'
    ],
    'messages' => [
        'table_loading' => 'لیست مسیر ها در حال بارگذاری است ...',
        'loading' => 'لطفا منتظر بمانید ...',
        'table_not_found_record' => 'هیچ اطلاعاتی در جدول مسیر ها پیدا نشد.'
    ]
];