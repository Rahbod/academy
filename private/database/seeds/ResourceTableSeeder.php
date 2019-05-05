<?php

use Illuminate\Database\Seeder;
use App\ResourceGroup;
use App\Resource;
use App\Department;

class ResourceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0'); // disable foreign key constraints

        ResourceGroup::truncate();
        Resource::truncate();

        $system_management_department=Department::where('name','system_management')->first(['id']);

        /***********dashboard resources************/
        $resource_group = ResourceGroup::create([
            'department_id'=>$system_management_department->id,
            'name' => 'dashboard',
            'display_name' => 'داشبورد '.$system_management_department->display_name,
        ]);
        Resource::create([
            'resource_group_id' => $resource_group->id,
            'name' => 'Dashboard',
            'display_name' => 'داشبورد '.$system_management_department->display_name,
        ]);

        /***********profile resources************/
        $resource_group = ResourceGroup::create([
            'department_id'=>$system_management_department->id,
            'name' => 'profile',
            'display_name' => 'پروفایل',
        ]);
        Resource::create([
            'resource_group_id' => $resource_group->id,
            'name' => 'Profile',
            'display_name' => 'پروفایل'
        ]);




        /***********resources resources************/
        $resource_group = ResourceGroup::create([
            'department_id'=>$system_management_department->id,
            'name' => 'resources',
            'display_name' => 'منابع',
        ]);

        $namespace_resource=Resource::create([
            'resource_group_id' => $resource_group->id,
            'name' => 'SpNamespace',
            'display_name' => 'فضاهای نام'
        ]);
        $department_resource=Resource::create([
            'parent_id' => $namespace_resource->id,
            'resource_group_id' => $resource_group->id,
            'name' => 'Department',
            'display_name' => 'دپارتمان ها'
        ]);

        $resource_group_resource=Resource::create([
            'parent_id' => $department_resource->id,
            'resource_group_id' => $resource_group->id,
            'name' => 'ResourceGroup',
            'display_name' => 'گروههای منابع'
        ]);
        $resource_resource=Resource::create([
            'parent_id' => $resource_group_resource->id,
            'resource_group_id' => $resource_group->id,
            'name' => 'Resource',
            'display_name' => 'منابع'
        ]);
        Resource::create([
            'parent_id' => $resource_resource->id,
            'resource_group_id' => $resource_group->id,
            'name' => 'Action',
            'display_name' => 'عملیات'
        ]);



        /***********paths resources************/
        $resource_group = ResourceGroup::create([
            'department_id'=>$system_management_department->id,
            'name' => 'paths',
            'display_name' => 'مسیر ها',
        ]);

        Resource::create([
            'resource_group_id' => $resource_group->id,
            'name' => 'Path',
            'display_name' => 'مسیر ها'
        ]);

        /***********menu resources************/
        $resource_group = ResourceGroup::create([
            'department_id'=>$system_management_department->id,
            'name' => 'menus',
            'display_name' => 'منو ها',
        ]);
        $menu_resource=Resource::create([
            'resource_group_id' => $resource_group->id,
            'name' => 'Menu',
            'display_name' => 'منو ها'
        ]);
        Resource::create([
            'parent_id' => $menu_resource->id,
            'resource_group_id' => $resource_group->id,
            'name' => 'MenuItem',
            'display_name' => 'آیتم های منو'
        ]);

        /***********setting resources************/
        $resource_group = ResourceGroup::create([
            'department_id'=>$system_management_department->id,
            'name' => 'settings',
            'display_name' => 'تنظیمات',
        ]);
        $setting_group_resource=Resource::create([
            'resource_group_id' => $resource_group->id,
            'name' => 'SettingGroup',
            'display_name' => 'گروه تنظیمات'
        ]);
        Resource::create([
            'parent_id' => $setting_group_resource->id,
            'resource_group_id' => $resource_group->id,
            'name' => 'Setting',
            'display_name' => 'تنظیمات'
        ]);


        /*************admin management***********/

        $admin_department=Department::where('name','admin')->first(['id']);

        /***********dashboard resources************/
        $resource_group = ResourceGroup::create([
            'department_id'=>$admin_department->id,
            'name' => 'dashboard',
            'display_name' => 'داشبورد مدیریت محتوا',
        ]);
        Resource::create([
            'resource_group_id' => $resource_group->id,
            'name' => 'Dashboard',
            'display_name' => 'داشبورد مدیریت محتوا'
        ]);


        /***********profile resources************/
        $resource_group = ResourceGroup::create([
            'department_id'=>$admin_department->id,
            'name' => 'profile',
            'display_name' => 'پروفایل',
        ]);
        Resource::create([
            'resource_group_id' => $resource_group->id,
            'name' => 'Profile',
            'display_name' => 'پروفایل'
        ]);

        /***********user resources************/
        $resource_group = ResourceGroup::create([
            'department_id'=>$admin_department->id,
            'name' => 'users',
            'display_name' => 'کاربران',
        ]);
        Resource::create([
            'resource_group_id' => $resource_group->id,
            'name' => 'User',
            'display_name' => 'کاربران'
        ]);

        /***********role resources************/
        $resource_group = ResourceGroup::create([
            'department_id'=>$admin_department->id,
            'name' => 'roles',
            'display_name' => 'نقش ها',
        ]);
        Resource::create([
            'resource_group_id' => $resource_group->id,
            'name' => 'Role',
            'display_name' => 'نقش ها'
        ]);

        /***********Registers resources************/
        $resource_group = ResourceGroup::create([
            'department_id'=>$admin_department->id,
            'name' => 'user_class',
            'display_name' => 'لیست ثبت نام ها',
        ]);
        Resource::create([
            'resource_group_id' => $resource_group->id,
            'name' => 'UserClass',
            'display_name' => 'ثبت نام'
        ]);


        /***********category resources************/
        $resource_group = ResourceGroup::create([
            'department_id'=>$admin_department->id,
            'name' => 'categories',
            'display_name' => 'دسته بندی ها',
        ]);
        Resource::create([
            'resource_group_id' => $resource_group->id,
            'name' => 'Category',
            'display_name' => 'دسته بندی ها'
        ]);


        /***********Course resources************/
        $resource_group = ResourceGroup::create([
            'department_id'=>$admin_department->id,
            'name' => 'courses',
            'display_name' => 'دوره ها',
        ]);
        $slider_category_Resource=Resource::create([
            'resource_group_id' => $resource_group->id,
            'name' => 'Course',
            'display_name' => 'دوره ها'
        ]);
        Resource::create([
            'resource_group_id' => $resource_group->id,
            'parent_id'=>$slider_category_Resource->id,
            'name' => 'ClassRoom',
            'display_name' => 'کلاس ها'
        ]);

        /***********content resources************/
        $resource_group = ResourceGroup::create([
            'department_id'=>$admin_department->id,
            'name' => 'contents',
            'display_name' => 'مطالب',
        ]);
        Resource::create([
            'resource_group_id' => $resource_group->id,
            'name' => 'Content',
            'display_name' => 'مطالب'
        ]);

        /***********Page resources************/
        $resource_group = ResourceGroup::create([
            'department_id'=>$admin_department->id,
            'name' => 'pages',
            'display_name' => 'برگه ها',
        ]);
        Resource::create([
            'resource_group_id' => $resource_group->id,
            'name' => 'Page',
            'display_name' => 'برگه ها'
        ]);

        /***********Slider resources************/
        $resource_group = ResourceGroup::create([
            'department_id'=>$admin_department->id,
            'name' => 'sliders',
            'display_name' => 'اسلایدرها',
        ]);
        $slider_category_Resource=Resource::create([
            'resource_group_id' => $resource_group->id,
            'name' => 'SliderGroup',
            'display_name' => 'دسته بندی اسلایدر'
        ]);
        Resource::create([
            'resource_group_id' => $resource_group->id,
            'parent_id'=>$slider_category_Resource->id,
            'name' => 'Slider',
            'display_name' => 'اسلایدرها'
        ]);

        /***********Tag resources************/
        $resource_group = ResourceGroup::create([
            'department_id'=>$admin_department->id,
            'name' => 'tags',
            'display_name' => 'برچسب ها',
        ]);
        Resource::create([
            'resource_group_id' => $resource_group->id,
            'name' => 'Tag',
            'display_name' => 'برچسب ها'
        ]);

        /***********Static Menu resources************/
        $resource_group = ResourceGroup::create([
            'department_id'=>$admin_department->id,
            'name' => 'static_menu',
            'display_name' => 'منو های اصلی',
        ]);
        Resource::create([
            'resource_group_id' => $resource_group->id,
            'name' => 'StaticMenu',
            'display_name' => 'منو های اصلی'
        ]);

        /***********TranslateRequest Menu resources************/
        $resource_group = ResourceGroup::create([
            'department_id'=>$admin_department->id,
            'name' => 'translate_request',
            'display_name' => 'درخواست ترجمه',
        ]);
        Resource::create([
            'resource_group_id' => $resource_group->id,
            'name' => 'TranslateRequest',
            'display_name' => 'درخواست های ترجمه'
        ]);

        /***********TranslateRequest Menu resources************/
        $resource_group = ResourceGroup::create([
            'department_id'=>$admin_department->id,
            'name' => 'attachment',
            'display_name' => 'فایل های پیوستی',
        ]);
        Resource::create([
            'resource_group_id' => $resource_group->id,
            'name' => 'Attachment',
            'display_name' => 'فایل های پیوستی'
        ]);

        /***********setting resources************/
        $resource_group = ResourceGroup::create([
            'department_id'=>$admin_department->id,
            'name' => 'user_transaction',
            'display_name' => 'عملیات مالی',
        ]);

        Resource::create([
            'parent_id' => $setting_group_resource->id,
            'resource_group_id' => $resource_group->id,
            'name' => 'UserTransaction',
            'display_name' => 'عملیات مالی'
        ]);

        /***********setting resources************/
        $resource_group = ResourceGroup::create([
            'department_id'=>$admin_department->id,
            'name' => 'settings',
            'display_name' => 'تنظیمات',
        ]);

        Resource::create([
            'parent_id' => $setting_group_resource->id,
            'resource_group_id' => $resource_group->id,
            'name' => 'Setting',
            'display_name' => 'تنظیمات'
        ]);

    }
}
