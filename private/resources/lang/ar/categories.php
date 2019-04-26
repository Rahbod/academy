<?php
return [
    'title'=>"دسته بندی ها",
    "table_title" => "لیست تمام دسته بندی های سیستم",
    "create_form_title" => "فرم ایجاد دسته بندی ها",
    "edit_form_title" => "فرم ویرایش دسته بندی ها",
    "items" => [
        "id" => "شناسه",
        "author_id" => "نویسنده",
        "parent_id" => "شاخه والد",
        "name" => "نام",
        "special_name" => "نام ویژه",
        "description" => "توضیحات",
        'status' => 'وضعیت نمایش',
        'order' => 'ترتیب نمایش',
        'published_at' => 'تاریخ انتشار',
        'updated_at' => 'تاریخ بروزرسانی',
        'created_at' => 'تاریخ ایجاد',
        'lang' => 'زبان',

    ],
    'relations'=>[
        'author'=>'نویسنده',
        'contents'=>'مطالب',
    ],
    "values" => [
        "select_items" => "گزینه ها ی مورد نظر خود را انتخاب کنید",
        "create_new_record" => "ایجاد دسته بندی جدید"
    ],
    "messages" => [
        "table_loading" => "لیست دسته بندی ها در حال بارگذاری است ...",
        "table_not_found_record" => "هیچ اطلاعاتی در جدول دسته بندی ها پیدا نشد."
    ]
];