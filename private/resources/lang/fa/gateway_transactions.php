<?php
return [
    "title"=>"تراکنش ها بانکی",
    "table_title" => "لیست تراکنش ها بانکی",
    "create_form_title" => "فرم ایجاد تراکنش بانکی",
    "edit_form_title" => " فرم ویرایش تراکنش بانکی",
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
        "table_loading" => "لیست تراکنش ها بانکی در حال بارگذاری است ...",
        "table_not_found_record" => "هیچ اطلاعاتی در جدول تراکنش ها بانکی پیدا نشد."
    ]
];