<?php
return [
    "title"=>"دوره ها",
    "table_title" => "لیست تمام دوره های سیستم",
    "create_form_title" => "فرم ایجاد دوره ها",
    "edit_form_title" => "فرم ویرایش دوره ها",
    "items" => [
        "author_id" => "نویسنده",
        "category_id" => "دسته بندی",
        "tag_id" => "برچسب ها",
        "id" => "شناسه",
        'image' => 'تصویر',
        'title_fa' => 'عنوان فارسی',
        'title_en' => 'عنوان انگلیسی',
        'description_fa' => 'توضیحات فارسی',
        'description_en' => 'توضیحات انگلیسی',
        'duration' => 'مدت',
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
        'terms'=>'ترم ها',
    ],
    "values" => [
        "select_items" => "گزینه ها ی مورد نظر خود را انتخاب کنید",
        "create_new_record" => "ایجاد دوره جدید"
    ],

];