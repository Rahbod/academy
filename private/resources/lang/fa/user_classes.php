<?php
return [
    "title"=>"ثبت نام ها",
    "table_title" => "لیست ثبت نام ها",
    "create_form_title" => "فرم ایجاد ثبت نام",
    "edit_form_title" => "فرم ویرایش ثبت نام",
    "items" => [
        "id" => "شناسه",
        'transaction_id' => 'تراکنش',
        'user_id' => 'کاربر',
        'class_room_id' => 'کلاس',
        'status' => 'وضعیت',
        'updated_at' => 'تاریخ بروزرسانی',
        'created_at' => 'تاریخ ایجاد',
    ],
    'relations' => [
        'user' => 'کاربر',
        'transaction' => 'تراکنش',
        'class_room' => 'کلاس',
    ],
    "values" => [
        "create_new_record" => " ثبت نام جدید"
    ],
    "messages" => [
        "table_loading" => "لیست ثبت نام ها در حال بارگذاری است ...",
        "table_not_found_record" => "هیچ اطلاعاتی در جدول ثبت نام ها پیدا نشد."
    ]
];