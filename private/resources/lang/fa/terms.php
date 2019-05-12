<?php
return [
    "title"=>"ترم ها",
    "table_title" => "لیست تمام ترم های سیستم",
    "create_form_title" => "فرم ایجاد ترم ها",
    "edit_form_title" => "فرم ویرایش ترم ها",
    "items" => [
        "id" => "شناسه",
        "author_id" => "نویسنده",
        "course_id" => "دوره",
        "title_fa" => "عنوان فارسی",
        "title_en" => "عنوان انگلیسی",
        'description_fa' => 'توضیحات فارسی',
        'description_en' => 'توضیحات انگلیسی',
        'status' => 'وضعیت',
        'order'=>'ترتیب نمایش',
        'lang' => 'زبان',
        'created_at' => 'تاریخ ایجاد',
        'updated_at' => 'تاریخ بروزرسانی',
    ],
    'relations'=>[
        'author'=>'نویسنده',
        'course'=>'دوره',
        'comments'=>'نظرات',
        'tags'=>'برچسب ها',
    ],
    "values" => [
        "select_items" => "گزینه ها ی مورد نظر خود را انتخاب کنید",
        "create_new_record" => "ایجاد مطلب جدید"
    ],
];