<?php
return [
    "title"=>'گروههای تنظیمات',
    "table_title" => "لیست تمام گروهای تنظیمات سیستم",
    "create_form_title" => "فرم ایجاد گروهای تنظیمات",
    "edit_form_title" => "فرم ویرایش گروهای تنظیمات",
    "items" => [
        "id" => "شناسه",
        "name" => "نام",
        "display_name" => "نام جهت نمایش",
    ],
    'relations' => [
        'settings' => 'تنظیمات',
    ],
    "values" => [
        'select' => 'select',
        'radio' => 'radio',
        'textarea' => 'textarea',
        'text' => 'text',
        'default' => 'پیشفرض',
        'left_to_right' => 'چپ چین',
        'right_to_left' => 'راست چین',
        "select_items" => "گزینه ها ی مورد نظر خود را انتخاب کنید",
        "create_new_record" => "ایجاد گروه تنظیمات جدید"
    ],
    "messages" => [
        "table_loading" => "لیست گروهای تنظیمات در حال بارگذاری است ...",
        "loading" => "لطفا منتظر بمانید ...",
        "table_not_found_record" => "هیچ اطلاعاتی در جدول گروهای تنظیمات پیدا نشد."
    ]
];