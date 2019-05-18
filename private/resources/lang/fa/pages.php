<?php
return [
    "title"=>"صفحه ها",
    "table_title" => "لیست تمام صفحه های ثابت",
    "create_form_title" => "فرم ایجاد صفحه ",
    "edit_form_title" => "فرم ویرایش صفحه ",
    "items" => [
        "author_id" => "نویسنده",
        "tag_id" => "برچسب ها",
        "id" => "شناسه",
        'image' => 'تصویر',
        'title' => 'عنوان',
        'summary' => 'خلاصه مطلب',
        'text' => 'محتوا',
        'show_count' => 'تعداد بازدید ها',
        'status' => 'وضعیت نمایش',
        'order' => 'ترتیب نمایش',
        'created_at' => 'تاریخ ایجاد',
        'updated_at' => 'تاریخ بروزرسانی',
        'lang' => 'زبان',
    ],
    'relations'=>[
        'author'=>'نویسنده',
        'category'=>'دسته بندی',
        'comments'=>'نظرات',
        'tags'=>'برچسب ها',
    ],
    "values" => [
        "select_items" => "گزینه ها ی مورد نظر خود را انتخاب کنید",
        "create_new_record" => "ایجاد صفحه جدید"
    ],
];