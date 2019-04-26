<?php
return [
    "title"=>'منو ها',
    "table_title" => "لیست تمام منو های سیستم",
    "create_form_title" => "فرم ایجاد منو ها",
    "edit_form_title" => "فرم ویرایش منو ها",
    "items" => [
        "id" => "شناسه",
        "name" => "نام",
        "display_name" => "نام جهت نمایش",
        "icon_type" => "نوع آیکن",
        'description' => 'توضیحات',
    ],
    'relations'=>[
        'menu_items'=>'آیتم های منو',
    ],
    "values" => [
        'create_new_record' => 'ایجاد منو جدید',
    ],
    "messages" => [
        "table_loading" => "لیست منو ها در حال بارگذاری است ...",
        "table_not_found_record" => "هیچ اطلاعاتی در جدول منو ها پیدا نشد."
    ]
];