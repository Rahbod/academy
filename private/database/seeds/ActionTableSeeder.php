<?php

use App\Path;
use Illuminate\Database\Seeder;
use App\Action;

class ActionTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::statement('SET FOREIGN_KEY_CHECKS = 0'); // disable foreign key constraints
        Action::truncate();
        Path::truncate();

        $management_resources = [
            'SpNamespace',
            'Department',
            'ResourceGroup',
            'Resource',
            'Action',
            'Role',
            'User',
            'Path',
            'MenuItem',
            'Menu',
            'SettingGroup',

            'Course',
            'ClassRoom',
            'Category',
            'Content',
            'Page',
            'StaticMenu',
            'SliderGroup',
            'Slider',
            'Tag',
            'NewsLetter',
            'UserClass',
            'TranslateRequest',
            'Attachment',
        ];

        $commentable_resources = ['Content', 'Page'];
        $have_file_manager_resource = ['Content','Page','Course','ClassRoom', 'Slider'];
        $have_settings = ['Content','Page', 'Course', 'ClassRoom', 'Slider'];
        $profile_actions = [
            [
                'name' => 'getActions',
                'display_name' => 'دریافت دسترسی ها',
                'need_allow' => 0,
                'status' => 1,
                'paths' => [
                    [
                        'name' => 'Profile.get_actions',
                        'display_name' => 'عملیات مجاز  ',
                        'slug' => 'profile/get_actions',
                        'method' => 'get',
                    ]
                ],
            ],
            [
                'name' => 'index',
                'display_name' => 'پروفایل',
                'need_allow' => 0,
                'status' => 1,
                'paths' => [
                    [
                        'name' => 'Profile.index',
                        'display_name' => 'مدیریت پروفایل ',
                        'slug' => 'profile',
                        'method' => 'get',
                    ]
                ]
            ],
            [
                'name' => 'getFormInfo',
                'display_name' => 'دریافت اطلاعت فرم ویرایش پروفایل',
                'need_allow' => 0,
                'status' => 1,
                'paths' => [
                    [
                        'name' => 'Profile.getFormInfo',
                        'display_name' => 'دریافت اطلاعت فرم ویرایش پروفایل',
                        'slug' => 'profile/get_form_info',
                        'method' => 'post',
                    ]
                ]
            ],
            [
                'name' => 'updateBasicInfo',
                'display_name' => 'بروزرسانی اطلاعات پایه کاربری',
                'need_allow' => 0,
                'status' => 1,
                'paths' => [
                    [
                        'name' => 'Profile.updateBasicInfo',
                        'display_name' => 'بروزرسانی اطلاعات پایه کاربری',
                        'slug' => 'profile/update_basic_info',
                        'method' => 'put',
                    ]
                ]
            ],
            [
                'name' => 'updateAboutUser',
                'display_name' => 'بروزرسانی درباره کاربر ',
                'need_allow' => 0,
                'status' => 1,
                'paths' => [
                    [
                        'name' => 'Profile.updateAboutUser',
                        'display_name' => 'بروزرسانی درباره کاربر ',
                        'slug' => 'profile/update_about_user',
                        'method' => 'put',
                    ]
                ]
            ],
            [
                'name' => 'updatePersonalInfo',
                'display_name' => 'بروزرسانی اطلاعات انفرادی ',
                'need_allow' => 0,
                'status' => 1,
                'paths' => [
                    [
                        'name' => 'Profile.updatePersonalInfo',
                        'display_name' => 'بروزرسانی اطلاعات انفرادی ',
                        'slug' => 'profile/update_personal_info',
                        'method' => 'put',
                    ]
                ]
            ],
            [
                'name' => 'updatePassword',
                'display_name' => 'بروزرسانی رمزعبور',
                'need_allow' => 0,
                'status' => 1,
                'paths' => [
                    [
                        'name' => 'Profile.updatePassword',
                        'display_name' => 'بروزرسانی رمزعبور',
                        'slug' => 'profile/update_password',
                        'method' => 'put',
                    ]
                ]
            ]
        ];
        $dashboard_actions = [
            [
                'name' => 'index',
                'display_name' => 'داشبورد',
                'need_allow' => 1,
                'status' => 1,
                'paths' => [
                    [
                        'name' => 'Dashboard.index',
                        'display_name' => 'صفحه اصلی مدیریت ',
                        'slug' => '',
                        'method' => 'get',
                    ]
                ]
            ],
        ];
        $special_resource = [
            'system_management' => [
                'Dashboard' => $dashboard_actions,
                'Profile' => $profile_actions,
                'Path' => [
                    [
                        'name' => 'changeDepartment',
                        'display_name' => 'تغییر دپارتمان',
                        'need_allow' => 0,
                        'status' => 1,
                        'paths' => [
                            [
                                'name' => 'Path.changeDepartment',
                                'display_name' => 'تغییر دپارتمان',
                                'slug' => 'paths/change_department',
                                'method' => 'post',
                            ]
                        ]
                    ],
                ],
                'Resource' => [
                    [
                        'name' => 'changeDepartment',
                        'display_name' => 'تغییر دپارتمان',
                        'need_allow' => 0,
                        'status' => 1,
                        'paths' => [
                            [
                                'name' => 'Resource.changeDepartment',
                                'display_name' => 'تغییر دپارتمان',
                                'slug' => 'resources/change_department',
                                'method' => 'post',
                            ]
                        ]
                    ],
                    [
                        'name' => 'changeResourceGroup',
                        'display_name' => 'تغییر گروه منابع',
                        'need_allow' => 0,
                        'status' => 1,
                        'paths' => [
                            [
                                'name' => 'Resource.changeResourceGroup',
                                'display_name' => 'تغییر گروه منابع',
                                'slug' => 'resources/change_resource_group',
                                'method' => 'post',
                            ]
                        ]
                    ],
                ],
                'Action' => [
                    [
                        'name' => 'changeDepartment',
                        'display_name' => 'تغییر دپارتمان',
                        'need_allow' => 0,
                        'status' => 1,
                        'paths' => [
                            [
                                'name' => 'Action.changeDepartment',
                                'display_name' => 'تغییر دپارتمان',
                                'slug' => 'actions/change_department',
                                'method' => 'post',
                            ]
                        ]
                    ]
                ],
                'NewsLetter' => [
                    [
                        'name' => 'SendEmail',
                        'display_name' => 'فرم ارسال ایمیل',
                        'need_allow' => 1,
                        'status' => 1,
                        'paths' => [
                            [
                                'name' => 'NewsLetter.SendEmailForm',
                                'display_name' => 'فرم ارسال ایمیل',
                                'slug' => 'actions/send_email_form',
                                'method' => 'get',
                            ],
                            [
                                'name' => 'NewsLetter.SendEmail',
                                'display_name' => 'ارسال ایمیل',
                                'slug' => 'actions/send_email_form',
                                'method' => 'post',
                            ]
                        ]
                    ]
                ]

            ],
            'site_management' => [
                'Dashboard' => $dashboard_actions,
                'Profile' => $profile_actions,
                'MenuItem' => [
                    [
                        'name' => 'changeMenu',
                        'display_name' => 'تغییر منو',
                        'need_allow' => 0,
                        'status' => 1,
                        'paths' => [
                            [
                                'name' => 'MenuItem.changeMenu',
                                'display_name' => 'تغییر منو',
                                'slug' => 'menu_items/change_menu',
                                'method' => 'post',
                            ]
                        ]
                    ],
                ],
                'Setting' => [
                    [
                        'name' => 'index',
                        'display_name' => 'مدیریت تنظیمات',
                        'need_allow' => 1,
                        'status' => 1,
                        'paths' => [
                            [
                                'name' => 'site_management.Setting.index',
                                'display_name' => 'مدیریت تنظیمات',
                                'slug' => 'settings',
                                'method' => 'get',
                            ]
                        ]
                    ],
                    [
                        'name' => 'updateAllSettings',
                        'display_name' => 'بروزرسانی تنظیمات',
                        'need_allow' => 1,
                        'status' => 1,
                        'paths' => [
                            [
                                'name' => 'Setting.updateAllSettings',
                                'display_name' => 'فرم بروزرسانی تنظیمات',
                                'slug' => 'settings/update_all_settings',
                                'method' => 'get',
                            ],
                            [
                                'name' => 'Setting.updateAllSettings',
                                'display_name' => 'بروزرسانی تنظیمات',
                                'slug' => 'settings/update_all_settings',
                                'method' => 'put',
                            ]
                        ]
                    ]
                ],
//                'ActivityLog' => [
//                    [
//                        'name' => 'getActions',
//                        'display_name' => 'دریافت دسترسی ها به ' . 'گزارش عملیات',
//                        'need_allow' => 0,
//                        'status' => 1,
//                        'paths' => [
//                            [
//                                'name' => 'ActivityLog' . '.get_actions',
//                                'display_name' => 'عملیات مجاز برای ' . 'گزارش عملیات',
//                                'slug' => 'activity_logs' . '/get_actions',
//                                'method' => 'get',
//                            ]
//                        ],
//                    ],
//                    [
//                        'name' => 'index',
//                        'display_name' => 'مدیریت ' . 'گزارش عملیات',
//                        'need_allow' => 1,
//                        'status' => 1,
//                        'paths' => [
//                            [
//                                'name' => 'ActivityLog' . '.index',
//                                'display_name' => 'مدیریت ' . 'گزارش عملیات',
//                                'slug' => 'activity_logs',
//                                'method' => 'get',
//                            ]
//                        ]
//                    ],
//                    [
//                        'name' => 'list',
//                        'display_name' => 'لیست تمام ' . 'گزارش عملیات',
//                        'need_allow' => 1,
//                        'status' => 1,
//                        'paths' => [
//                            [
//                                'name' => 'ActivityLog' . '.list_view',
//                                'display_name' => 'لیست تمام ' . 'گزارش عملیات',
//                                'slug' => 'activity_logs' . '/list-view',
//                                'method' => 'get',
//                            ]
//                        ]
//                    ],
//                    [
//                        'name' => 'show',
//                        'display_name' => 'مشاهده ' . 'گزارش عملیات',
//                        'need_allow' => 1,
//                        'status' => 1,
//                        'paths' => [
//                            [
//                                'name' => 'ActivityLog' . '.show',
//                                'display_name' => 'مشاهده ' . 'گزارش عملیات',
//                                'slug' => 'activity_logs' . '/{id}',
//                                'method' => 'get',
//                            ]
//                        ]
//                    ],
//                    [
//                        'name' => 'destroy',
//                        'display_name' => 'حذف ' . 'گزارش عملیات',
//                        'need_allow' => 1,
//                        'status' => 1,
//                        'paths' => [
//                            [
//                                'name' => 'ActivityLog' . '.destroy',
//                                'display_name' => 'حذف ' . 'گزارش عملیات',
//                                'slug' => 'activity_logs' . '/{id}',
//                                'method' => 'delete',
//                            ]
//                        ]
//                    ]
//                ],

            ],
            'content_management' => [
                'Dashboard' => $dashboard_actions,
                'Profile' => $profile_actions,
            ],

        ];
        $departments = \App\Department::with('resources')->get();

        foreach ($departments as $department) {
            $order = 1;
            if ($department->name !== 'main') {
                foreach ($department->resources as $resource) {

                    if ($resource->name == 'Setting' and $department->name == 'system_management') {
                        $array_actions = $this->getCrudActions($resource);
                        $this->createActions($array_actions, $order, $department);
                    }
                    if (in_array($resource->name, $commentable_resources)) {
                        $actions = $this->getCommetableActions($resource);
                        $this->createActions($actions, $order, $department);
                    }
                    if (in_array($resource->name, $management_resources)) {
                        $array_actions = $this->getCrudActions($resource);
                        $this->createActions($array_actions, $order, $department);
                    }
                    if (in_array($resource->name, $have_file_manager_resource)) {
                        $actions = $this->getFileMangerActions($resource);
                        $this->createActions($actions, $order, $department);
                    }
                    if (in_array($resource->name, $have_settings)) {
                        $actions = $this->getSettingActions($resource);
                        $this->createActions($actions, $order, $department);
                    }
                    if (isset($special_resource[$department->name])) {
                        foreach ($special_resource[$department->name] as $key => $resource_acions) {
                            if ($resource->name == $key) {
                                $array_actions = [];
                                foreach ($resource_acions as $action) {
                                    $array_action = array_merge($action, ['resource_name' => $resource->name, 'resource_id' => $resource->id]);
                                    $array_actions[] = $array_action;
                                }
                                $this->createActions($array_actions, $order, $department);
                                break;
                            }
                        }
                    }
                }
            }
        }
    }

    private function getCrudActions($resource)
    {
        $resource_name = str_plural(ltrim(strtolower(preg_replace('/[A-Z]([A-Z](?![a-z]))*/', '_$0', $resource->name)), '_'));

        $actions = [
            [
                'resource_id' => $resource->id,
                'resource_name' => $resource->name,
                'name' => 'getActions',
                'display_name' => 'دریافت دسترسی ها به ' . $resource->display_name,
                'need_allow' => 0,
                'status' => 1,
                'paths' => [
                    [
                        'name' => $resource->name . '.get_actions',
                        'display_name' => 'عملیات مجاز برای ' . $resource->display_name,
                        'slug' => $resource_name . '/get_actions',
                        'method' => 'get',
                    ]
                ],
            ],
            [
                'resource_id' => $resource->id,
                'resource_name' => $resource->name,
                'name' => 'index',
                'display_name' => 'مدیریت ' . $resource->display_name,
                'need_allow' => 1,
                'status' => 1,
                'paths' => [
                    [
                        'name' => $resource->name . '.index',
                        'display_name' => 'مدیریت ' . $resource->display_name,
                        'slug' => $resource_name,
                        'method' => 'get',
                    ]
                ]
            ],
            [
                'resource_id' => $resource->id,
                'resource_name' => $resource->name,
                'name' => 'listView',
                'display_name' => 'لیست ' . $resource->display_name,
                'need_allow' => 1,
                'status' => 1,
                'paths' => [
                    [
                        'name' => $resource->name . '.list_view',
                        'display_name' => 'لیست ' . $resource->display_name,
                        'slug' => $resource_name . '/list-view',
                        'method' => 'get',
                    ]
                ]
            ],
            [
                'resource_id' => $resource->id,
                'resource_name' => $resource->name,
                'name' => 'create',
                'display_name' => 'ایجاد ' . $resource->display_name,
                'need_allow' => 1,
                'status' => 1,
                'paths' => [
                    [
                        'name' => $resource->name . '.create',
                        'display_name' => 'فرم ایجاد ' . $resource->display_name,
                        'slug' => $resource_name . '/create',
                        'method' => 'get',
                    ],
                    [
                        'name' => $resource->name . '.store',
                        'display_name' => 'ذخیره ی ' . $resource->display_name,
                        'slug' => $resource_name,
                        'method' => 'post',
                    ]
                ]
            ],
            [
                'resource_id' => $resource->id,
                'resource_name' => $resource->name,
                'name' => 'show',
                'display_name' => 'مشاهده ' . $resource->display_name,
                'need_allow' => 1,
                'status' => 1,
                'paths' => [
                    [
                        'name' => $resource->name . '.show',
                        'display_name' => 'مشاهده ' . $resource->display_name,
                        'slug' => $resource_name . '/{id}',
                        'method' => 'get',
                    ]
                ]
            ],
            [
                'resource_id' => $resource->id,
                'resource_name' => $resource->name,
                'name' => 'edit',
                'display_name' => 'ویرایش ' . $resource->display_name,
                'need_allow' => 1,
                'status' => 1,
                'paths' => [
                    [
                        'name' => $resource->name . '.edit',
                        'display_name' => 'فرم ویرایش ' . $resource->display_name,
                        'slug' => $resource_name . '/{id}/edit',
                        'method' => 'get',
                    ],
                    [
                        'name' => $resource->name . '.update',
                        'display_name' => 'بروز رسانی  ' . $resource->display_name,
                        'slug' => $resource_name . '/{id}',
                        'method' => 'put',
                    ]
                ]
            ],
            [
                'resource_id' => $resource->id,
                'resource_name' => $resource->name,
                'name' => 'destroy',
                'display_name' => 'حذف ' . $resource->display_name,
                'need_allow' => 1,
                'status' => 1,
                'paths' => [
                    [
                        'name' => $resource->name . '.destroy',
                        'display_name' => 'حذف ' . $resource->display_name,
                        'slug' => $resource_name . '/{id}',
                        'method' => 'delete',
                    ]
                ]
            ]

        ];

        return $actions;
    }

    private function getSettingActions($resource)
    {
        $resource_name = str_plural(ltrim(strtolower(preg_replace('/[A-Z]([A-Z](?![a-z]))*/', '_$0', $resource->name)), '_'));

        $actions = [
            [
                'resource_id' => $resource->id,
                'resource_name' => $resource->name,
                'name' => 'updateSettings',
                'display_name' => 'بروز رسانی تنظیمات ' . $resource->display_name,
                'need_allow' => 1,
                'status' => 1,
                'paths' => [
                    [
                        'name' => $resource->name . '.updateSettings',
                        'display_name' => 'بروزرسانی تنظیمات ' . $resource->display_name,
                        'slug' => $resource_name . '/settings/form',
                        'method' => 'get',
                    ],
                    [
                        'name' => $resource->name . '.updateSettings',
                        'display_name' => 'بروز رسانی تنظیمات  ' . $resource->display_name,
                        'slug' => $resource_name . '/settings/update',
                        'method' => 'put',
                    ]
                ],
            ],

        ];

        return $actions;
    }

    private function getCommetableActions($resource)
    {
        $resource_name = str_plural(ltrim(strtolower(preg_replace('/[A-Z]([A-Z](?![a-z]))*/', '_$0', $resource->name)), '_'));

        $actions = [
            [
                'resource_id' => $resource->id,
                'resource_name' => $resource->name,
                'name' => 'indexComment',
                'display_name' => 'مدیریت نظرات ' . $resource->display_name,
                'need_allow' => 1,
                'status' => 1,
                'paths' => [
                    [
                        'name' => $resource->name . '.indexComment',
                        'display_name' => 'مدیریت نظرات ' . $resource->display_name,
                        'slug' => $resource_name . '/comments',
                        'method' => 'get',
                    ]
                ],
            ],
            [
                'resource_id' => $resource->id,
                'resource_name' => $resource->name,
                'name' => 'CommentsListView',
                'display_name' => 'لیست تمام نظرات ' . $resource->display_name,
                'need_allow' => 1,
                'status' => 1,
                'paths' => [
                    [
                        'name' => $resource->name . '.CommentsListView',
                        'display_name' => 'لیست تمام نظرات ' . $resource->display_name,
                        'slug' => $resource_name . '/comments/list-view',
                        'method' => 'get',
                    ]
                ],
            ],
            [
                'resource_id' => $resource->id,
                'resource_name' => $resource->name,
                'name' => 'editComment',
                'display_name' => 'ویرایش نظرات ' . $resource->display_name,
                'need_allow' => 1,
                'status' => 1,
                'paths' => [
                    [
                        'name' => $resource->name . '.editComment',
                        'display_name' => 'فرم ویرایش نظرات ' . $resource->display_name,
                        'slug' => $resource_name . '/comments/{id}/edit',
                        'method' => 'get',
                    ],
                    [
                        'name' => $resource->name . '.editComment',
                        'display_name' => 'بروز رسانی نظرات  ' . $resource->display_name,
                        'slug' => $resource_name . '/comments/{id}',
                        'method' => 'put',
                    ]
                ],
            ],
            [
                'resource_id' => $resource->id,
                'resource_name' => $resource->name,
                'name' => 'showComment',
                'display_name' => 'مشاهده نظرات ' . $resource->display_name,
                'need_allow' => 1,
                'status' => 1,
                'paths' => [
                    [
                        'name' => $resource->name . '.showComment',
                        'display_name' => 'مشاهده نظرات ' . $resource->display_name,
                        'slug' => $resource_name . '/comments/{id}',
                        'method' => 'get',
                    ]
                ],
            ],
            [
                'resource_id' => $resource->id,
                'resource_name' => $resource->name,
                'name' => 'destroyComment',
                'display_name' => 'حذف نظرات ' . $resource->display_name,
                'need_allow' => 1,
                'status' => 1,
                'paths' => [
                    [
                        'name' => $resource->name . '.destroyComment',
                        'display_name' => 'حذف نظرات ' . $resource->display_name,
                        'slug' => $resource_name . '/comments/{id}',
                        'method' => 'delete',
                    ]
                ],
            ],

        ];

        return $actions;
    }

    private function getFileMangerActions($resource)
    {
        $resource_name = str_plural(ltrim(strtolower(preg_replace('/[A-Z]([A-Z](?![a-z]))*/', '_$0', $resource->name)), '_'));

        $actions = [
            [
                'resource_id' => $resource->id,
                'resource_name' => $resource->name,
                'name' => 'showFileManagerConnector',
                'display_name' => 'مشاهده فایل ها ',
                'need_allow' => 1,
                'status' => 1,
                'paths' => [
                    [
                        'name' => $resource->name . '.showFileManagerConnector',
                        'display_name' => 'مشاهده فایل ها ',
                        'slug' => $resource_name . '/file_manager/connector',
                        'method' => 'get',
                    ],
                    [
                        'name' => $resource->name . '.showFileManagerConnector',
                        'display_name' => 'مشاهده فایل ها ',
                        'slug' => $resource_name . '/file_manager/connector',
                        'method' => 'post'
                    ]
                ],
            ],
            [
                'resource_id' => $resource->id,
                'resource_name' => $resource->name,
                'name' => 'showFileManager',
                'display_name' => 'مدیریت فایل ها',
                'need_allow' => 1,
                'status' => 1,
                'paths' => [
                    [
                        'name' => $resource->name . '.showFileManager',
                        'display_name' => 'مدیریت فایل ها',
                        'slug' => $resource_name . '/file_manager/{view}/{input_id?}',
                        'method' => 'get',
                    ]
                ],
            ],

        ];

        return $actions;
    }

    private function createActions($array_actions, &$order, $department)
    {
        foreach ($array_actions as $array_action) {
            $paths = $array_action['paths'];
            unset($array_action['paths']);
            $action = Action::create($array_action);
            foreach ($paths as $path) {
                $aditional = [
                    'department_id' => $department->id,
                    'action_id' => $action->id,
                    'order' => $order++
                ];
                Path::create(array_merge($path, $aditional));
            }
        }
    }
}
