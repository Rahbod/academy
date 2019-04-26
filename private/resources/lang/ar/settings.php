<?php
return [
    "title"=>'تنظیمات',
    "table_title" => "لیست تنظیمات سیستم",
    "create_form_title" => "فرم ایجاد تنظیمات",
    "edit_form_title" => "فرم ویرایش تنظیمات",
    "update_all_settings_form_title" => "فرم بروزرسانی تنظیمات",
    "items" => [
        "id" => "شناسه",
        "setting_group_id" => "گروه تنظیمات",
        "name" => "نام",
        "display_name" => "نام جهت نمایش",
        "value" => "مقدار",
        "details" => "جزئیات",
        "type" => "نوع ورودی",
        "direction" => "جهت",
        "order" => "ترتیب نمایش",
        "setting_group" => [
            "main_name" => "گروه تنظیمات",
            "id" => "شناسه گروه تنظیمات",
            "name" => " نام گروه تنظیمات",
            "display_name" => "نام نمایشی گروه تنظیمات",
        ]
    ],
    'relations' => [
        'setting_group' => 'گروه تنظیمات',
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
        "create_new_record" => "ایجاد تنظیمات جدید"
    ],
    "messages" => [
        "table_loading" => "لیست تنظیمات در حال بارگذاری است ...",
        "loading" => "لطفا منتظر بمانید ...",
        "table_not_found_record" => "هیچ اطلاعاتی در جدول تنظیمات پیدا نشد."
    ]
];