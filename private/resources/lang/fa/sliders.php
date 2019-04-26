<?php
return [
    "title"=>'اسلایدر',
    "table_title" => "لیست تمام اسلایدر سیستم",
    "create_form_title" => "فرم ایجاد اسلایدر",
    "edit_form_title" => "فرم ویرایش اسلایدر",
    "items" => [
        "id" => "شناسه",
        "author_id" => " نویسنده",
        "group_id" => "دسته بندی",
        "title" => "عنوان",
        "text" => "متن",
        "link" => "لینک اسلایدر",
        'image' => 'تصویر',
        'status' => 'وضعیت نمایش',
        'order' => 'ترتیب نمایش',
        'updated_at' => 'تاریخ بروزرسانی',
        'created_at' => 'تاریخ ایجاد',
        'lang'=>'زبان'
    ],
    'relations' => [
        'author' => 'نویسنده',
        'group' => 'دسته بندی',
    ],
    "values" => [
        "create_new_record" => "ایجاد اسلایدر جدید"
    ],
    "messages" => [
        "table_loading" => "لیست اسلایدر در حال بارگذاری است ...",
        "table_not_found_record" => "هیچ اطلاعاتی در جدول اسلایدر پیدا نشد."
    ]
];