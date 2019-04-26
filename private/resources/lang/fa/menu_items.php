<?php
return [
    "title"=>'آیتم های منو',
    "table_title" => "لیست تمام آیتم ها ی منوی سیستم",
    "create_form_title" => "فرم ایجاد آیتم ها ی منو",
    "edit_form_title" => "فرم ویرایش آیتم ها ی منو",
    "items" => [
        "main_name" => "آیتم های منو",
        'create_form_title'=>'فرم ایجاد منو آیتم جدید',
        "id" => "شناسه",
        'path_id'=>'مسیر',
        'parent_id'=>'شاخه والد',
        'menu_id'=>'منو',
        "name" => "نام",
        "display_name" => "نام جهت نمایش",
        'url'=>'آدرس',
        'icon'=>'آیکن',
        'target'=>'مقصد',
        'order'=>'ترتیب نمایش',
        "description" => "توضیحات",

    ],
    'relations'=>[
        'menu'=>'منو',
    ],
    "values" => [
        'create_new_record' => 'ایجاد منو آیتم جدید',
        'blank'=>'صفحه جدید',
        'self'=>'همان صفحه'
    ],
    "messages" => [
        "table_loading" => "لیست آیتم ها ی منو در حال بارگذاری است ...",
        "loading" => "لطفا منتظر بمانید ...",
        "table_not_found_record" => "هیچ اطلاعاتی در جدول آیتم ها ی منو پیدا نشد."
    ]
];