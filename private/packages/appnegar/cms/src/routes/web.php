<?php


    Route::group(['namespace'=>'Controllers\SystemManagement','prefix'=>'{lang}'],function(){
            
        Route::group(['prefix'=>'system_management','middleware'=>['auth:system_management','set_department:system_management' ,'user_info','lang','remove_additional_params']],function(){

                    
                        
                                                            Route::get('/', ['uses' =>'DashboardController@index','as' =>'system_management.Dashboard.index'])->middleware('acl:1');
                                                                                
                        
                                                            Route::get('/profile/get_actions', ['uses' =>'ProfileController@getActions','as' =>'system_management.Profile.get_actions']);
                                                                                Route::get('/profile', ['uses' =>'ProfileController@index','as' =>'system_management.Profile.index']);
                                                                                Route::post('/profile/get_form_info', ['uses' =>'ProfileController@getFormInfo','as' =>'system_management.Profile.getFormInfo']);
                                                                                Route::put('/profile/update_basic_info', ['uses' =>'ProfileController@updateBasicInfo','as' =>'system_management.Profile.updateBasicInfo']);
                                                                                Route::put('/profile/update_about_user', ['uses' =>'ProfileController@updateAboutUser','as' =>'system_management.Profile.updateAboutUser']);
                                                                                Route::put('/profile/update_personal_info', ['uses' =>'ProfileController@updatePersonalInfo','as' =>'system_management.Profile.updatePersonalInfo']);
                                                                                Route::put('/profile/update_password', ['uses' =>'ProfileController@updatePassword','as' =>'system_management.Profile.updatePassword']);
                                                                                
                        
                                                            Route::get('/sp_namespaces/get_actions', ['uses' =>'SpNamespaceController@getActions','as' =>'system_management.SpNamespace.get_actions']);
                                                                                Route::get('/sp_namespaces', ['uses' =>'SpNamespaceController@index','as' =>'system_management.SpNamespace.index'])->middleware('acl:10');
                                                                                Route::get('/sp_namespaces/list-view', ['uses' =>'SpNamespaceController@listView','as' =>'system_management.SpNamespace.list_view'])->middleware('acl:11');
                                                                                Route::get('/sp_namespaces/create', ['uses' =>'SpNamespaceController@create','as' =>'system_management.SpNamespace.create'])->middleware('acl:12');
                                                                                Route::post('/sp_namespaces', ['uses' =>'SpNamespaceController@create','as' =>'system_management.SpNamespace.store'])->middleware('acl:12');
                                                                                Route::get('/sp_namespaces/{id}', ['uses' =>'SpNamespaceController@show','as' =>'system_management.SpNamespace.show'])->middleware('acl:13');
                                                                                Route::get('/sp_namespaces/{id}/edit', ['uses' =>'SpNamespaceController@edit','as' =>'system_management.SpNamespace.edit'])->middleware('acl:14');
                                                                                Route::put('/sp_namespaces/{id}', ['uses' =>'SpNamespaceController@edit','as' =>'system_management.SpNamespace.update'])->middleware('acl:14');
                                                                                Route::delete('/sp_namespaces/{id}', ['uses' =>'SpNamespaceController@destroy','as' =>'system_management.SpNamespace.destroy'])->middleware('acl:15');
                                                
                                                            Route::get('/departments/get_actions', ['uses' =>'DepartmentController@getActions','as' =>'system_management.Department.get_actions']);
                                                                                Route::get('/departments', ['uses' =>'DepartmentController@index','as' =>'system_management.Department.index'])->middleware('acl:17');
                                                                                Route::get('/departments/list-view', ['uses' =>'DepartmentController@listView','as' =>'system_management.Department.list_view'])->middleware('acl:18');
                                                                                Route::get('/departments/create', ['uses' =>'DepartmentController@create','as' =>'system_management.Department.create'])->middleware('acl:19');
                                                                                Route::post('/departments', ['uses' =>'DepartmentController@create','as' =>'system_management.Department.store'])->middleware('acl:19');
                                                                                Route::get('/departments/{id}', ['uses' =>'DepartmentController@show','as' =>'system_management.Department.show'])->middleware('acl:20');
                                                                                Route::get('/departments/{id}/edit', ['uses' =>'DepartmentController@edit','as' =>'system_management.Department.edit'])->middleware('acl:21');
                                                                                Route::put('/departments/{id}', ['uses' =>'DepartmentController@edit','as' =>'system_management.Department.update'])->middleware('acl:21');
                                                                                Route::delete('/departments/{id}', ['uses' =>'DepartmentController@destroy','as' =>'system_management.Department.destroy'])->middleware('acl:22');
                                                
                                                            Route::get('/resource_groups/get_actions', ['uses' =>'ResourceGroupController@getActions','as' =>'system_management.ResourceGroup.get_actions']);
                                                                                Route::get('/resource_groups', ['uses' =>'ResourceGroupController@index','as' =>'system_management.ResourceGroup.index'])->middleware('acl:24');
                                                                                Route::get('/resource_groups/list-view', ['uses' =>'ResourceGroupController@listView','as' =>'system_management.ResourceGroup.list_view'])->middleware('acl:25');
                                                                                Route::get('/resource_groups/create', ['uses' =>'ResourceGroupController@create','as' =>'system_management.ResourceGroup.create'])->middleware('acl:26');
                                                                                Route::post('/resource_groups', ['uses' =>'ResourceGroupController@create','as' =>'system_management.ResourceGroup.store'])->middleware('acl:26');
                                                                                Route::get('/resource_groups/{id}', ['uses' =>'ResourceGroupController@show','as' =>'system_management.ResourceGroup.show'])->middleware('acl:27');
                                                                                Route::get('/resource_groups/{id}/edit', ['uses' =>'ResourceGroupController@edit','as' =>'system_management.ResourceGroup.edit'])->middleware('acl:28');
                                                                                Route::put('/resource_groups/{id}', ['uses' =>'ResourceGroupController@edit','as' =>'system_management.ResourceGroup.update'])->middleware('acl:28');
                                                                                Route::delete('/resource_groups/{id}', ['uses' =>'ResourceGroupController@destroy','as' =>'system_management.ResourceGroup.destroy'])->middleware('acl:29');
                                                
                                                            Route::get('/resources/get_actions', ['uses' =>'ResourceController@getActions','as' =>'system_management.Resource.get_actions']);
                                                                                Route::get('/resources', ['uses' =>'ResourceController@index','as' =>'system_management.Resource.index'])->middleware('acl:31');
                                                                                Route::get('/resources/list-view', ['uses' =>'ResourceController@listView','as' =>'system_management.Resource.list_view'])->middleware('acl:32');
                                                                                Route::get('/resources/create', ['uses' =>'ResourceController@create','as' =>'system_management.Resource.create'])->middleware('acl:33');
                                                                                Route::post('/resources', ['uses' =>'ResourceController@create','as' =>'system_management.Resource.store'])->middleware('acl:33');
                                                                                Route::get('/resources/{id}', ['uses' =>'ResourceController@show','as' =>'system_management.Resource.show'])->middleware('acl:34');
                                                                                Route::get('/resources/{id}/edit', ['uses' =>'ResourceController@edit','as' =>'system_management.Resource.edit'])->middleware('acl:35');
                                                                                Route::put('/resources/{id}', ['uses' =>'ResourceController@edit','as' =>'system_management.Resource.update'])->middleware('acl:35');
                                                                                Route::delete('/resources/{id}', ['uses' =>'ResourceController@destroy','as' =>'system_management.Resource.destroy'])->middleware('acl:36');
                                                                                Route::post('/resources/change_department', ['uses' =>'ResourceController@changeDepartment','as' =>'system_management.Resource.changeDepartment']);
                                                                                Route::post('/resources/change_resource_group', ['uses' =>'ResourceController@changeResourceGroup','as' =>'system_management.Resource.changeResourceGroup']);
                                                
                                                            Route::get('/actions/get_actions', ['uses' =>'ActionController@getActions','as' =>'system_management.Action.get_actions']);
                                                                                Route::get('/actions', ['uses' =>'ActionController@index','as' =>'system_management.Action.index'])->middleware('acl:40');
                                                                                Route::get('/actions/list-view', ['uses' =>'ActionController@listView','as' =>'system_management.Action.list_view'])->middleware('acl:41');
                                                                                Route::get('/actions/create', ['uses' =>'ActionController@create','as' =>'system_management.Action.create'])->middleware('acl:42');
                                                                                Route::post('/actions', ['uses' =>'ActionController@create','as' =>'system_management.Action.store'])->middleware('acl:42');
                                                                                Route::get('/actions/{id}', ['uses' =>'ActionController@show','as' =>'system_management.Action.show'])->middleware('acl:43');
                                                                                Route::get('/actions/{id}/edit', ['uses' =>'ActionController@edit','as' =>'system_management.Action.edit'])->middleware('acl:44');
                                                                                Route::put('/actions/{id}', ['uses' =>'ActionController@edit','as' =>'system_management.Action.update'])->middleware('acl:44');
                                                                                Route::delete('/actions/{id}', ['uses' =>'ActionController@destroy','as' =>'system_management.Action.destroy'])->middleware('acl:45');
                                                                                Route::post('/actions/change_department', ['uses' =>'ActionController@changeDepartment','as' =>'system_management.Action.changeDepartment']);
                                                                                
                        
                                                            Route::get('/paths/get_actions', ['uses' =>'PathController@getActions','as' =>'system_management.Path.get_actions']);
                                                                                Route::get('/paths', ['uses' =>'PathController@index','as' =>'system_management.Path.index'])->middleware('acl:48');
                                                                                Route::get('/paths/list-view', ['uses' =>'PathController@listView','as' =>'system_management.Path.list_view'])->middleware('acl:49');
                                                                                Route::get('/paths/create', ['uses' =>'PathController@create','as' =>'system_management.Path.create'])->middleware('acl:50');
                                                                                Route::post('/paths', ['uses' =>'PathController@create','as' =>'system_management.Path.store'])->middleware('acl:50');
                                                                                Route::get('/paths/{id}', ['uses' =>'PathController@show','as' =>'system_management.Path.show'])->middleware('acl:51');
                                                                                Route::get('/paths/{id}/edit', ['uses' =>'PathController@edit','as' =>'system_management.Path.edit'])->middleware('acl:52');
                                                                                Route::put('/paths/{id}', ['uses' =>'PathController@edit','as' =>'system_management.Path.update'])->middleware('acl:52');
                                                                                Route::delete('/paths/{id}', ['uses' =>'PathController@destroy','as' =>'system_management.Path.destroy'])->middleware('acl:53');
                                                                                Route::post('/paths/change_department', ['uses' =>'PathController@changeDepartment','as' =>'system_management.Path.changeDepartment']);
                                                                                
                        
                                                            Route::get('/menus/get_actions', ['uses' =>'MenuController@getActions','as' =>'system_management.Menu.get_actions']);
                                                                                Route::get('/menus', ['uses' =>'MenuController@index','as' =>'system_management.Menu.index'])->middleware('acl:56');
                                                                                Route::get('/menus/list-view', ['uses' =>'MenuController@listView','as' =>'system_management.Menu.list_view'])->middleware('acl:57');
                                                                                Route::get('/menus/create', ['uses' =>'MenuController@create','as' =>'system_management.Menu.create'])->middleware('acl:58');
                                                                                Route::post('/menus', ['uses' =>'MenuController@create','as' =>'system_management.Menu.store'])->middleware('acl:58');
                                                                                Route::get('/menus/{id}', ['uses' =>'MenuController@show','as' =>'system_management.Menu.show'])->middleware('acl:59');
                                                                                Route::get('/menus/{id}/edit', ['uses' =>'MenuController@edit','as' =>'system_management.Menu.edit'])->middleware('acl:60');
                                                                                Route::put('/menus/{id}', ['uses' =>'MenuController@edit','as' =>'system_management.Menu.update'])->middleware('acl:60');
                                                                                Route::delete('/menus/{id}', ['uses' =>'MenuController@destroy','as' =>'system_management.Menu.destroy'])->middleware('acl:61');

                                                            Route::get('/menu_items/get_actions', ['uses' =>'MenuItemController@getActions','as' =>'system_management.MenuItem.get_actions']);
                                                                                Route::get('/menu_items', ['uses' =>'MenuItemController@index','as' =>'system_management.MenuItem.index'])->middleware('acl:63');
                                                                                Route::get('/menu_items/list-view', ['uses' =>'MenuItemController@listView','as' =>'system_management.MenuItem.list_view'])->middleware('acl:64');
                                                                                Route::get('/menu_items/create', ['uses' =>'MenuItemController@create','as' =>'system_management.MenuItem.create'])->middleware('acl:65');
                                                                                Route::post('/menu_items', ['uses' =>'MenuItemController@create','as' =>'system_management.MenuItem.store'])->middleware('acl:65');
                                                                                Route::get('/menu_items/{id}', ['uses' =>'MenuItemController@show','as' =>'system_management.MenuItem.show'])->middleware('acl:66');
                                                                                Route::get('/menu_items/{id}/edit', ['uses' =>'MenuItemController@edit','as' =>'system_management.MenuItem.edit'])->middleware('acl:67');
                                                                                Route::put('/menu_items/{id}', ['uses' =>'MenuItemController@edit','as' =>'system_management.MenuItem.update'])->middleware('acl:67');
                                                                                Route::delete('/menu_items/{id}', ['uses' =>'MenuItemController@destroy','as' =>'system_management.MenuItem.destroy'])->middleware('acl:68');
                                                                                Route::post('/menu_items/change_menu', ['uses' =>'MenuItemController@changeMenu','as' =>'system_management.MenuItem.changeMenu']);


                                                            Route::get('/setting_groups/get_actions', ['uses' =>'SettingGroupController@getActions','as' =>'system_management.SettingGroup.get_actions']);
                                                                                Route::get('/setting_groups', ['uses' =>'SettingGroupController@index','as' =>'system_management.SettingGroup.index'])->middleware('acl:71');
                                                                                Route::get('/setting_groups/list-view', ['uses' =>'SettingGroupController@listView','as' =>'system_management.SettingGroup.list_view'])->middleware('acl:72');
                                                                                Route::get('/setting_groups/create', ['uses' =>'SettingGroupController@create','as' =>'system_management.SettingGroup.create'])->middleware('acl:73');
                                                                                Route::post('/setting_groups', ['uses' =>'SettingGroupController@create','as' =>'system_management.SettingGroup.store'])->middleware('acl:73');
                                                                                Route::get('/setting_groups/{id}', ['uses' =>'SettingGroupController@show','as' =>'system_management.SettingGroup.show'])->middleware('acl:74');
                                                                                Route::get('/setting_groups/{id}/edit', ['uses' =>'SettingGroupController@edit','as' =>'system_management.SettingGroup.edit'])->middleware('acl:75');
                                                                                Route::put('/setting_groups/{id}', ['uses' =>'SettingGroupController@edit','as' =>'system_management.SettingGroup.update'])->middleware('acl:75');
                                                                                Route::delete('/setting_groups/{id}', ['uses' =>'SettingGroupController@destroy','as' =>'system_management.SettingGroup.destroy'])->middleware('acl:76');

                                                            Route::get('/settings/get_actions', ['uses' =>'SettingController@getActions','as' =>'system_management.Setting.get_actions']);
                                                                                Route::get('/settings', ['uses' =>'SettingController@index','as' =>'system_management.Setting.index'])->middleware('acl:78');
                                                                                Route::get('/settings/list-view', ['uses' =>'SettingController@listView','as' =>'system_management.Setting.list_view'])->middleware('acl:79');
                                                                                Route::get('/settings/create', ['uses' =>'SettingController@create','as' =>'system_management.Setting.create'])->middleware('acl:80');
                                                                                Route::post('/settings', ['uses' =>'SettingController@create','as' =>'system_management.Setting.store'])->middleware('acl:80');
                                                                                Route::get('/settings/{id}', ['uses' =>'SettingController@show','as' =>'system_management.Setting.show'])->middleware('acl:81');
                                                                                Route::get('/settings/{id}/edit', ['uses' =>'SettingController@edit','as' =>'system_management.Setting.edit'])->middleware('acl:82');
                                                                                Route::put('/settings/{id}', ['uses' =>'SettingController@edit','as' =>'system_management.Setting.update'])->middleware('acl:82');
                                                                                Route::delete('/settings/{id}', ['uses' =>'SettingController@destroy','as' =>'system_management.Setting.destroy'])->middleware('acl:83');
                                                                            });


    });
    Route::group(['namespace'=>'Controllers\Admin','prefix'=>'{lang}'],function(){

        Route::group(['prefix'=>'admin','middleware'=>['auth:admin','set_department:admin' ,'user_info','lang','remove_additional_params']],function(){



                                                            Route::get('/', ['uses' =>'DashboardController@index','as' =>'admin.Dashboard.index'])->middleware('acl:84');


                                                            Route::get('/profile/get_actions', ['uses' =>'ProfileController@getActions','as' =>'admin.Profile.get_actions']);
                                                                                Route::get('/profile', ['uses' =>'ProfileController@index','as' =>'admin.Profile.index']);
                                                                                Route::post('/profile/get_form_info', ['uses' =>'ProfileController@getFormInfo','as' =>'admin.Profile.getFormInfo']);
                                                                                Route::put('/profile/update_basic_info', ['uses' =>'ProfileController@updateBasicInfo','as' =>'admin.Profile.updateBasicInfo']);
                                                                                Route::put('/profile/update_about_user', ['uses' =>'ProfileController@updateAboutUser','as' =>'admin.Profile.updateAboutUser']);
                                                                                Route::put('/profile/update_personal_info', ['uses' =>'ProfileController@updatePersonalInfo','as' =>'admin.Profile.updatePersonalInfo']);
                                                                                Route::put('/profile/update_password', ['uses' =>'ProfileController@updatePassword','as' =>'admin.Profile.updatePassword']);


                                                            Route::get('/users/get_actions', ['uses' =>'UserController@getActions','as' =>'admin.User.get_actions']);
                                                                                Route::get('/users', ['uses' =>'UserController@index','as' =>'admin.User.index'])->middleware('acl:93');
                                                                                Route::get('/users/list-view', ['uses' =>'UserController@listView','as' =>'admin.User.list_view'])->middleware('acl:94');
                                                                                Route::get('/users/create', ['uses' =>'UserController@create','as' =>'admin.User.create'])->middleware('acl:95');
                                                                                Route::post('/users', ['uses' =>'UserController@create','as' =>'admin.User.store'])->middleware('acl:95');
                                                                                Route::get('/users/{id}', ['uses' =>'UserController@show','as' =>'admin.User.show'])->middleware('acl:96');
                                                                                Route::get('/users/{id}/edit', ['uses' =>'UserController@edit','as' =>'admin.User.edit'])->middleware('acl:97');
                                                                                Route::put('/users/{id}', ['uses' =>'UserController@edit','as' =>'admin.User.update'])->middleware('acl:97');
                                                                                Route::delete('/users/{id}', ['uses' =>'UserController@destroy','as' =>'admin.User.destroy'])->middleware('acl:98');


                                                            Route::get('/roles/get_actions', ['uses' =>'RoleController@getActions','as' =>'admin.Role.get_actions']);
                                                                                Route::get('/roles', ['uses' =>'RoleController@index','as' =>'admin.Role.index'])->middleware('acl:100');
                                                                                Route::get('/roles/list-view', ['uses' =>'RoleController@listView','as' =>'admin.Role.list_view'])->middleware('acl:101');
                                                                                Route::get('/roles/create', ['uses' =>'RoleController@create','as' =>'admin.Role.create'])->middleware('acl:102');
                                                                                Route::post('/roles', ['uses' =>'RoleController@create','as' =>'admin.Role.store'])->middleware('acl:102');
                                                                                Route::get('/roles/{id}', ['uses' =>'RoleController@show','as' =>'admin.Role.show'])->middleware('acl:103');
                                                                                Route::get('/roles/{id}/edit', ['uses' =>'RoleController@edit','as' =>'admin.Role.edit'])->middleware('acl:104');
                                                                                Route::put('/roles/{id}', ['uses' =>'RoleController@edit','as' =>'admin.Role.update'])->middleware('acl:104');
                                                                                Route::delete('/roles/{id}', ['uses' =>'RoleController@destroy','as' =>'admin.Role.destroy'])->middleware('acl:105');


                                                            Route::get('/user_classes/get_actions', ['uses' =>'UserClassController@getActions','as' =>'admin.UserClass.get_actions']);
                                                                                Route::get('/user_classes', ['uses' =>'UserClassController@index','as' =>'admin.UserClass.index'])->middleware('acl:107');
                                                                                Route::get('/user_classes/list-view', ['uses' =>'UserClassController@listView','as' =>'admin.UserClass.list_view'])->middleware('acl:108');
                                                                                Route::get('/user_classes/create', ['uses' =>'UserClassController@create','as' =>'admin.UserClass.create'])->middleware('acl:109');
                                                                                Route::post('/user_classes', ['uses' =>'UserClassController@create','as' =>'admin.UserClass.store'])->middleware('acl:109');
                                                                                Route::get('/user_classes/{id}', ['uses' =>'UserClassController@show','as' =>'admin.UserClass.show'])->middleware('acl:110');
                                                                                Route::get('/user_classes/{id}/edit', ['uses' =>'UserClassController@edit','as' =>'admin.UserClass.edit'])->middleware('acl:111');
                                                                                Route::put('/user_classes/{id}', ['uses' =>'UserClassController@edit','as' =>'admin.UserClass.update'])->middleware('acl:111');
                                                                                Route::delete('/user_classes/{id}', ['uses' =>'UserClassController@destroy','as' =>'admin.UserClass.destroy'])->middleware('acl:112');


                                                            Route::get('/categories/get_actions', ['uses' =>'CategoryController@getActions','as' =>'admin.Category.get_actions']);
                                                                                Route::get('/categories', ['uses' =>'CategoryController@index','as' =>'admin.Category.index'])->middleware('acl:114');
                                                                                Route::get('/categories/list-view', ['uses' =>'CategoryController@listView','as' =>'admin.Category.list_view'])->middleware('acl:115');
                                                                                Route::get('/categories/create', ['uses' =>'CategoryController@create','as' =>'admin.Category.create'])->middleware('acl:116');
                                                                                Route::post('/categories', ['uses' =>'CategoryController@create','as' =>'admin.Category.store'])->middleware('acl:116');
                                                                                Route::get('/categories/{id}', ['uses' =>'CategoryController@show','as' =>'admin.Category.show'])->middleware('acl:117');
                                                                                Route::get('/categories/{id}/edit', ['uses' =>'CategoryController@edit','as' =>'admin.Category.edit'])->middleware('acl:118');
                                                                                Route::put('/categories/{id}', ['uses' =>'CategoryController@edit','as' =>'admin.Category.update'])->middleware('acl:118');
                                                                                Route::delete('/categories/{id}', ['uses' =>'CategoryController@destroy','as' =>'admin.Category.destroy'])->middleware('acl:119');


                                                            Route::get('/courses/get_actions', ['uses' =>'CourseController@getActions','as' =>'admin.Course.get_actions']);
                                                                                Route::get('/courses', ['uses' =>'CourseController@index','as' =>'admin.Course.index'])->middleware('acl:121');
                                                                                Route::get('/courses/list-view', ['uses' =>'CourseController@listView','as' =>'admin.Course.list_view'])->middleware('acl:122');
                                                                                Route::get('/courses/create', ['uses' =>'CourseController@create','as' =>'admin.Course.create'])->middleware('acl:123');
                                                                                Route::post('/courses', ['uses' =>'CourseController@create','as' =>'admin.Course.store'])->middleware('acl:123');
                                                                                Route::get('/courses/{id}', ['uses' =>'CourseController@show','as' =>'admin.Course.show'])->middleware('acl:124');
                                                                                Route::get('/courses/{id}/edit', ['uses' =>'CourseController@edit','as' =>'admin.Course.edit'])->middleware('acl:125');
                                                                                Route::put('/courses/{id}', ['uses' =>'CourseController@edit','as' =>'admin.Course.update'])->middleware('acl:125');
                                                                                Route::delete('/courses/{id}', ['uses' =>'CourseController@destroy','as' =>'admin.Course.destroy'])->middleware('acl:126');
                                                                                Route::get('/courses/file_manager/connector', ['uses' =>'CourseController@showFileManagerConnector','as' =>'admin.Course.showFileManagerConnector'])->middleware('acl:127');
                                                                                Route::post('/courses/file_manager/connector', ['uses' =>'CourseController@showFileManagerConnector','as' =>'admin.Course.showFileManagerConnector'])->middleware('acl:127');
                                                                                Route::get('/courses/file_manager/{view}/{input_id?}', ['uses' =>'CourseController@showFileManager','as' =>'admin.Course.showFileManager'])->middleware('acl:128');
                                                                                Route::get('/courses/settings/form', ['uses' =>'CourseController@updateSettings','as' =>'admin.Course.updateSettings'])->middleware('acl:129');
                                                                                Route::put('/courses/settings/update', ['uses' =>'CourseController@updateSettings','as' =>'admin.Course.updateSettings'])->middleware('acl:129');

                                                            Route::get('/class_rooms/get_actions', ['uses' =>'ClassRoomController@getActions','as' =>'admin.ClassRoom.get_actions']);
                                                                                Route::get('/class_rooms', ['uses' =>'ClassRoomController@index','as' =>'admin.ClassRoom.index'])->middleware('acl:131');
                                                                                Route::get('/class_rooms/list-view', ['uses' =>'ClassRoomController@listView','as' =>'admin.ClassRoom.list_view'])->middleware('acl:132');
                                                                                Route::get('/class_rooms/create', ['uses' =>'ClassRoomController@create','as' =>'admin.ClassRoom.create'])->middleware('acl:133');
                                                                                Route::post('/class_rooms', ['uses' =>'ClassRoomController@create','as' =>'admin.ClassRoom.store'])->middleware('acl:133');
                                                                                Route::get('/class_rooms/{id}', ['uses' =>'ClassRoomController@show','as' =>'admin.ClassRoom.show'])->middleware('acl:134');
                                                                                Route::get('/class_rooms/{id}/edit', ['uses' =>'ClassRoomController@edit','as' =>'admin.ClassRoom.edit'])->middleware('acl:135');
                                                                                Route::put('/class_rooms/{id}', ['uses' =>'ClassRoomController@edit','as' =>'admin.ClassRoom.update'])->middleware('acl:135');
                                                                                Route::delete('/class_rooms/{id}', ['uses' =>'ClassRoomController@destroy','as' =>'admin.ClassRoom.destroy'])->middleware('acl:136');
                                                                                Route::get('/class_rooms/file_manager/connector', ['uses' =>'ClassRoomController@showFileManagerConnector','as' =>'admin.ClassRoom.showFileManagerConnector'])->middleware('acl:137');
                                                                                Route::post('/class_rooms/file_manager/connector', ['uses' =>'ClassRoomController@showFileManagerConnector','as' =>'admin.ClassRoom.showFileManagerConnector'])->middleware('acl:137');
                                                                                Route::get('/class_rooms/file_manager/{view}/{input_id?}', ['uses' =>'ClassRoomController@showFileManager','as' =>'admin.ClassRoom.showFileManager'])->middleware('acl:138');
                                                                                Route::get('/class_rooms/settings/form', ['uses' =>'ClassRoomController@updateSettings','as' =>'admin.ClassRoom.updateSettings'])->middleware('acl:139');
                                                                                Route::put('/class_rooms/settings/update', ['uses' =>'ClassRoomController@updateSettings','as' =>'admin.ClassRoom.updateSettings'])->middleware('acl:139');


                                                            Route::get('/contents/comments', ['uses' =>'ContentController@indexComment','as' =>'admin.Content.indexComment'])->middleware('acl:140');
                                                                                Route::get('/contents/comments/list-view', ['uses' =>'ContentController@CommentsListView','as' =>'admin.Content.CommentsListView'])->middleware('acl:141');
                                                                                Route::get('/contents/comments/{id}/edit', ['uses' =>'ContentController@editComment','as' =>'admin.Content.editComment'])->middleware('acl:142');
                                                                                Route::put('/contents/comments/{id}', ['uses' =>'ContentController@editComment','as' =>'admin.Content.editComment'])->middleware('acl:142');
                                                                                Route::get('/contents/comments/{id}', ['uses' =>'ContentController@showComment','as' =>'admin.Content.showComment'])->middleware('acl:143');
                                                                                Route::delete('/contents/comments/{id}', ['uses' =>'ContentController@destroyComment','as' =>'admin.Content.destroyComment'])->middleware('acl:144');
                                                                                Route::get('/contents/get_actions', ['uses' =>'ContentController@getActions','as' =>'admin.Content.get_actions']);
                                                                                Route::get('/contents', ['uses' =>'ContentController@index','as' =>'admin.Content.index'])->middleware('acl:146');
                                                                                Route::get('/contents/list-view', ['uses' =>'ContentController@listView','as' =>'admin.Content.list_view'])->middleware('acl:147');
                                                                                Route::get('/contents/create', ['uses' =>'ContentController@create','as' =>'admin.Content.create'])->middleware('acl:148');
                                                                                Route::post('/contents', ['uses' =>'ContentController@create','as' =>'admin.Content.store'])->middleware('acl:148');
                                                                                Route::get('/contents/{id}', ['uses' =>'ContentController@show','as' =>'admin.Content.show'])->middleware('acl:149');
                                                                                Route::get('/contents/{id}/edit', ['uses' =>'ContentController@edit','as' =>'admin.Content.edit'])->middleware('acl:150');
                                                                                Route::put('/contents/{id}', ['uses' =>'ContentController@edit','as' =>'admin.Content.update'])->middleware('acl:150');
                                                                                Route::delete('/contents/{id}', ['uses' =>'ContentController@destroy','as' =>'admin.Content.destroy'])->middleware('acl:151');
                                                                                Route::get('/contents/file_manager/connector', ['uses' =>'ContentController@showFileManagerConnector','as' =>'admin.Content.showFileManagerConnector'])->middleware('acl:152');
                                                                                Route::post('/contents/file_manager/connector', ['uses' =>'ContentController@showFileManagerConnector','as' =>'admin.Content.showFileManagerConnector'])->middleware('acl:152');
                                                                                Route::get('/contents/file_manager/{view}/{input_id?}', ['uses' =>'ContentController@showFileManager','as' =>'admin.Content.showFileManager'])->middleware('acl:153');
                                                                                Route::get('/contents/settings/form', ['uses' =>'ContentController@updateSettings','as' =>'admin.Content.updateSettings'])->middleware('acl:154');
                                                                                Route::put('/contents/settings/update', ['uses' =>'ContentController@updateSettings','as' =>'admin.Content.updateSettings'])->middleware('acl:154');


                                                            Route::get('/pages/comments', ['uses' =>'PageController@indexComment','as' =>'admin.Page.indexComment'])->middleware('acl:155');
                                                                                Route::get('/pages/comments/list-view', ['uses' =>'PageController@CommentsListView','as' =>'admin.Page.CommentsListView'])->middleware('acl:156');
                                                                                Route::get('/pages/comments/{id}/edit', ['uses' =>'PageController@editComment','as' =>'admin.Page.editComment'])->middleware('acl:157');
                                                                                Route::put('/pages/comments/{id}', ['uses' =>'PageController@editComment','as' =>'admin.Page.editComment'])->middleware('acl:157');
                                                                                Route::get('/pages/comments/{id}', ['uses' =>'PageController@showComment','as' =>'admin.Page.showComment'])->middleware('acl:158');
                                                                                Route::delete('/pages/comments/{id}', ['uses' =>'PageController@destroyComment','as' =>'admin.Page.destroyComment'])->middleware('acl:159');
                                                                                Route::get('/pages/get_actions', ['uses' =>'PageController@getActions','as' =>'admin.Page.get_actions']);
                                                                                Route::get('/pages', ['uses' =>'PageController@index','as' =>'admin.Page.index'])->middleware('acl:161');
                                                                                Route::get('/pages/list-view', ['uses' =>'PageController@listView','as' =>'admin.Page.list_view'])->middleware('acl:162');
                                                                                Route::get('/pages/create', ['uses' =>'PageController@create','as' =>'admin.Page.create'])->middleware('acl:163');
                                                                                Route::post('/pages', ['uses' =>'PageController@create','as' =>'admin.Page.store'])->middleware('acl:163');
                                                                                Route::get('/pages/{id}', ['uses' =>'PageController@show','as' =>'admin.Page.show'])->middleware('acl:164');
                                                                                Route::get('/pages/{id}/edit', ['uses' =>'PageController@edit','as' =>'admin.Page.edit'])->middleware('acl:165');
                                                                                Route::put('/pages/{id}', ['uses' =>'PageController@edit','as' =>'admin.Page.update'])->middleware('acl:165');
                                                                                Route::delete('/pages/{id}', ['uses' =>'PageController@destroy','as' =>'admin.Page.destroy'])->middleware('acl:166');
                                                                                Route::get('/pages/file_manager/connector', ['uses' =>'PageController@showFileManagerConnector','as' =>'admin.Page.showFileManagerConnector'])->middleware('acl:167');
                                                                                Route::post('/pages/file_manager/connector', ['uses' =>'PageController@showFileManagerConnector','as' =>'admin.Page.showFileManagerConnector'])->middleware('acl:167');
                                                                                Route::get('/pages/file_manager/{view}/{input_id?}', ['uses' =>'PageController@showFileManager','as' =>'admin.Page.showFileManager'])->middleware('acl:168');
                                                                                Route::get('/pages/settings/form', ['uses' =>'PageController@updateSettings','as' =>'admin.Page.updateSettings'])->middleware('acl:169');
                                                                                Route::put('/pages/settings/update', ['uses' =>'PageController@updateSettings','as' =>'admin.Page.updateSettings'])->middleware('acl:169');


                                                            Route::get('/slider_groups/get_actions', ['uses' =>'SliderGroupController@getActions','as' =>'admin.SliderGroup.get_actions']);
                                                                                Route::get('/slider_groups', ['uses' =>'SliderGroupController@index','as' =>'admin.SliderGroup.index'])->middleware('acl:171');
                                                                                Route::get('/slider_groups/list-view', ['uses' =>'SliderGroupController@listView','as' =>'admin.SliderGroup.list_view'])->middleware('acl:172');
                                                                                Route::get('/slider_groups/create', ['uses' =>'SliderGroupController@create','as' =>'admin.SliderGroup.create'])->middleware('acl:173');
                                                                                Route::post('/slider_groups', ['uses' =>'SliderGroupController@create','as' =>'admin.SliderGroup.store'])->middleware('acl:173');
                                                                                Route::get('/slider_groups/{id}', ['uses' =>'SliderGroupController@show','as' =>'admin.SliderGroup.show'])->middleware('acl:174');
                                                                                Route::get('/slider_groups/{id}/edit', ['uses' =>'SliderGroupController@edit','as' =>'admin.SliderGroup.edit'])->middleware('acl:175');
                                                                                Route::put('/slider_groups/{id}', ['uses' =>'SliderGroupController@edit','as' =>'admin.SliderGroup.update'])->middleware('acl:175');
                                                                                Route::delete('/slider_groups/{id}', ['uses' =>'SliderGroupController@destroy','as' =>'admin.SliderGroup.destroy'])->middleware('acl:176');

                                                            Route::get('/sliders/get_actions', ['uses' =>'SliderController@getActions','as' =>'admin.Slider.get_actions']);
                                                                                Route::get('/sliders', ['uses' =>'SliderController@index','as' =>'admin.Slider.index'])->middleware('acl:178');
                                                                                Route::get('/sliders/list-view', ['uses' =>'SliderController@listView','as' =>'admin.Slider.list_view'])->middleware('acl:179');
                                                                                Route::get('/sliders/create', ['uses' =>'SliderController@create','as' =>'admin.Slider.create'])->middleware('acl:180');
                                                                                Route::post('/sliders', ['uses' =>'SliderController@create','as' =>'admin.Slider.store'])->middleware('acl:180');
                                                                                Route::get('/sliders/{id}', ['uses' =>'SliderController@show','as' =>'admin.Slider.show'])->middleware('acl:181');
                                                                                Route::get('/sliders/{id}/edit', ['uses' =>'SliderController@edit','as' =>'admin.Slider.edit'])->middleware('acl:182');
                                                                                Route::put('/sliders/{id}', ['uses' =>'SliderController@edit','as' =>'admin.Slider.update'])->middleware('acl:182');
                                                                                Route::delete('/sliders/{id}', ['uses' =>'SliderController@destroy','as' =>'admin.Slider.destroy'])->middleware('acl:183');
                                                                                Route::get('/sliders/file_manager/connector', ['uses' =>'SliderController@showFileManagerConnector','as' =>'admin.Slider.showFileManagerConnector'])->middleware('acl:184');
                                                                                Route::post('/sliders/file_manager/connector', ['uses' =>'SliderController@showFileManagerConnector','as' =>'admin.Slider.showFileManagerConnector'])->middleware('acl:184');
                                                                                Route::get('/sliders/file_manager/{view}/{input_id?}', ['uses' =>'SliderController@showFileManager','as' =>'admin.Slider.showFileManager'])->middleware('acl:185');
                                                                                Route::get('/sliders/settings/form', ['uses' =>'SliderController@updateSettings','as' =>'admin.Slider.updateSettings'])->middleware('acl:186');
                                                                                Route::put('/sliders/settings/update', ['uses' =>'SliderController@updateSettings','as' =>'admin.Slider.updateSettings'])->middleware('acl:186');


                                                            Route::get('/tags/get_actions', ['uses' =>'TagController@getActions','as' =>'admin.Tag.get_actions']);
                                                                                Route::get('/tags', ['uses' =>'TagController@index','as' =>'admin.Tag.index'])->middleware('acl:188');
                                                                                Route::get('/tags/list-view', ['uses' =>'TagController@listView','as' =>'admin.Tag.list_view'])->middleware('acl:189');
                                                                                Route::get('/tags/create', ['uses' =>'TagController@create','as' =>'admin.Tag.create'])->middleware('acl:190');
                                                                                Route::post('/tags', ['uses' =>'TagController@create','as' =>'admin.Tag.store'])->middleware('acl:190');
                                                                                Route::get('/tags/{id}', ['uses' =>'TagController@show','as' =>'admin.Tag.show'])->middleware('acl:191');
                                                                                Route::get('/tags/{id}/edit', ['uses' =>'TagController@edit','as' =>'admin.Tag.edit'])->middleware('acl:192');
                                                                                Route::put('/tags/{id}', ['uses' =>'TagController@edit','as' =>'admin.Tag.update'])->middleware('acl:192');
                                                                                Route::delete('/tags/{id}', ['uses' =>'TagController@destroy','as' =>'admin.Tag.destroy'])->middleware('acl:193');


                                                            Route::get('/static_menus/get_actions', ['uses' =>'StaticMenuController@getActions','as' =>'admin.StaticMenu.get_actions']);
                                                                                Route::get('/static_menus', ['uses' =>'StaticMenuController@index','as' =>'admin.StaticMenu.index'])->middleware('acl:195');
                                                                                Route::get('/static_menus/list-view', ['uses' =>'StaticMenuController@listView','as' =>'admin.StaticMenu.list_view'])->middleware('acl:196');
                                                                                Route::get('/static_menus/create', ['uses' =>'StaticMenuController@create','as' =>'admin.StaticMenu.create'])->middleware('acl:197');
                                                                                Route::post('/static_menus', ['uses' =>'StaticMenuController@create','as' =>'admin.StaticMenu.store'])->middleware('acl:197');
                                                                                Route::get('/static_menus/{id}', ['uses' =>'StaticMenuController@show','as' =>'admin.StaticMenu.show'])->middleware('acl:198');
                                                                                Route::get('/static_menus/{id}/edit', ['uses' =>'StaticMenuController@edit','as' =>'admin.StaticMenu.edit'])->middleware('acl:199');
                                                                                Route::put('/static_menus/{id}', ['uses' =>'StaticMenuController@edit','as' =>'admin.StaticMenu.update'])->middleware('acl:199');
                                                                                Route::delete('/static_menus/{id}', ['uses' =>'StaticMenuController@destroy','as' =>'admin.StaticMenu.destroy'])->middleware('acl:200');


                                                            Route::get('/translate_requests/get_actions', ['uses' =>'TranslateRequestController@getActions','as' =>'admin.TranslateRequest.get_actions']);
                                                                                Route::get('/translate_requests', ['uses' =>'TranslateRequestController@index','as' =>'admin.TranslateRequest.index'])->middleware('acl:202');
                                                                                Route::get('/translate_requests/list-view', ['uses' =>'TranslateRequestController@listView','as' =>'admin.TranslateRequest.list_view'])->middleware('acl:203');
                                                                                Route::get('/translate_requests/create', ['uses' =>'TranslateRequestController@create','as' =>'admin.TranslateRequest.create'])->middleware('acl:204');
                                                                                Route::post('/translate_requests', ['uses' =>'TranslateRequestController@create','as' =>'admin.TranslateRequest.store'])->middleware('acl:204');
                                                                                Route::get('/translate_requests/{id}', ['uses' =>'TranslateRequestController@show','as' =>'admin.TranslateRequest.show'])->middleware('acl:205');
                                                                                Route::get('/translate_requests/{id}/edit', ['uses' =>'TranslateRequestController@edit','as' =>'admin.TranslateRequest.edit'])->middleware('acl:206');
                                                                                Route::put('/translate_requests/{id}', ['uses' =>'TranslateRequestController@edit','as' =>'admin.TranslateRequest.update'])->middleware('acl:206');
                                                                                Route::delete('/translate_requests/{id}', ['uses' =>'TranslateRequestController@destroy','as' =>'admin.TranslateRequest.destroy'])->middleware('acl:207');


                                                            Route::get('/attachments/get_actions', ['uses' =>'AttachmentController@getActions','as' =>'admin.Attachment.get_actions']);
                                                                                Route::get('/attachments', ['uses' =>'AttachmentController@index','as' =>'admin.Attachment.index'])->middleware('acl:209');
                                                                                Route::get('/attachments/list-view', ['uses' =>'AttachmentController@listView','as' =>'admin.Attachment.list_view'])->middleware('acl:210');
                                                                                Route::get('/attachments/create', ['uses' =>'AttachmentController@create','as' =>'admin.Attachment.create'])->middleware('acl:211');
                                                                                Route::post('/attachments', ['uses' =>'AttachmentController@create','as' =>'admin.Attachment.store'])->middleware('acl:211');
                                                                                Route::get('/attachments/{id}', ['uses' =>'AttachmentController@show','as' =>'admin.Attachment.show'])->middleware('acl:212');
                                                                                Route::get('/attachments/{id}/edit', ['uses' =>'AttachmentController@edit','as' =>'admin.Attachment.edit'])->middleware('acl:213');
                                                                                Route::put('/attachments/{id}', ['uses' =>'AttachmentController@edit','as' =>'admin.Attachment.update'])->middleware('acl:213');
                                                                                Route::delete('/attachments/{id}', ['uses' =>'AttachmentController@destroy','as' =>'admin.Attachment.destroy'])->middleware('acl:214');
                                                                                Route::get('/attachments/file_manager/connector', ['uses' =>'AttachmentController@showFileManagerConnector','as' =>'admin.Attachment.showFileManagerConnector'])->middleware('acl:215');
                                                                                Route::post('/attachments/file_manager/connector', ['uses' =>'AttachmentController@showFileManagerConnector','as' =>'admin.Attachment.showFileManagerConnector'])->middleware('acl:215');
                                                                                Route::get('/attachments/file_manager/{view}/{input_id?}', ['uses' =>'AttachmentController@showFileManager','as' =>'admin.Attachment.showFileManager'])->middleware('acl:216');
                                                                                Route::get('/attachments/settings/form', ['uses' =>'AttachmentController@updateSettings','as' =>'admin.Attachment.updateSettings'])->middleware('acl:217');
                                                                                Route::put('/attachments/settings/update', ['uses' =>'AttachmentController@updateSettings','as' =>'admin.Attachment.updateSettings'])->middleware('acl:217');
                                                                                Route::post('/attachments/change_attachmentable_type', ['uses' =>'AttachmentController@changeAttachmentableType','as' =>'admin.Attachment.changeAttachmentableType']);


                                                            Route::get('/settings', ['uses' =>'SettingController@index','as' =>'admin.site_management.Setting.index'])->middleware('acl:219');
                                                                                Route::get('/settings/update_all_settings', ['uses' =>'SettingController@updateAllSettings','as' =>'admin.Setting.updateAllSettings'])->middleware('acl:220');
                                                                                Route::put('/settings/update_all_settings', ['uses' =>'SettingController@updateAllSettings','as' =>'admin.Setting.updateAllSettings'])->middleware('acl:220');
                                                                            });

    
    });


Route::group(['namespace'=>'Controllers\Auth'],function(){
Route::group(['prefix'=>'{lang}/{department}','middleware'=>['set_department','lang']],function(){
Route::get('login', 'AdminLoginController@showLoginForm')->name('admin.login_form');
Route::post('login', 'AdminLoginController@login')->name('admin.login');
Route::post('logout', 'AdminLoginController@logout')->name('admin.logout');
});
});
Route::get('{lang}/access_denied', function ($lang){
return view('appnegar::access_denied');
})->name('access_denied')->middleware('lang');