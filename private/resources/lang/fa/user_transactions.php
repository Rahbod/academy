<?php
return [
    "title"=>"تراکنش ها",
    "table_title" => "لیست تراکنش ها",
    "create_form_title" => "فرم ایجاد تراکنش",
    "edit_form_title" => "فرم ویرایش تراکنش",
    "items" => [
        "id" => "شناسه",
        "user_id" => "کاربر",
        'transaction_id' => 'شناسه تراکنش بانکی',
        'user_class_id' => 'شناسه ثبت نام',
        'price' => 'مبلغ',
        'type' => 'نوع',
        'status' => 'وضعیت',
        'description' => 'توضیحات',
        'updated_at' => 'تاریخ بروزرسانی',
        'created_at' => 'تاریخ ایجاد',
    ],
    'relations' => [
        'user' => 'نویسنده',
        'transaction_log' => 'دسته بندی',
    ],
    "messages" => [
        "table_loading" => "لیست تراکنش ها در حال بارگذاری است ...",
        "table_not_found_record" => "هیچ اطلاعاتی در جدول تراکنش ها پیدا نشد."
    ]
];