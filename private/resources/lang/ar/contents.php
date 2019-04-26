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
        "gallery_id" => "گزارش تصویری مرتبط",
        "id" => "شناسه",
        'logo' => 'لوگو',
        'image' => 'تصویر',
        'title' => 'عنوان',
        'summary' => 'خلاصه مطلب',
        'text' => 'محتوا',
        'source' => 'منبع',
        'source_link' => 'لینک منبع',
        'show_count' => 'تعداد بازدید ها',
        'is_news' => 'نمایش در اخبار',
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
        'gallery'=>'گزارش تصویری',
        'comments'=>'نظرات',
        'tags'=>'برچسب ها',
    ],
    "values" => [
        "select_items" => "گزینه ها ی مورد نظر خود را انتخاب کنید",
        'active'=>'فعال',
        'inactive'=>'غیر فعال',
        "create_new_record" => "ایجاد مطلب جدید"
    ],
    "messages" => [
        "table_loading" => "لیست مطالب در حال بارگذاری است ...",
        "loading" => "لطفا منتظر بمانید ...",
        "table_not_found_record" => "هیچ اطلاعاتی در جدول مطالب پیدا نشد."
    ]
];