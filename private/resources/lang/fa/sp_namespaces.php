<?php
return [
    "title"=>'فضاهای نام',
    "table_title" => "لیست تمام فضاهای نام سیستم",
    "create_form_title" => "فرم ایجاد فضاهای نام",
    "edit_form_title" => "فرم ویرایش فضاهای نام",
    "items" => [
        "id" => "شناسه",
        "name" => "نام",
        "display_name" => "نام جهت نمایش",
    ],
    'relations' => [
        'departments' => 'دپارتمان ها',
    ],
    "values" => [
        "select_items" => "گزینه ها ی مورد نظر خود را انتخاب کنید",
        "submit" => "تایید",
        "cancel" => "انصراف",
        "create_new_record" => "ایجاد فضای نام جدید"
    ],
    "messages" => [
        "table_loading" => "لیست فضاهای نام در حال بارگذاری است ...",
        "loading" => "لطفا منتظر بمانید ...",
        "table_not_found_record" => "هیچ اطلاعاتی در جدول فضاهای نام پیدا نشد."
    ]
];