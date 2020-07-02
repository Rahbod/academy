<?php
return [
    "title" => "درخواست های ترجمه",
    "table_title" => "لیست درخواست های ترجمه",
    "create_form_title" => "فرم ایجاد درخواست ترجمه",
    "edit_form_title" => "فرم ویرایش درخواست ترجمه",
    "items" => [
        "id" => "شناسه",
        'author_id' => 'کاربر',
        'category_id' => 'دسته بندی',
        'title' => 'عنوان',
        'translation_language' => 'زبان ترجمه',
        'source_language' => 'زبان مبدا',
        'description' => 'توضیحات',
        'price' => 'هزینه ترجمه',
        'translated_file' => 'فایل ترجمه',
        'status' => 'وضعیت',
        'updated_at' => 'تاریخ بروزرسانی',
        'created_at' => 'تاریخ ایجاد',
        'type' => 'نوع درخواست',
    ],
    'relations' => [
        'author' => 'کاربر',
        'category' => 'دسته بندی',
        'attachments' => 'فایل های ضمیمه',
        'transaction' => 'تراکنش',
    ],
    "values" => [
        "create_new_record" => " درخواست ترجمه جدید"
    ],
    "messages" => [
        "table_loading" => "لیست درخواست های ترجمه در حال بارگذاری است ...",
        "table_not_found_record" => "هیچ اطلاعاتی در جدول درخواست های ترجمه پیدا نشد."
    ],

    "home_title" => "اسناد و مدارک خود را به ما بسپارید",
    "home_discount" => "تخفیف",
    "home_content" => "اولین مرکز تخصصی ترجمه کلیه مدارک و اسناد در ایران",
];