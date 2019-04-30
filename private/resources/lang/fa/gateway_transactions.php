<?php
return [
    "title"=>"تراکنش ها",
    "table_title" => "لیست تراکنش ها",
    "create_form_title" => "فرم ایجاد تراکنش",
    "edit_form_title" => "فرم ویرایش تراکنش",
    "items" => [
        "id" => "شناسه",
        'port' => 'درگاه',
        'price' => 'قیمت',
        'ref_id' => 'کدرهگیری',
        'tracking_code' => 'شماره ترانش',
        'card_number' => 'شماره کارت',
        'status' => 'وضعیت',
        'ip' => 'شناسه',
        'payment_date' => 'تاریخ پرداخت',
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