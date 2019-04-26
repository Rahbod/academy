<?php
return [
    'title'=>"نظرات کاربران",
    "table_title" => "لیست تمام نظرات کاربران",
    "create_form_title" => "فرم ایجاد نظرات",
    "edit_form_title" => "فرم ویرایش نظرات",
    "items" => [
        "id" => "شناسه",
        "author_id" => " نویسنده",
        "parent_id" => "شاخه والد",
        "name" => "نام",
        "email" => "ایمیل",
        "content" => "محتوا",
        'archive' => 'بایگانی',
        'status' => 'وضعیت نمایش',
        'like' => 'تعداد پسند ها',
        'dis_like' => 'تعداد امتیاز منفی ',
        'commentable_id'=>'شناسه منبع اصلی',
        'commentable_type'=>'نوع منبع اصلی',
        'created_at' => 'تاریخ ایجاد',
        'updated_at' => 'تاریخ بروزرسانی',
        'lang'=>'زبان',

    ],
    'relations'=>[
      'author'=>'نویسنده',
      'contents'=>'مطالب',
      'videos'=>'ویدئوها',
      'audio'=>'فایل های صوتی',
      'galleries'=>'گالری تصاویر',
    ],
    "values" => [
        "create_new_record" => "ثبت نظر جدید"
    ],
    "messages" => [
        "table_loading" => "لیست نظرات در حال بارگذاری است ...",
        "table_not_found_record" => "هیچ اطلاعاتی در جدول نظرات پیدا نشد."
    ]
];