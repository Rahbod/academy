<?php

use Illuminate\Database\Seeder;
use App\SettingGroup;
use App\Setting;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0'); // disable foreign key constraints

        SettingGroup::truncate();
        Setting::truncate();

        $setting_group = SettingGroup::create([
            'name' => 'main',
            'display_name' => 'تنظیمات اصلی سایت',
        ]);
        $order = 1;
        Setting::create([
            'setting_group_id' => $setting_group->id,
            'name' => 'title',
            'display_name' => 'عنوان سایت',
            'value' => 'موسسه زبان',
            'details' => '',
            'type' => 'text',
            'direction' => 'inherit',
            'order' => $order++
        ]);
        Setting::create([
            'setting_group_id' => $setting_group->id,
            'name' => 'status',
            'display_name' => 'وضعیت سایت',
            'value' => '1',
            'details' => 'فعال:1,
غیر فعال:0',
            'type' => 'radio',
            'direction' => 'inherit',
            'order' => $order++
        ]);
        Setting::create([
            'setting_group_id' => $setting_group->id,
            'name' => 'meta_keywords',
            'display_name' => 'کلمات کلیدی',
            'value' => 'زبان، اموزش، زبان انگلیسی',
            'type' => 'textarea',
            'direction' => 'inherit',
            'order' => $order++
        ]);
        Setting::create([
            'setting_group_id' => $setting_group->id,
            'name' => 'meta_description',
            'display_name' => 'توضیحات متا',
            'value' => 'موسسه اموزش زبان',
            'type' => 'textarea',
            'direction' => 'inherit',
            'order' => $order++
        ]);
        Setting::create([
            'setting_group_id' => $setting_group->id,
            'name' => 'footer_tags',
            'display_name' => 'تگ های فوتر',
            'value' => 'language,english,francais,persian',
            'type' => 'textarea',
            'direction' => 'inherit',
            'order' => $order++
        ]);
        Setting::create([
            'setting_group_id' => $setting_group->id,
            'name' => 'developer_name',
            'display_name' => 'Rahbod',
            'value' => 'Rahbod',
            'type' => 'textarea',
            'direction' => 'inherit',
            'order' => $order++
        ]);

        $setting_group = SettingGroup::create([
            'name' => 'about_us',
            'display_name' => 'درباره ما',
        ]);
        $order = 1;
        Setting::create([
            'setting_group_id' => $setting_group->id,
            'name' => 'introduction',
            'display_name' => 'معرفی',
            'value' => 'این متن ازمایشی است',
            'type' => 'textarea',
            'direction' => 'inherit',
            'order' => $order++
        ]);
        Setting::create([
            'setting_group_id' => $setting_group->id,
            'name' => 'email',
            'display_name' => 'email',
            'value' => 'info@zaban.com',
            'type' => 'email',
            'direction' => 'ltr',
            'order' => $order++
        ]);
        Setting::create([
            'setting_group_id' => $setting_group->id,
            'name' => 'telegram',
            'display_name' => 'telegram',
            'value' => 'https://telegram.me/test.org',
            'type' => 'text',
            'direction' => 'ltr',
            'order' => $order++
        ]);
        Setting::create([
            'setting_group_id' => $setting_group->id,
            'name' => 'instagram',
            'display_name' => 'instagram',
            'value' => 'https://www.instagram.com/test.org',
            'type' => 'text',
            'direction' => 'ltr',
            'order' => $order++
        ]);
        Setting::create([
            'setting_group_id' => $setting_group->id,
            'name' => 'facebook',
            'display_name' => 'facebook',
            'value' => 'https://www.facebook.com/test.org',
            'type' => 'text',
            'direction' => 'ltr',
            'order' => $order++
        ]);
        Setting::create([
            'setting_group_id' => $setting_group->id,
            'name' => 'google_plus',
            'display_name' => 'google plus',
            'value' => 'https://plus.google.com/+test.org',
            'type' => 'text',
            'direction' => 'ltr',
            'order' => $order++
        ]);
        Setting::create([
            'setting_group_id' => $setting_group->id,
            'name' => 'twitter',
            'display_name' => 'twitter',
            'value' => 'https://twitter.com/test.org',
            'type' => 'text',
            'direction' => 'ltr',
            'order' => $order++
        ]);
        Setting::create([
            'setting_group_id' => $setting_group->id,
            'name' => 'phone',
            'display_name' => 'تلفن',
            'value' => '0098253700000',
            'type' => 'text',
            'direction' => 'inherit',
            'order' => $order++
        ]);
        Setting::create([
            'setting_group_id' => $setting_group->id,
            'name' => 'fax',
            'display_name' => 'فکس',
            'value' => '009823000000',
            'type' => 'text',
            'direction' => 'inherit',
            'order' => $order++
        ]);
        Setting::create([
            'setting_group_id' => $setting_group->id,
            'name' => 'address',
            'display_name' => 'آدرس',
            'value' => '  ایران ـ قم ـ ...',
            'type' => 'textarea',
            'direction' => 'inherit',
            'order' => $order++
        ]);
        Setting::create([
            'setting_group_id' => $setting_group->id,
            'name' => 'longitude',
            'display_name' => 'طول جغرافیایی',
            'value' => '000',
            'type' => 'text',
            'direction' => 'inherit',
            'order' => $order++
        ]);
        Setting::create([
            'setting_group_id' => $setting_group->id,
            'name' => 'latitude',
            'display_name' => 'عرض جغرافیایی',
            'value' => '000',
            'type' => 'text',
            'direction' => 'inherit',
            'order' => $order++
        ]);

        $setting_group = SettingGroup::create([
            'name' => 'user',
            'display_name' => 'تنظیمات کاربران',
        ]);
        $order = 1;
        Setting::create([
            'setting_group_id' => $setting_group->id,
            'name' => 'avatar_size',
            'display_name' => 'حجم آواتار',
            'value' => '500',
            'details' => '',
            'type' => 'text',
            'direction' => 'inherit',
            'order' => $order++
        ]);
        Setting::create([
            'setting_group_id' => $setting_group->id,
            'name' => 'avatar_width',
            'display_name' => 'طول آواتار',
            'value' => '250',
            'details' => '',
            'type' => 'text',
            'direction' => 'inherit',
            'order' => $order++
        ]);
        Setting::create([
            'setting_group_id' => $setting_group->id,
            'name' => 'avatar_height',
            'display_name' => 'عرض آواتار',
            'value' => '250',
            'details' => '',
            'type' => 'text',
            'direction' => 'inherit',
            'order' => $order++
        ]);
        Setting::create([
            'setting_group_id' => $setting_group->id,
            'name' => 'avatar_extension',
            'display_name' => 'پسوند های مجاز تصویر',
            'value' => "jpg, jpeg, png",
            'details' => '',
            'type' => 'text',
            'direction' => 'inherit',
            'order' => $order++
        ]);
        Setting::create([
            'setting_group_id' => $setting_group->id,
            'name' => 'avatar_destination',
            'display_name' => 'مسیر ذخیره آواتار',
            'value' => "users/avatar/",
            'details' => '',
            'type' => 'text',
            'direction' => 'ltr',
            'order' => $order++
        ]);

        $setting_group = SettingGroup::create([
            'name' => 'content',
            'display_name' => 'تنظیمات مطالب',
        ]);
        $order = 1;
        Setting::create([
            'setting_group_id' => $setting_group->id,
            'name' => 'logo_size',
            'display_name' => 'حجم لوگو',
            'value' => '500',
            'details' => '',
            'type' => 'text',
            'direction' => 'inherit',
            'order' => $order++
        ]);
        Setting::create([
            'setting_group_id' => $setting_group->id,
            'name' => 'logo_width',
            'display_name' => 'طول لوگو',
            'value' => '250',
            'details' => '',
            'type' => 'text',
            'direction' => 'inherit',
            'order' => $order++
        ]);
        Setting::create([
            'setting_group_id' => $setting_group->id,
            'name' => 'logo_height',
            'display_name' => 'عرض لوگو',
            'value' => '250',
            'details' => '',
            'type' => 'text',
            'direction' => 'inherit',
            'order' => $order++
        ]);
        Setting::create([
            'setting_group_id' => $setting_group->id,
            'name' => 'logo_extension',
            'display_name' => 'پسوند های مجاز لوگو',
            'value' => "jpg, jpeg, png",
            'details' => '',
            'type' => 'text',
            'direction' => 'inherit',
            'order' => $order++
        ]);
        Setting::create([
            'setting_group_id' => $setting_group->id,
            'name' => 'logo_destination',
            'display_name' => 'مسیر ذخیره لوگو',
            'value' => "content/logo/",
            'details' => '',
            'type' => 'text',
            'direction' => 'ltr',
            'order' => $order++
        ]);

        Setting::create([
            'setting_group_id' => $setting_group->id,
            'name' => 'image_size',
            'display_name' => 'حجم تصویر',
            'value' => '500',
            'details' => '',
            'type' => 'text',
            'direction' => 'inherit',
            'order' => $order++
        ]);
        Setting::create([
            'setting_group_id' => $setting_group->id,
            'name' => 'image_width',
            'display_name' => 'طول تصویر',
            'value' => '700',
            'details' => '',
            'type' => 'text',
            'direction' => 'inherit',
            'order' => $order++
        ]);
        Setting::create([
            'setting_group_id' => $setting_group->id,
            'name' => 'image_height',
            'display_name' => 'عرض تصویر',
            'value' => '450',
            'details' => '',
            'type' => 'text',
            'direction' => 'inherit',
            'order' => $order++
        ]);
        Setting::create([
            'setting_group_id' => $setting_group->id,
            'name' => 'image_extension',
            'display_name' => 'پسوند های مجاز تصویر',
            'value' => "jpg, jpeg, png",
            'details' => '',
            'type' => 'text',
            'direction' => 'inherit',
            'order' => $order++
        ]);
        Setting::create([
            'setting_group_id' => $setting_group->id,
            'name' => 'image_destination',
            'display_name' => 'مسیر ذخیره تصویر',
            'value' => "content/image/",
            'details' => '',
            'type' => 'text',
            'direction' => 'ltr',
            'order' => $order++
        ]);

        $setting_group = SettingGroup::create([
            'name' => 'page',
            'display_name' => 'تنظیمات برگه ها',
        ]);
        $order = 1;
        Setting::create([
            'setting_group_id' => $setting_group->id,
            'name' => 'image_size',
            'display_name' => 'حجم تصویر',
            'value' => '500',
            'details' => '',
            'type' => 'text',
            'direction' => 'inherit',
            'order' => $order++
        ]);
        Setting::create([
            'setting_group_id' => $setting_group->id,
            'name' => 'image_width',
            'display_name' => 'طول تصویر',
            'value' => '200',
            'details' => '',
            'type' => 'text',
            'direction' => 'inherit',
            'order' => $order++
        ]);
        Setting::create([
            'setting_group_id' => $setting_group->id,
            'name' => 'image_height',
            'display_name' => 'عرض تصویر',
            'value' => '278',
            'details' => '',
            'type' => 'text',
            'direction' => 'inherit',
            'order' => $order++
        ]);
        Setting::create([
            'setting_group_id' => $setting_group->id,
            'name' => 'image_extension',
            'display_name' => 'پسوند های مجاز تصویر',
            'value' => "jpg, jpeg, png",
            'details' => '',
            'type' => 'text',
            'direction' => 'inherit',
            'order' => $order++
        ]);
        Setting::create([
            'setting_group_id' => $setting_group->id,
            'name' => 'image_destination',
            'display_name' => 'مسیر ذخیره تصویر',
            'value' => "page/image/",
            'details' => '',
            'type' => 'text',
            'direction' => 'ltr',
            'order' => $order++
        ]);

        $setting_group = SettingGroup::create([
            'name' => 'course',
            'display_name' => 'تنظیمات دوره ها',
        ]);
        $order = 1;

        Setting::create([
            'setting_group_id' => $setting_group->id,
            'name' => 'image_size',
            'display_name' => 'حجم تصویر',
            'value' => '500',
            'details' => '',
            'type' => 'text',
            'direction' => 'inherit',
            'order' => $order++
        ]);
        Setting::create([
            'setting_group_id' => $setting_group->id,
            'name' => 'image_width',
            'display_name' => 'طول تصویر',
            'value' => '700',
            'details' => '',
            'type' => 'text',
            'direction' => 'inherit',
            'order' => $order++
        ]);
        Setting::create([
            'setting_group_id' => $setting_group->id,
            'name' => 'image_height',
            'display_name' => 'عرض تصویر',
            'value' => '450',
            'details' => '',
            'type' => 'text',
            'direction' => 'inherit',
            'order' => $order++
        ]);
        Setting::create([
            'setting_group_id' => $setting_group->id,
            'name' => 'image_extension',
            'display_name' => 'پسوند های مجاز تصویر',
            'value' => "jpg, jpeg, png",
            'details' => '',
            'type' => 'text',
            'direction' => 'inherit',
            'order' => $order++
        ]);
        Setting::create([
            'setting_group_id' => $setting_group->id,
            'name' => 'image_destination',
            'display_name' => 'مسیر ذخیره تصویر',
            'value' => "course/image/",
            'details' => '',
            'type' => 'text',
            'direction' => 'ltr',
            'order' => $order++
        ]);

        $setting_group = SettingGroup::create([
            'name' => 'class_room',
            'display_name' => 'تنظیمات کلاس ها',
        ]);
        $order = 1;

        Setting::create([
            'setting_group_id' => $setting_group->id,
            'name' => 'image_size',
            'display_name' => 'حجم تصویر',
            'value' => '500',
            'details' => '',
            'type' => 'text',
            'direction' => 'inherit',
            'order' => $order++
        ]);
        Setting::create([
            'setting_group_id' => $setting_group->id,
            'name' => 'image_width',
            'display_name' => 'طول تصویر',
            'value' => '700',
            'details' => '',
            'type' => 'text',
            'direction' => 'inherit',
            'order' => $order++
        ]);
        Setting::create([
            'setting_group_id' => $setting_group->id,
            'name' => 'image_height',
            'display_name' => 'عرض تصویر',
            'value' => '450',
            'details' => '',
            'type' => 'text',
            'direction' => 'inherit',
            'order' => $order++
        ]);
        Setting::create([
            'setting_group_id' => $setting_group->id,
            'name' => 'image_extension',
            'display_name' => 'پسوند های مجاز تصویر',
            'value' => "jpg, jpeg, png",
            'details' => '',
            'type' => 'text',
            'direction' => 'inherit',
            'order' => $order++
        ]);
        Setting::create([
            'setting_group_id' => $setting_group->id,
            'name' => 'image_destination',
            'display_name' => 'مسیر ذخیره تصویر',
            'value' => "class_room/image/",
            'details' => '',
            'type' => 'text',
            'direction' => 'ltr',
            'order' => $order++
        ]);

        $setting_group = SettingGroup::create([
            'name' => 'slider',
            'display_name' => 'تنظیمات اسلایدر ها',
        ]);
        $order = 1;
        Setting::create([
            'setting_group_id' => $setting_group->id,
            'name' => 'image_size',
            'display_name' => 'حجم تصویر',
            'value' => '500',
            'details' => '',
            'type' => 'text',
            'direction' => 'inherit',
            'order' => $order++
        ]);
        Setting::create([
            'setting_group_id' => $setting_group->id,
            'name' => 'image_width',
            'display_name' => 'طول تصویر',
            'value' => '700',
            'details' => '',
            'type' => 'text',
            'direction' => 'inherit',
            'order' => $order++
        ]);
        Setting::create([
            'setting_group_id' => $setting_group->id,
            'name' => 'image_height',
            'display_name' => 'عرض تصویر',
            'value' => '450',
            'details' => '',
            'type' => 'text',
            'direction' => 'inherit',
            'order' => $order++
        ]);
        Setting::create([
            'setting_group_id' => $setting_group->id,
            'name' => 'image_extension',
            'display_name' => 'پسوند های مجاز تصویر',
            'value' => "jpg, jpeg, png",
            'details' => '',
            'type' => 'text',
            'direction' => 'inherit',
            'order' => $order++
        ]);
        Setting::create([
            'setting_group_id' => $setting_group->id,
            'name' => 'image_destination',
            'display_name' => 'مسیر ذخیره تصویر',
            'value' => "slider/image/",
            'details' => '',
            'type' => 'text',
            'direction' => 'ltr',
            'order' => $order++
        ]);

        $setting_group = SettingGroup::create([
            'name' => 'translate_request',
            'display_name' => 'تنظیمات درخواست های ترجمه',
        ]);
        $order = 1;
        Setting::create([
            'setting_group_id' => $setting_group->id,
            'name' => 'translated_file_size',
            'display_name' => ' حجم فایل ترجمه',
            'value' => '500',
            'details' => '',
            'type' => 'text',
            'direction' => 'inherit',
            'order' => $order++
        ]);
        Setting::create([
            'setting_group_id' => $setting_group->id,
            'name' => 'translated_file_extension',
            'display_name' => 'پسوند های مجاز فایل ترجمه ',
            'value' => "doc,docx,pdf,zip,rar",
            'details' => '',
            'type' => 'text',
            'direction' => 'inherit',
            'order' => $order++
        ]);
        Setting::create([
            'setting_group_id' => $setting_group->id,
            'name' => 'translated_file_destination',
            'display_name' => 'مسیر ذخیره فایل ترجمه',
            'value' => "translate_request/",
            'details' => '',
            'type' => 'text',
            'direction' => 'ltr',
            'order' => $order++
        ]);

        $setting_group = SettingGroup::create([
            'name' => 'attachment',
            'display_name' => 'تنظیمات فایل های ضمیمه',
        ]);
        $order = 1;
        Setting::create([
            'setting_group_id' => $setting_group->id,
            'name' => 'attachment_size',
            'display_name' => 'حجم فایل ضمیمه',
            'value' => '2048',
            'details' => '',
            'type' => 'text',
            'direction' => 'inherit',
            'order' => $order++
        ]);
        Setting::create([
            'setting_group_id' => $setting_group->id,
            'name' => 'attachment_extension',
            'display_name' => 'پسوند های مجاز فایل ضمیمه',
            'value' => "doc,docx,pdf,zip,rar,txt",
            'details' => '',
            'type' => 'text',
            'direction' => 'inherit',
            'order' => $order++
        ]);
        Setting::create([
            'setting_group_id' => $setting_group->id,
            'name' => 'attachment_destination',
            'display_name' => 'مسیر ذخیره فایل ضمیمه',
            'value' => "attachment/",
            'details' => '',
            'type' => 'text',
            'direction' => 'ltr',
            'order' => $order++
        ]);

    }
}
