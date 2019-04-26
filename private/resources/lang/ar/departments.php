<?php
return [
    "title"=>'دپارتمان ها',
    'table_title' => 'لیست تمام دپارتمان های سیستم',
    'create_form_title' => 'فرم ایجاد دپارتمان ها',
    'edit_form_title' => 'فرم ویرایش دپارتمان ها',
    'items' => [
        'id' => 'شناسه',
        'namespace_id' => 'فضای نام',
        'name' => 'نام',
        'display_name' => 'نام جهت نمایش',
        'prefix' => 'پیشوند',
        'middleware' => 'میان افزار',
        'description' => 'توضیحات',

    ],
    'relations'=>[
        'sp_namespace'=>'فضای نام',
        'resource_groups'=>'گروه های منابع',
    ],
    'values' => [
        'submit' => 'تایید',
        'cancel' => 'انصراف',
        'create_new_record' => 'ایجاد دپارتمان جدید'
    ],
    'messages' => [
        'table_loading' => 'لیست دپارتمان ها در حال بارگذاری است ...',
        'loading' => 'لطفا منتظر بمانید ...',
        'table_not_found_record' => 'هیچ اطلاعاتی در جدول دپارتمان ها پیدا نشد.'
    ]
];