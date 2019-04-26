<?php
return [
    "title"=>'قالب ها',
    "table_title" => "لیست تمام قالب های سیستم",
    "create_form_title" => "فرم ایجاد قالب ها",
    "edit_form_title" => "فرم ویرایش قالب ها",
    "items" => [
        "id" => "شناسه",
        "name" => "نام",
        "display_name" => "نام جهت نمایش",
        "master_pages" => [
            "main_name" => "صفحه اصلی",
            "id" => "شناسه",
            "template_id" => "قالب",
            "name" => "نام",
            "display_name" => "نام جهت نمایش",
            "path" => "مسیر",
            "description" => "توضیحات"
        ],
        "frames" => [
            "main_name" => "فریم",
            "id" => "شناسه",
            "template_id" => "قالب",
            "name" => "نام",
            "display_name" => "نام جهت نمایش",
            "path" => "مسیر",
            "js" => "فایل جاواسکریپت",
            "actions" => "عملیات",
            "description" => "توضیحات"
        ]
    ],
    'relations' => [
        'master_pages' => 'صفحات اصلی',
        'frames' => 'فریم ها',
    ],
    "values" => [
        "create_new_record" => "ایجاد قالب جدید"
    ],
    "messages" => [
        "table_loading" => "لیست قالب ها در حال بارگذاری است ...",
        "loading" => "لطفا منتظر بمانید ...",
        "table_not_found_record" => "هیچ اطلاعاتی در جدول قالب ها پیدا نشد."
    ]
];