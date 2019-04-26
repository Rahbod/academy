<?php

return [
    "title"=>'عملیات',
    'table_title' => 'لیست تمام عملیات سیستم',
    'create_form_title' => 'فرم ایجاد عملیات',
    'edit_form_title' => 'فرم ویرایش عملیات',
    'items' => [
        'main_name' => 'عملیات',
        'id' => 'شناسه',
        'department_id' => 'دپارتمان',
        'resource_id' => 'منبع',
        'name' => 'نام',
        'resource_name' => 'نام منبع',
        'display_name' => 'نام جهت نمایش',
        'type' => 'نوع',
        'need_allow' => 'نیاز به اجازه دسترسی',
        'status' => 'وضعیت',
        'description' => 'توضیحات',
    ],
    'relations'=>[
        'resource'=>'منبع',
        'paths'=>'مسیرها',
    ],
    'values' => [
        'create_new_record' => 'ایجاد عملیات جدید',
        'has'=>'دارد',
        'has_not'=>'ندارد',
        'active'=>'فعال',
        'inactive'=>'غیر فعال',
        'general'=>'عمومی',
        'page_loader'=>'لود کننده صفحه',
        'frame_loader'=>'لود کننده فریم',
    ],
    'messages' => [
        'table_loading' => 'لیست عملیات در حال بارگذاری است ...',
        'table_not_found_record' => 'هیچ اطلاعاتی در جدول عملیات پیدا نشد.'
    ]
];