<?php
return [
    'title'=>"دسته بندی های اسلایدر",
    "table_title" => "لیست دسته بندی های اسلایدر",
    "create_form_title" => "فرم ایجاد دسته بندی اسلایدر",
    "edit_form_title" => "فرم ویرایش دسته بندی اسلایدر",
    "items" => [
        "id" => "شناسه",
        "author_id" => "نویسنده",
        "parent_id" => "شاخه والد",
        "name" => "نام",
        "special_name" => "نام ویژه",
        "description" => "توضیحات",
        'order' => 'ترتیب نمایش',
        'updated_at' => 'تاریخ بروزرسانی',
        'created_at' => 'تاریخ ایجاد',
        'lang' => 'زبان',

    ],
    'relations'=>[
        'author'=>'نویسنده',
        'sliders'=>'اسلایدرها',
    ],
    "values" => [
        "create_new_record" => "ایجاد دسته بندی جدید"
    ],
    "messages" => [
        "table_loading" => "لیست دسته بندی های اسلایدر در حال بارگذاری است ...",
        "table_not_found_record" => "هیچ اطلاعاتی در جدول دسته بندی های اسلایدر پیدا نشد."
    ]
];