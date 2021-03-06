<?php
return [
    'title' => 'کلاس ها',
    'table_title' => 'لیست تمام کلاس های سیستم',
    'create_form_title' => 'فرم ایجاد کلاس ها',
    'edit_form_title' => 'فرم ویرایش کلاس ها',
    'items' => [
        'id' => 'شناسه',
        'author_id' => 'نویسنده',
        'teacher_id' => 'استاد',
        'term_id' => 'ترم',
        'course_id' => 'دوره',
        'title_fa' => 'عنوان فارسی',
        'title_en' => 'عنوان انگلیسی',
        'image' => 'تصویر',
        'description_fa' => 'توضیحات فارسی',
        'description_en' => 'توضیحات انگلیسی',
        'capacity' => 'ظرفیت',
        'price' => 'قیمت',
        'status' => 'وضعیت',
        'order' => 'ترتیب نمایش',
        'registration_start_date' => 'تاریخ شروع ثبت نام',
        'registration_end_date' => 'تاریخ پایان ثبت نام',
        'course_start_date' => 'تاریخ شروع دوره',
        'course_end_date' => 'تاریخ پایان دوره',
        'created_at' => 'تاریخ ایجاد',
        'updated_at' => 'تاریخ بروزرسانی',
        'lang' => 'زبان',
    ],
    'relations'=>[
        'author'=>'نویسنده',
        'term'=>'دوره',
        'comments'=>'نظرات',
        'tags'=>'برچسب ها',
        'class_room_times'=>'ساعات برگزاری کلاس',
        'users'=>'کاربران'
    ],
    'values' => [
        'select_items' => 'گزینه ها ی مورد نظر خود را انتخاب کنید',
        'create_new_record' => 'ایجاد مطلب جدید'
    ],
];