<?php
return [
    "title"=>"عملیات مالی",
    "table_title" => "لیست عملیات مالی",
    "create_form_title" => "فرم ایجاد عملیات مالی",
    "edit_form_title" => "فرم ویرایش عملیات مالی",
    "items" => [
        "id" => "شناسه",
        "user_id" => "کاربر",
        'transaction_id' => 'شناسه عملیات بانکی',
        'user_class_id' => 'شناسه ثبت نام',
        'paymentable_type'=>'نوع ماژول',
        'paymentable_id'=>'پرداخت برای ',
        'price' => 'مبلغ',
        'type' => 'نوع',
        'status' => 'وضعیت',
        'description' => 'توضیحات',
        'updated_at' => 'تاریخ بروزرسانی',
        'created_at' => 'تاریخ ایجاد',
    ],
    'relations' => [
        'user' => 'نویسنده',
        'transaction' => 'عملیات بانکی',
        'transaction_log' => 'دسته بندی',
    ],
    "messages" => [
        "table_loading" => "لیست عملیات مالی در حال بارگذاری است ...",
        "table_not_found_record" => "هیچ اطلاعاتی در جدول عملیات مالی پیدا نشد."
    ]
];