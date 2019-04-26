<?php

return [
    "title"=>'نقش ها',
    'table_title' => 'لیست تمام نقش های سیستم',
    'create_form_title' => 'فرم ایجاد نقش ها',
    'edit_form_title' => 'فرم ویرایش نقش ها',
    'items' => [
        'main_name' => 'نقش ها',
        'id' => 'شناسه',
        'name' => 'نام',
        'display_name' => 'نام جهت نمایش',
        'description' => 'توضیحات',

    ],
    "relations"=>[
        'actions'=>'عملیات',
        'users'=>'کاربران',
    ],
    'values' => [
        'create_new_record' => 'ایجاد نقش جدید'
    ],
    'messages' => [
        'table_loading' => 'لیست نقش ها در حال بارگذاری است ...',
        'loading' => 'لطفا منتظر بمانید ...',
        'table_not_found_record' => 'هیچ اطلاعاتی در جدول نقش ها پیدا نشد.'
    ]
];