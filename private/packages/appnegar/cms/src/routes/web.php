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
                                                                                
                        
                                                            Route::get('/setting_groups/get_actions', ['uses' =>'SettingGroupController@getActions','as' =>'system_management.SettingGroup.get_actions']);
                                                                                Route::get('/setting_groups', ['uses' =>'SettingGroupController@index','as' =>'system_management.SettingGroup.index'])->middleware('acl:56');
                                                                                Route::get('/setting_groups/list-view', ['uses' =>'SettingGroupController@listView','as' =>'system_management.SettingGroup.list_view'])->middleware('acl:57');
                                                                                Route::get('/setting_groups/create', ['uses' =>'SettingGroupController@create','as' =>'system_management.SettingGroup.create'])->middleware('acl:58');
                                                                                Route::post('/setting_groups', ['uses' =>'SettingGroupController@create','as' =>'system_management.SettingGroup.store'])->middleware('acl:58');
                                                                                Route::get('/setting_groups/{id}', ['uses' =>'SettingGroupController@show','as' =>'system_management.SettingGroup.show'])->middleware('acl:59');
                                                                                Route::get('/setting_groups/{id}/edit', ['uses' =>'SettingGroupController@edit','as' =>'system_management.SettingGroup.edit'])->middleware('acl:60');
                                                                                Route::put('/setting_groups/{id}', ['uses' =>'SettingGroupController@edit','as' =>'system_management.SettingGroup.update'])->middleware('acl:60');
                                                                                Route::delete('/setting_groups/{id}', ['uses' =>'SettingGroupController@destroy','as' =>'system_management.SettingGroup.destroy'])->middleware('acl:61');
                                                
                                                            Route::get('/settings/get_actions', ['uses' =>'SettingController@getActions','as' =>'system_management.Setting.get_actions']);
                                                                                Route::get('/settings', ['uses' =>'SettingController@index','as' =>'system_management.Setting.index'])->middleware('acl:63');
                                                                                Route::get('/settings/list-view', ['uses' =>'SettingController@listView','as' =>'system_management.Setting.list_view'])->middleware('acl:64');
                                                                                Route::get('/settings/create', ['uses' =>'SettingController@create','as' =>'system_management.Setting.create'])->middleware('acl:65');
                                                                                Route::post('/settings', ['uses' =>'SettingController@create','as' =>'system_management.Setting.store'])->middleware('acl:65');
                                                                                Route::get('/settings/{id}', ['uses' =>'SettingController@show','as' =>'system_management.Setting.show'])->middleware('acl:66');
                                                                                Route::get('/settings/{id}/edit', ['uses' =>'SettingController@edit','as' =>'system_management.Setting.edit'])->middleware('acl:67');
                                                                                Route::put('/settings/{id}', ['uses' =>'SettingController@edit','as' =>'system_management.Setting.update'])->middleware('acl:67');
                                                                                Route::delete('/settings/{id}', ['uses' =>'SettingController@destroy','as' =>'system_management.Setting.destroy'])->middleware('acl:68');
                                                                            });

            
        Route::group(['prefix'=>'site_management','middleware'=>['auth:site_management','set_department:site_management' ,'user_info','lang','remove_additional_params']],function(){

                    
                        
                                                            Route::get('/', ['uses' =>'DashboardController@index','as' =>'site_management.Dashboard.index'])->middleware('acl:69');
                                                                                
                        
                                                            Route::get('/profile/get_actions', ['uses' =>'ProfileController@getActions','as' =>'site_management.Profile.get_actions']);
                                                                                Route::get('/profile', ['uses' =>'ProfileController@index','as' =>'site_management.Profile.index']);
                                                                                Route::post('/profile/get_form_info', ['uses' =>'ProfileController@getFormInfo','as' =>'site_management.Profile.getFormInfo']);
                                                                                Route::put('/profile/update_basic_info', ['uses' =>'ProfileController@updateBasicInfo','as' =>'site_management.Profile.updateBasicInfo']);
                                                                                Route::put('/profile/update_about_user', ['uses' =>'ProfileController@updateAboutUser','as' =>'site_management.Profile.updateAboutUser']);
                                                                                Route::put('/profile/update_personal_info', ['uses' =>'ProfileController@updatePersonalInfo','as' =>'site_management.Profile.updatePersonalInfo']);
                                                                                Route::put('/profile/update_password', ['uses' =>'ProfileController@updatePassword','as' =>'site_management.Profile.updatePassword']);
                                                                                
                        
                                                            Route::get('/users/get_actions', ['uses' =>'UserController@getActions','as' =>'site_management.User.get_actions']);
                                                                                Route::get('/users', ['uses' =>'UserController@index','as' =>'site_management.User.index'])->middleware('acl:78');
                                                                                Route::get('/users/list-view', ['uses' =>'UserController@listView','as' =>'site_management.User.list_view'])->middleware('acl:79');
                                                                                Route::get('/users/create', ['uses' =>'UserController@create','as' =>'site_management.User.create'])->middleware('acl:80');
                                                                                Route::post('/users', ['uses' =>'UserController@create','as' =>'site_management.User.store'])->middleware('acl:80');
                                                                                Route::get('/users/{id}', ['uses' =>'UserController@show','as' =>'site_management.User.show'])->middleware('acl:81');
                                                                                Route::get('/users/{id}/edit', ['uses' =>'UserController@edit','as' =>'site_management.User.edit'])->middleware('acl:82');
                                                                                Route::put('/users/{id}', ['uses' =>'UserController@edit','as' =>'site_management.User.update'])->middleware('acl:82');
                                                                                Route::delete('/users/{id}', ['uses' =>'UserController@destroy','as' =>'site_management.User.destroy'])->middleware('acl:83');
                                                                                
                        
                                                            Route::get('/roles/get_actions', ['uses' =>'RoleController@getActions','as' =>'site_management.Role.get_actions']);
                                                                                Route::get('/roles', ['uses' =>'RoleController@index','as' =>'site_management.Role.index'])->middleware('acl:85');
                                                                                Route::get('/roles/list-view', ['uses' =>'RoleController@listView','as' =>'site_management.Role.list_view'])->middleware('acl:86');
                                                                                Route::get('/roles/create', ['uses' =>'RoleController@create','as' =>'site_management.Role.create'])->middleware('acl:87');
                                                                                Route::post('/roles', ['uses' =>'RoleController@create','as' =>'site_management.Role.store'])->middleware('acl:87');
                                                                                Route::get('/roles/{id}', ['uses' =>'RoleController@show','as' =>'site_management.Role.show'])->middleware('acl:88');
                                                                                Route::get('/roles/{id}/edit', ['uses' =>'RoleController@edit','as' =>'site_management.Role.edit'])->middleware('acl:89');
                                                                                Route::put('/roles/{id}', ['uses' =>'RoleController@edit','as' =>'site_management.Role.update'])->middleware('acl:89');
                                                                                Route::delete('/roles/{id}', ['uses' =>'RoleController@destroy','as' =>'site_management.Role.destroy'])->middleware('acl:90');
                                                                                
                        
                                                            Route::get('/menus/get_actions', ['uses' =>'MenuController@getActions','as' =>'site_management.Menu.get_actions']);
                                                                                Route::get('/menus', ['uses' =>'MenuController@index','as' =>'site_management.Menu.index'])->middleware('acl:92');
                                                                                Route::get('/menus/list-view', ['uses' =>'MenuController@listView','as' =>'site_management.Menu.list_view'])->middleware('acl:93');
                                                                                Route::get('/menus/create', ['uses' =>'MenuController@create','as' =>'site_management.Menu.create'])->middleware('acl:94');
                                                                                Route::post('/menus', ['uses' =>'MenuController@create','as' =>'site_management.Menu.store'])->middleware('acl:94');
                                                                                Route::get('/menus/{id}', ['uses' =>'MenuController@show','as' =>'site_management.Menu.show'])->middleware('acl:95');
                                                                                Route::get('/menus/{id}/edit', ['uses' =>'MenuController@edit','as' =>'site_management.Menu.edit'])->middleware('acl:96');
                                                                                Route::put('/menus/{id}', ['uses' =>'MenuController@edit','as' =>'site_management.Menu.update'])->middleware('acl:96');
                                                                                Route::delete('/menus/{id}', ['uses' =>'MenuController@destroy','as' =>'site_management.Menu.destroy'])->middleware('acl:97');
                                                
                                                            Route::get('/menu_items/get_actions', ['uses' =>'MenuItemController@getActions','as' =>'site_management.MenuItem.get_actions']);
                                                                                Route::get('/menu_items', ['uses' =>'MenuItemController@index','as' =>'site_management.MenuItem.index'])->middleware('acl:99');
                                                                                Route::get('/menu_items/list-view', ['uses' =>'MenuItemController@listView','as' =>'site_management.MenuItem.list_view'])->middleware('acl:100');
                                                                                Route::get('/menu_items/create', ['uses' =>'MenuItemController@create','as' =>'site_management.MenuItem.create'])->middleware('acl:101');
                                                                                Route::post('/menu_items', ['uses' =>'MenuItemController@create','as' =>'site_management.MenuItem.store'])->middleware('acl:101');
                                                                                Route::get('/menu_items/{id}', ['uses' =>'MenuItemController@show','as' =>'site_management.MenuItem.show'])->middleware('acl:102');
                                                                                Route::get('/menu_items/{id}/edit', ['uses' =>'MenuItemController@edit','as' =>'site_management.MenuItem.edit'])->middleware('acl:103');
                                                                                Route::put('/menu_items/{id}', ['uses' =>'MenuItemController@edit','as' =>'site_management.MenuItem.update'])->middleware('acl:103');
                                                                                Route::delete('/menu_items/{id}', ['uses' =>'MenuItemController@destroy','as' =>'site_management.MenuItem.destroy'])->middleware('acl:104');
                                                                                Route::post('/menu_items/change_menu', ['uses' =>'MenuItemController@changeMenu','as' =>'site_management.MenuItem.changeMenu']);
                                                                                
                        
                                                            Route::get('/settings', ['uses' =>'SettingController@index','as' =>'site_management.site_management.Setting.index'])->middleware('acl:106');
                                                                                Route::get('/settings/update_all_settings', ['uses' =>'SettingController@updateAllSettings','as' =>'site_management.Setting.updateAllSettings'])->middleware('acl:107');
                                                                                Route::put('/settings/update_all_settings', ['uses' =>'SettingController@updateAllSettings','as' =>'site_management.Setting.updateAllSettings'])->middleware('acl:107');
                                                                            });

    
    });
    Route::group(['namespace'=>'Controllers\ContentManagement','prefix'=>'{lang}'],function(){
            
        Route::group(['prefix'=>'content_management','middleware'=>['auth:content_management','set_department:content_management' ,'user_info','lang','remove_additional_params']],function(){

                    
                        
                                                            Route::get('/', ['uses' =>'DashboardController@index','as' =>'content_management.Dashboard.index'])->middleware('acl:108');
                                                                                
                        
                                                            Route::get('/user_classes/get_actions', ['uses' =>'UserClassController@getActions','as' =>'content_management.UserClass.get_actions']);
                                                                                Route::get('/user_classes', ['uses' =>'UserClassController@index','as' =>'content_management.UserClass.index'])->middleware('acl:110');
                                                                                Route::get('/user_classes/list-view', ['uses' =>'UserClassController@listView','as' =>'content_management.UserClass.list_view'])->middleware('acl:111');
                                                                                Route::get('/user_classes/create', ['uses' =>'UserClassController@create','as' =>'content_management.UserClass.create'])->middleware('acl:112');
                                                                                Route::post('/user_classes', ['uses' =>'UserClassController@create','as' =>'content_management.UserClass.store'])->middleware('acl:112');
                                                                                Route::get('/user_classes/{id}', ['uses' =>'UserClassController@show','as' =>'content_management.UserClass.show'])->middleware('acl:113');
                                                                                Route::get('/user_classes/{id}/edit', ['uses' =>'UserClassController@edit','as' =>'content_management.UserClass.edit'])->middleware('acl:114');
                                                                                Route::put('/user_classes/{id}', ['uses' =>'UserClassController@edit','as' =>'content_management.UserClass.update'])->middleware('acl:114');
                                                                                Route::delete('/user_classes/{id}', ['uses' =>'UserClassController@destroy','as' =>'content_management.UserClass.destroy'])->middleware('acl:115');
                                                                                
                        
                                                            Route::get('/profile/get_actions', ['uses' =>'ProfileController@getActions','as' =>'content_management.Profile.get_actions']);
                                                                                Route::get('/profile', ['uses' =>'ProfileController@index','as' =>'content_management.Profile.index']);
                                                                                Route::post('/profile/get_form_info', ['uses' =>'ProfileController@getFormInfo','as' =>'content_management.Profile.getFormInfo']);
                                                                                Route::put('/profile/update_basic_info', ['uses' =>'ProfileController@updateBasicInfo','as' =>'content_management.Profile.updateBasicInfo']);
                                                                                Route::put('/profile/update_about_user', ['uses' =>'ProfileController@updateAboutUser','as' =>'content_management.Profile.updateAboutUser']);
                                                                                Route::put('/profile/update_personal_info', ['uses' =>'ProfileController@updatePersonalInfo','as' =>'content_management.Profile.updatePersonalInfo']);
                                                                                Route::put('/profile/update_password', ['uses' =>'ProfileController@updatePassword','as' =>'content_management.Profile.updatePassword']);
                                                                                
                        
                                                            Route::get('/categories/get_actions', ['uses' =>'CategoryController@getActions','as' =>'content_management.Category.get_actions']);
                                                                                Route::get('/categories', ['uses' =>'CategoryController@index','as' =>'content_management.Category.index'])->middleware('acl:124');
                                                                                Route::get('/categories/list-view', ['uses' =>'CategoryController@listView','as' =>'content_management.Category.list_view'])->middleware('acl:125');
                                                                                Route::get('/categories/create', ['uses' =>'CategoryController@create','as' =>'content_management.Category.create'])->middleware('acl:126');
                                                                                Route::post('/categories', ['uses' =>'CategoryController@create','as' =>'content_management.Category.store'])->middleware('acl:126');
                                                                                Route::get('/categories/{id}', ['uses' =>'CategoryController@show','as' =>'content_management.Category.show'])->middleware('acl:127');
                                                                                Route::get('/categories/{id}/edit', ['uses' =>'CategoryController@edit','as' =>'content_management.Category.edit'])->middleware('acl:128');
                                                                                Route::put('/categories/{id}', ['uses' =>'CategoryController@edit','as' =>'content_management.Category.update'])->middleware('acl:128');
                                                                                Route::delete('/categories/{id}', ['uses' =>'CategoryController@destroy','as' =>'content_management.Category.destroy'])->middleware('acl:129');
                                                                                
                        
                                                            Route::get('/courses/get_actions', ['uses' =>'CourseController@getActions','as' =>'content_management.Course.get_actions']);
                                                                                Route::get('/courses', ['uses' =>'CourseController@index','as' =>'content_management.Course.index'])->middleware('acl:131');
                                                                                Route::get('/courses/list-view', ['uses' =>'CourseController@listView','as' =>'content_management.Course.list_view'])->middleware('acl:132');
                                                                                Route::get('/courses/create', ['uses' =>'CourseController@create','as' =>'content_management.Course.create'])->middleware('acl:133');
                                                                                Route::post('/courses', ['uses' =>'CourseController@create','as' =>'content_management.Course.store'])->middleware('acl:133');
                                                                                Route::get('/courses/{id}', ['uses' =>'CourseController@show','as' =>'content_management.Course.show'])->middleware('acl:134');
                                                                                Route::get('/courses/{id}/edit', ['uses' =>'CourseController@edit','as' =>'content_management.Course.edit'])->middleware('acl:135');
                                                                                Route::put('/courses/{id}', ['uses' =>'CourseController@edit','as' =>'content_management.Course.update'])->middleware('acl:135');
                                                                                Route::delete('/courses/{id}', ['uses' =>'CourseController@destroy','as' =>'content_management.Course.destroy'])->middleware('acl:136');
                                                                                Route::get('/courses/file_manager/connector', ['uses' =>'CourseController@showFileManagerConnector','as' =>'content_management.Course.showFileManagerConnector'])->middleware('acl:137');
                                                                                Route::post('/courses/file_manager/connector', ['uses' =>'CourseController@showFileManagerConnector','as' =>'content_management.Course.showFileManagerConnector'])->middleware('acl:137');
                                                                                Route::get('/courses/file_manager/{view}/{input_id?}', ['uses' =>'CourseController@showFileManager','as' =>'content_management.Course.showFileManager'])->middleware('acl:138');
                                                                                Route::get('/courses/settings/form', ['uses' =>'CourseController@updateSettings','as' =>'content_management.Course.updateSettings'])->middleware('acl:139');
                                                                                Route::put('/courses/settings/update', ['uses' =>'CourseController@updateSettings','as' =>'content_management.Course.updateSettings'])->middleware('acl:139');
                                                
                                                            Route::get('/class_rooms/get_actions', ['uses' =>'ClassRoomController@getActions','as' =>'content_management.ClassRoom.get_actions']);
                                                                                Route::get('/class_rooms', ['uses' =>'ClassRoomController@index','as' =>'content_management.ClassRoom.index'])->middleware('acl:141');
                                                                                Route::get('/class_rooms/list-view', ['uses' =>'ClassRoomController@listView','as' =>'content_management.ClassRoom.list_view'])->middleware('acl:142');
                                                                                Route::get('/class_rooms/create', ['uses' =>'ClassRoomController@create','as' =>'content_management.ClassRoom.create'])->middleware('acl:143');
                                                                                Route::post('/class_rooms', ['uses' =>'ClassRoomController@create','as' =>'content_management.ClassRoom.store'])->middleware('acl:143');
                                                                                Route::get('/class_rooms/{id}', ['uses' =>'ClassRoomController@show','as' =>'content_management.ClassRoom.show'])->middleware('acl:144');
                                                                                Route::get('/class_rooms/{id}/edit', ['uses' =>'ClassRoomController@edit','as' =>'content_management.ClassRoom.edit'])->middleware('acl:145');
                                                                                Route::put('/class_rooms/{id}', ['uses' =>'ClassRoomController@edit','as' =>'content_management.ClassRoom.update'])->middleware('acl:145');
                                                                                Route::delete('/class_rooms/{id}', ['uses' =>'ClassRoomController@destroy','as' =>'content_management.ClassRoom.destroy'])->middleware('acl:146');
                                                                                Route::get('/class_rooms/file_manager/connector', ['uses' =>'ClassRoomController@showFileManagerConnector','as' =>'content_management.ClassRoom.showFileManagerConnector'])->middleware('acl:147');
                                                                                Route::post('/class_rooms/file_manager/connector', ['uses' =>'ClassRoomController@showFileManagerConnector','as' =>'content_management.ClassRoom.showFileManagerConnector'])->middleware('acl:147');
                                                                                Route::get('/class_rooms/file_manager/{view}/{input_id?}', ['uses' =>'ClassRoomController@showFileManager','as' =>'content_management.ClassRoom.showFileManager'])->middleware('acl:148');
                                                                                Route::get('/class_rooms/settings/form', ['uses' =>'ClassRoomController@updateSettings','as' =>'content_management.ClassRoom.updateSettings'])->middleware('acl:149');
                                                                                Route::put('/class_rooms/settings/update', ['uses' =>'ClassRoomController@updateSettings','as' =>'content_management.ClassRoom.updateSettings'])->middleware('acl:149');
                                                                                
                        
                                                            Route::get('/contents/comments', ['uses' =>'ContentController@indexComment','as' =>'content_management.Content.indexComment'])->middleware('acl:150');
                                                                                Route::get('/contents/comments/list-view', ['uses' =>'ContentController@CommentsListView','as' =>'content_management.Content.CommentsListView'])->middleware('acl:151');
                                                                                Route::get('/contents/comments/{id}/edit', ['uses' =>'ContentController@editComment','as' =>'content_management.Content.editComment'])->middleware('acl:152');
                                                                                Route::put('/contents/comments/{id}', ['uses' =>'ContentController@editComment','as' =>'content_management.Content.editComment'])->middleware('acl:152');
                                                                                Route::get('/contents/comments/{id}', ['uses' =>'ContentController@showComment','as' =>'content_management.Content.showComment'])->middleware('acl:153');
                                                                                Route::delete('/contents/comments/{id}', ['uses' =>'ContentController@destroyComment','as' =>'content_management.Content.destroyComment'])->middleware('acl:154');
                                                                                Route::get('/contents/get_actions', ['uses' =>'ContentController@getActions','as' =>'content_management.Content.get_actions']);
                                                                                Route::get('/contents', ['uses' =>'ContentController@index','as' =>'content_management.Content.index'])->middleware('acl:156');
                                                                                Route::get('/contents/list-view', ['uses' =>'ContentController@listView','as' =>'content_management.Content.list_view'])->middleware('acl:157');
                                                                                Route::get('/contents/create', ['uses' =>'ContentController@create','as' =>'content_management.Content.create'])->middleware('acl:158');
                                                                                Route::post('/contents', ['uses' =>'ContentController@create','as' =>'content_management.Content.store'])->middleware('acl:158');
                                                                                Route::get('/contents/{id}', ['uses' =>'ContentController@show','as' =>'content_management.Content.show'])->middleware('acl:159');
                                                                                Route::get('/contents/{id}/edit', ['uses' =>'ContentController@edit','as' =>'content_management.Content.edit'])->middleware('acl:160');
                                                                                Route::put('/contents/{id}', ['uses' =>'ContentController@edit','as' =>'content_management.Content.update'])->middleware('acl:160');
                                                                                Route::delete('/contents/{id}', ['uses' =>'ContentController@destroy','as' =>'content_management.Content.destroy'])->middleware('acl:161');
                                                                                Route::get('/contents/file_manager/connector', ['uses' =>'ContentController@showFileManagerConnector','as' =>'content_management.Content.showFileManagerConnector'])->middleware('acl:162');
                                                                                Route::post('/contents/file_manager/connector', ['uses' =>'ContentController@showFileManagerConnector','as' =>'content_management.Content.showFileManagerConnector'])->middleware('acl:162');
                                                                                Route::get('/contents/file_manager/{view}/{input_id?}', ['uses' =>'ContentController@showFileManager','as' =>'content_management.Content.showFileManager'])->middleware('acl:163');
                                                                                Route::get('/contents/settings/form', ['uses' =>'ContentController@updateSettings','as' =>'content_management.Content.updateSettings'])->middleware('acl:164');
                                                                                Route::put('/contents/settings/update', ['uses' =>'ContentController@updateSettings','as' =>'content_management.Content.updateSettings'])->middleware('acl:164');
                                                                                
                        
                                                            Route::get('/pages/comments', ['uses' =>'PageController@indexComment','as' =>'content_management.Page.indexComment'])->middleware('acl:165');
                                                                                Route::get('/pages/comments/list-view', ['uses' =>'PageController@CommentsListView','as' =>'content_management.Page.CommentsListView'])->middleware('acl:166');
                                                                                Route::get('/pages/comments/{id}/edit', ['uses' =>'PageController@editComment','as' =>'content_management.Page.editComment'])->middleware('acl:167');
                                                                                Route::put('/pages/comments/{id}', ['uses' =>'PageController@editComment','as' =>'content_management.Page.editComment'])->middleware('acl:167');
                                                                                Route::get('/pages/comments/{id}', ['uses' =>'PageController@showComment','as' =>'content_management.Page.showComment'])->middleware('acl:168');
                                                                                Route::delete('/pages/comments/{id}', ['uses' =>'PageController@destroyComment','as' =>'content_management.Page.destroyComment'])->middleware('acl:169');
                                                                                Route::get('/pages/get_actions', ['uses' =>'PageController@getActions','as' =>'content_management.Page.get_actions']);
                                                                                Route::get('/pages', ['uses' =>'PageController@index','as' =>'content_management.Page.index'])->middleware('acl:171');
                                                                                Route::get('/pages/list-view', ['uses' =>'PageController@listView','as' =>'content_management.Page.list_view'])->middleware('acl:172');
                                                                                Route::get('/pages/create', ['uses' =>'PageController@create','as' =>'content_management.Page.create'])->middleware('acl:173');
                                                                                Route::post('/pages', ['uses' =>'PageController@create','as' =>'content_management.Page.store'])->middleware('acl:173');
                                                                                Route::get('/pages/{id}', ['uses' =>'PageController@show','as' =>'content_management.Page.show'])->middleware('acl:174');
                                                                                Route::get('/pages/{id}/edit', ['uses' =>'PageController@edit','as' =>'content_management.Page.edit'])->middleware('acl:175');
                                                                                Route::put('/pages/{id}', ['uses' =>'PageController@edit','as' =>'content_management.Page.update'])->middleware('acl:175');
                                                                                Route::delete('/pages/{id}', ['uses' =>'PageController@destroy','as' =>'content_management.Page.destroy'])->middleware('acl:176');
                                                                                Route::get('/pages/file_manager/connector', ['uses' =>'PageController@showFileManagerConnector','as' =>'content_management.Page.showFileManagerConnector'])->middleware('acl:177');
                                                                                Route::post('/pages/file_manager/connector', ['uses' =>'PageController@showFileManagerConnector','as' =>'content_management.Page.showFileManagerConnector'])->middleware('acl:177');
                                                                                Route::get('/pages/file_manager/{view}/{input_id?}', ['uses' =>'PageController@showFileManager','as' =>'content_management.Page.showFileManager'])->middleware('acl:178');
                                                                                Route::get('/pages/settings/form', ['uses' =>'PageController@updateSettings','as' =>'content_management.Page.updateSettings'])->middleware('acl:179');
                                                                                Route::put('/pages/settings/update', ['uses' =>'PageController@updateSettings','as' =>'content_management.Page.updateSettings'])->middleware('acl:179');
                                                                                
                        
                                                            Route::get('/slider_groups/get_actions', ['uses' =>'SliderGroupController@getActions','as' =>'content_management.SliderGroup.get_actions']);
                                                                                Route::get('/slider_groups', ['uses' =>'SliderGroupController@index','as' =>'content_management.SliderGroup.index'])->middleware('acl:181');
                                                                                Route::get('/slider_groups/list-view', ['uses' =>'SliderGroupController@listView','as' =>'content_management.SliderGroup.list_view'])->middleware('acl:182');
                                                                                Route::get('/slider_groups/create', ['uses' =>'SliderGroupController@create','as' =>'content_management.SliderGroup.create'])->middleware('acl:183');
                                                                                Route::post('/slider_groups', ['uses' =>'SliderGroupController@create','as' =>'content_management.SliderGroup.store'])->middleware('acl:183');
                                                                                Route::get('/slider_groups/{id}', ['uses' =>'SliderGroupController@show','as' =>'content_management.SliderGroup.show'])->middleware('acl:184');
                                                                                Route::get('/slider_groups/{id}/edit', ['uses' =>'SliderGroupController@edit','as' =>'content_management.SliderGroup.edit'])->middleware('acl:185');
                                                                                Route::put('/slider_groups/{id}', ['uses' =>'SliderGroupController@edit','as' =>'content_management.SliderGroup.update'])->middleware('acl:185');
                                                                                Route::delete('/slider_groups/{id}', ['uses' =>'SliderGroupController@destroy','as' =>'content_management.SliderGroup.destroy'])->middleware('acl:186');
                                                
                                                            Route::get('/sliders/get_actions', ['uses' =>'SliderController@getActions','as' =>'content_management.Slider.get_actions']);
                                                                                Route::get('/sliders', ['uses' =>'SliderController@index','as' =>'content_management.Slider.index'])->middleware('acl:188');
                                                                                Route::get('/sliders/list-view', ['uses' =>'SliderController@listView','as' =>'content_management.Slider.list_view'])->middleware('acl:189');
                                                                                Route::get('/sliders/create', ['uses' =>'SliderController@create','as' =>'content_management.Slider.create'])->middleware('acl:190');
                                                                                Route::post('/sliders', ['uses' =>'SliderController@create','as' =>'content_management.Slider.store'])->middleware('acl:190');
                                                                                Route::get('/sliders/{id}', ['uses' =>'SliderController@show','as' =>'content_management.Slider.show'])->middleware('acl:191');
                                                                                Route::get('/sliders/{id}/edit', ['uses' =>'SliderController@edit','as' =>'content_management.Slider.edit'])->middleware('acl:192');
                                                                                Route::put('/sliders/{id}', ['uses' =>'SliderController@edit','as' =>'content_management.Slider.update'])->middleware('acl:192');
                                                                                Route::delete('/sliders/{id}', ['uses' =>'SliderController@destroy','as' =>'content_management.Slider.destroy'])->middleware('acl:193');
                                                                                Route::get('/sliders/file_manager/connector', ['uses' =>'SliderController@showFileManagerConnector','as' =>'content_management.Slider.showFileManagerConnector'])->middleware('acl:194');
                                                                                Route::post('/sliders/file_manager/connector', ['uses' =>'SliderController@showFileManagerConnector','as' =>'content_management.Slider.showFileManagerConnector'])->middleware('acl:194');
                                                                                Route::get('/sliders/file_manager/{view}/{input_id?}', ['uses' =>'SliderController@showFileManager','as' =>'content_management.Slider.showFileManager'])->middleware('acl:195');
                                                                                Route::get('/sliders/settings/form', ['uses' =>'SliderController@updateSettings','as' =>'content_management.Slider.updateSettings'])->middleware('acl:196');
                                                                                Route::put('/sliders/settings/update', ['uses' =>'SliderController@updateSettings','as' =>'content_management.Slider.updateSettings'])->middleware('acl:196');
                                                                                
                        
                                                            Route::get('/tags/get_actions', ['uses' =>'TagController@getActions','as' =>'content_management.Tag.get_actions']);
                                                                                Route::get('/tags', ['uses' =>'TagController@index','as' =>'content_management.Tag.index'])->middleware('acl:198');
                                                                                Route::get('/tags/list-view', ['uses' =>'TagController@listView','as' =>'content_management.Tag.list_view'])->middleware('acl:199');
                                                                                Route::get('/tags/create', ['uses' =>'TagController@create','as' =>'content_management.Tag.create'])->middleware('acl:200');
                                                                                Route::post('/tags', ['uses' =>'TagController@create','as' =>'content_management.Tag.store'])->middleware('acl:200');
                                                                                Route::get('/tags/{id}', ['uses' =>'TagController@show','as' =>'content_management.Tag.show'])->middleware('acl:201');
                                                                                Route::get('/tags/{id}/edit', ['uses' =>'TagController@edit','as' =>'content_management.Tag.edit'])->middleware('acl:202');
                                                                                Route::put('/tags/{id}', ['uses' =>'TagController@edit','as' =>'content_management.Tag.update'])->middleware('acl:202');
                                                                                Route::delete('/tags/{id}', ['uses' =>'TagController@destroy','as' =>'content_management.Tag.destroy'])->middleware('acl:203');
                                                                                
                        
                                                            Route::get('/static_menus/get_actions', ['uses' =>'StaticMenuController@getActions','as' =>'content_management.StaticMenu.get_actions']);
                                                                                Route::get('/static_menus', ['uses' =>'StaticMenuController@index','as' =>'content_management.StaticMenu.index'])->middleware('acl:205');
                                                                                Route::get('/static_menus/list-view', ['uses' =>'StaticMenuController@listView','as' =>'content_management.StaticMenu.list_view'])->middleware('acl:206');
                                                                                Route::get('/static_menus/create', ['uses' =>'StaticMenuController@create','as' =>'content_management.StaticMenu.create'])->middleware('acl:207');
                                                                                Route::post('/static_menus', ['uses' =>'StaticMenuController@create','as' =>'content_management.StaticMenu.store'])->middleware('acl:207');
                                                                                Route::get('/static_menus/{id}', ['uses' =>'StaticMenuController@show','as' =>'content_management.StaticMenu.show'])->middleware('acl:208');
                                                                                Route::get('/static_menus/{id}/edit', ['uses' =>'StaticMenuController@edit','as' =>'content_management.StaticMenu.edit'])->middleware('acl:209');
                                                                                Route::put('/static_menus/{id}', ['uses' =>'StaticMenuController@edit','as' =>'content_management.StaticMenu.update'])->middleware('acl:209');
                                                                                Route::delete('/static_menus/{id}', ['uses' =>'StaticMenuController@destroy','as' =>'content_management.StaticMenu.destroy'])->middleware('acl:210');
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