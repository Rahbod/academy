<?php
return [
    'title'=>"زمان بندی های کلاس",
    "table_title" => "لیست تمام زمان بندی های کلاس",
    "create_form_title" => "فرم ایجاد زمان بندی های کلاس",
    "edit_form_title" => "فرم ویرایش زمان بندی های کلاس",
    "items" => [
        "id" => "شناسه",
        "author_id" => "نویسنده",
        "class_room_id" => "کلاس",
        "start_time" => "ساعت شروع",
        "end_time" => "ساعت پایان",
        "week_day" => "روز هفته",

    ],
    'relations'=>[
        'author'=>'نویسنده',
        'class_room'=>'کلاس',
    ],
    "values" => [
        "select_items" => "گزینه ها ی مورد نظر خود را انتخاب کنید",
        "create_new_record" => "ایجاد دسته بندی جدید"
    ],
];