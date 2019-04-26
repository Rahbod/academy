<?php

return [
    "title"=>'گروهای منابع ',
    'table_title' => 'لیست تمام گروه های منابع سیستم',
    'create_form_title' => 'فرم ایجاد گروه های منابع',
    'edit_form_title' => 'فرم ویرایش گروه های منابع',
    'items' => [
        'id' => 'شناسه',
        'department_id' => 'دپارتمان',
        'name' => 'نام',
        'display_name' => 'نام جهت نمایش',
        'namespace' => 'فضای نام',
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
        'resources' => [
            'main_name' => 'منابع',
            'id' => 'شناسه منابع',
            'resource_group_id' => 'شناسه گروه منابع',
            'parent_id' => 'شاخه والد',
            'name' => 'نام',
            'display_name' => 'نام جهت نمایش',
            'description' => 'توضیحات'
        ]

    ],
    'relations'=>[
        'department'=>'دپارتمان',
        'resources'=>'منابع',
    ],
    'values' => [
        'create_new_record' => 'ایجاد گروه منابع جدید'
    ],
    'messages' => [
        'table_loading' => 'لیست گروه های منابع در حال بارگذاری است ...',
        'table_not_found_record' => 'هیچ اطلاعاتی در جدول گروه های منابع پیدا نشد.'
    ]
];