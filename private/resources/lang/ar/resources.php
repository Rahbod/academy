<?php

return [
    "title"=>'منابع',
    'table_title' => 'لیست تمام منابع سیستم',
    'create_form_title' => 'فرم ایجاد منابع',
    'edit_form_title' => 'فرم ویرایش منابع',
    'items' => [
        'id' => 'شناسه',
        'department_id' => 'دپارتمان',
        'parent_id' => 'شاخه والد',
        'resource_group_id' => 'گروه منابع',
        'name' => 'نام',
        'display_name' => 'نام جهت نمایش',
        'namespace' => 'فضای نام',
        'description' => 'توضیحات',
    ],
    'relations'=>[
        'resource_group'=>'گروه منابع',
        'department'=>'دپارتمان',
        'actions'=>'عملیات',
    ],
    'values' => [
        'has'=>'دارد',
        'has_not'=>'ندارد',
        'active'=>'فعال',
        'inactive'=>'غیر فعال',
        'create_new_record' => 'ایجاد منابع جدید',
        'general'=>'عمومی',
        'page_loader'=>'لود کننده صفحه',
        'frame_loader'=>'لود کننده فریم',
    ],
    'messages' => [
        'table_loading' => 'لیست منابع در حال بارگذاری است ...',
        'table_not_found_record' => 'هیچ اطلاعاتی در جدول منابع پیدا نشد.'
    ]
];