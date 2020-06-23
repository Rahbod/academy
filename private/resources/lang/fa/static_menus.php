<?php
return [
    'title'=>"منو ها",
    "table_title" => "لیست تمام منو های سیستم",
    "create_form_title" => "فرم ایجاد منو ها",
    "edit_form_title" => "فرم ویرایش منو ها",
    "items" => [
        "id" => "شناسه",
        "author_id" => "نویسنده",
        "parent_id" => "شاخه والد",
        "name" => "نام",
        "special_name" => "نام ویژه",
        "description" => "توضیحات",
        'status' => 'وضعیت نمایش',
        'order' => 'ترتیب نمایش',
        'has_content' => 'محتوا',
        'type' => 'نوع منو',
        'page_id' => 'صفحه',
        'link' => 'لینک صفحه',
        'updated_at' => 'تاریخ بروزرسانی',
        'created_at' => 'تاریخ ایجاد',
        'lang' => 'زبان',
        'location' => 'موقعيت',

    ],
    'relations'=>[
        'author'=>'نویسنده',
        'page'=>'صفحه',
    ],
    "values" => [
        "select_items" => "گزینه ها ی مورد نظر خود را انتخاب کنید",
        "create_new_record" => "ایجاد منو جدید",
    ],

];