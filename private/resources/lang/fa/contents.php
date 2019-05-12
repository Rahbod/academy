<?php
return [
    "title"=>"مطالب",
    "table_title" => "لیست تمام مطالب سیستم",
    "create_form_title" => "فرم ایجاد مطالب",
    "edit_form_title" => "فرم ویرایش مطالب",
    "items" => [
        "author_id" => "نویسنده",
        "category_id" => "دسته بندی",
        "tag_id" => "برچسب ها",
        "type" => "نوع مطلب",
        "id" => "شناسه",
        'logo' => 'لوگو',
        'image' => 'تصویر',
        'title' => 'عنوان',
        'summary' => 'خلاصه مطلب',
        'text' => 'محتوا',
        'source' => 'منبع',
        'source_link' => 'لینک منبع',
        'show_count' => 'تعداد بازدید ها',
        'status' => 'وضعیت نمایش',
        'order' => 'ترتیب نمایش',
        'published_at' => 'تاریخ انتشار',
        'created_at' => 'تاریخ ایجاد',
        'updated_at' => 'تاریخ بروزرسانی',
        'lang' => 'زبان',
    ],
    'relations'=>[
        'author'=>'نویسنده',
        'category'=>'دسته بندی',
        'comments'=>'نظرات',
        'tags'=>'برچسب ها',
        'attachments' => 'فایل های ضمیمه',
    ],
    "values" => [
        "select_items" => "گزینه ها ی مورد نظر خود را انتخاب کنید",
        "create_new_record" => "ایجاد مطلب جدید"
    ],
];