<?php

function makeRouteFile()
{
    $output = view('appnegar::route');
    $route_file = base_path("/packages/appnegar/cms/src/routes/") . "/web.php";

    if (file_exists($route_file) && $fs = fopen($route_file, 'w')) {
        fwrite($fs, $output);
        fclose($fs);
    }
}

function makeSettingFile()
{
    $setting_groups = \App\SettingGroup::with('settings')->get();
    $output = view('appnegar::setting', compact('setting_groups'));
    $route_file = base_path("/config") . "/system.php";
    if (file_exists($route_file) && $fs = fopen($route_file, 'w')) {
        fwrite($fs, $output);
        fclose($fs);
    }
}

function getActions($department_name, $resource_name)
{
    $user = $user = \Auth::user();
    $actions = [];
    if ($user) {


        if (Storage::disk('local')->exists('cache/departments.json')) {
            $departments = json_decode(Storage::disk('local')->get('cache/departments.json'), true);
        } else {
            $departments = \App\Department::with(['resource_groups' => function ($query) {
                $query->with(['resources' => function ($query) {
                    $query->with(['actions' => function ($query) {
                        $query->select(['id', 'resource_id', 'name', 'display_name']);
                    }]);
                    $query->with(['children' => function ($query) {
                        $query->select(['id', 'parent_id', 'name', 'display_name']);
                        $query->with(['actions' => function ($query) {
                            $query->select(['id', 'resource_id', 'name', 'display_name']);
                        }]);
                    }]);
                    $query->select(['id', 'resource_group_id', 'name', 'display_name']);
                }]);
                $query->select(['id', 'department_id', 'name', 'display_name']);
            }])->select(['id', 'name', 'display_name'])->get()->toArray();

            $json_string_departments = json_encode($departments, JSON_UNESCAPED_UNICODE);
            Storage::disk('local')->put('cache/departments.json', $json_string_departments);
        }

//        dd($departments);


        $array_actions = [];
        foreach ($departments as $department) {
            if ($department['name'] == $department_name) {

                if ($department['resource_groups']) {
                    foreach ($department['resource_groups'] as $resource_group) {
                        if ($resource_group['resources']) {
                            foreach ($resource_group['resources'] as $resource) {
                                if (strtolower($resource['name']) == strtolower($resource_name)) {
                                    if ($resource['actions']) {
                                        foreach ($resource['actions'] as $action) {
                                            if ($user->canDo($action['id'], $department['id'])) {
                                                $array_actions[$action['name']] = 1;
                                            }
                                        }
                                    }
                                    if ($resource['children']) {
                                        foreach ($resource['children'] as $child) {
                                            foreach ($child['actions'] as $action) {
                                                $resource_name = ltrim(strtolower(preg_replace('/[A-Z]([A-Z](?![a-z]))*/', '_$0', $child['name'])), '_');
                                                if ($resource_name !== 'profile') {
                                                    $resource_name = str_plural($resource_name);
                                                }
                                                if ($user->canDo($action['id'])) {
                                                    $array_actions[$resource_name][$action['name']] = 1;
                                                }
                                            }
                                        }
                                    }
                                }


                            }
                        }
                    }
                }
            }
        }
        return $array_actions;

    }
    return $actions;

}

function setLang($request)
{
    $lang = 'fa';
    $available_langs = Illuminate\Support\Facades\Config::get('system.available_langs');
    $params = $request->route()->parameters();
    if (isset($params['lang'])) {
        $lang = $params['lang'];
    } else {
        $array = explode('/', $request->route()->uri);
        if (count($array) > 0) {
            $lang = $array[0];
        }
    }

    if (!in_array($lang, $available_langs)) {
        session(['lang' => 'fa']);
        app()->setLocale('fa');
        session(['direction' => 'rtl']);
        abort(404);
    }

    session(['lang' => $lang]);
    app()->setLocale($lang);

    switch ($lang) {
        case 'fa':
        case 'ar':
            session(['direction' => 'rtl']);
            break;
        default:
            session(['direction' => 'ltr']);
            break;
    }
//    dd(session('direction'));
}

function trimArray($array_string)
{
    $array = explode(",", $array_string);
    foreach ($array as $index => $value) {
        $array[$index] = trim($value);
    }
    return $array;
}

function trimArrayString($array_string)
{
    return implode(",", trimArray($array_string));
}

function setDepartment($request, $department = null)
{

    if ($department == null) {
        if ($request->route('department')) {
            $department = $request->route('department');
        } else {
            $department = 'profile';

            $department_names = getDepartment_names();
            $array = explode('/', $request->route()->uri);
            if (count($array) > 1 and in_array($array[1], $department_names)) {
                $department = $array[1];
            }


        }
    }
//    dd('setDepartment');
    session(['department' => $department]);
}

function getDepartment_names()
{
    $department_names = Cache::remember('department_names', Config::get('cache.ttl'), function () {
        $departments = App\Department::select(['name', 'prefix'])->get();
        $department_names = $departments->pluck('name')->toArray();
        return $department_names;
    });
    return $department_names;
}

function setUserSession($over_write = false)
{

    $session_key = 'user_info';
    if (session('department') !== null) {
        $session_key = 'user_info_' . session('department');
    }
//dd(session($session_key) );
    if (session($session_key) == null || $over_write == true) {
        if (session('department') and session('department') !== 'profile') {
            $user = \Auth::guard(session('department'))->user();
            if ($user) {
                $user->load('profile');
                $array_user = $user;
                session([$session_key => $array_user]);
            }
        } else {
//            dd('profile');
            setBasicUserSession(true);
        }


    }
}

function setBasicUserSession($over_write = false)
{

    $session_key = 'user_info';

    if (session($session_key) == null || $over_write == true) {
        $user = \Auth::user();


        if ($user) {
            $user->load('profile');
//            $array_user = $user->toArray();
            session([$session_key => $user]);
        }
    }
}

function getAdminMenu($name)
{
    $session_key = 'user_info';
    if (session('department') !== null && session('department') !== 'profile') {
        $session_key = 'user_info_' . session('department');
    }
    $user = session($session_key);
    if ($user) {
        $cacheKey = 'user_admin_menu_' . session('department') . '_' . $user['id'];
        return Cache::remember($cacheKey, Config::get('cache.ttl'), function () use ($user, $name) {
            $action_ids = [];
            foreach ($user->cachedRoles() as $role) {
                $cached_actions = $role->cachedActions();
                foreach ($cached_actions as $action) {
                    $action_ids[] = $action->id;
                }
                $global_actions = \App\Action::where('need_allow', 0)->get();

                foreach ($global_actions as $action) {
                    if (!in_array($action->id, $action_ids)) {
                        $action_ids[] = $action->id;
                    }
                }
            }
            $menu = \App\Menu::where('name', $name)->first();
            $menu_items = \App\MenuItem::with('path.action')->with('children.path.action')->where('menu_id', $menu->id)->where('parent_id', null)->get();
            $array_menu_items = [];
            foreach ($menu_items as $index => $menu_item) {
                $item = hasMenuItemAccess($menu_item, $action_ids, $menu->name);
                if ($item !== false) {
                    $array_menu_items[] = $item;
                }
            }

            return $array_menu_items;
        });

    }
    return [];

}

function hasMenuItemAccess($menu_item, $action_ids, $menu_name)
{
    if ($menu_item->path and $menu_item->path->action) {
        if (!in_array($menu_item->path->action->id, $action_ids)) {
            return false;
        }
    }
    $array_menu_item = filterMenuItemArray($menu_item->toArray(), $menu_name);

    $array_menu_item['children'] = [];
    $array_menu_item['counter'] = 0;
    $counter = 0;
    foreach ($menu_item->children as $index => $child) {
        $child = hasMenuItemAccess($child, $action_ids, $menu_name);
        if ($child !== false or (!is_bool($child) and count($child) > 0)) {
            $array_menu_item['children'][] = $child;
            $counter++;
        }
    }
    if (count($menu_item->children) > 0 and $counter == 0) {
        return false;
    }
    return $array_menu_item;

}

function filterMenuItemArray($array_menu_item, $menu_name)
{
    unset($array_menu_item['path']);
    unset($array_menu_item['path_id']);
    unset($array_menu_item['menu_id']);
    unset($array_menu_item['parent_id']);
    $array_menu_item['url'] = str_replace($menu_name . '/', "", $array_menu_item['url']);
    return $array_menu_item;
}

function savefile($file, $config, $prefix = 'file_')
{
    $error_massages = [];
    $name = null;
    if ($file) {
        if (!$file->isValid()) {
            $error_massages[] = $file->getError();
        } else {
            if ($file->getClientSize() > $config['size'] * 1024) {
                $error_massages[] = "اندازه فایل بیشتر از " . $config['size'] . ' کیلو بایت نمی تواند باشد.';
            }
            $photo_extension = explode(',', $config['extension']);
            foreach ($photo_extension as $key => $value) {
                $photo_extension[$key] = trim($value);
            }
            if (!in_array($file->getClientOriginalExtension(), $photo_extension)) {
                $error_massages[] = "فرمت فایل غیر مجاز است";
            }
        }

        if (count($error_massages) == 0) {
            $name = uniqid($prefix) . '.' . $file->getClientOriginalExtension();
            $status = Storage::putFileAs($config['destination'], $file, $name, 'public');
            if ($status == true) {
                return (['status' => 'success', 'data' => $name]);
            } else {
                return (['status' => 'error', 'data' => ['خطایی در دخیره ی عکس بوجود امده است.']]);
            }

        } else {
            return (['status' => 'error', 'data' => $error_massages]);
        }
    }
    return (['status' => 'success', 'data' => $name]);
}

function deleteFile($path)
{
    $status = true;
    if ($path != null and strpos($path, 'default') == false) {
        $path = str_replace('/storage', "", $path);
        $status = Storage::delete($path);
    }
    return $status;
}

function numberConvertor($string, $lang = 'en2fa')
{
    $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
    $english = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
    $arabic = ['٩', '٨', '٧', '٦', '٥', '٤', '٣', '٢', '١', '٠'];

    $string_convert = $string;

    switch ($lang) {
        case 'en2fa' :
            $string_convert = str_replace($english, $persian, $string);
            break;

        case 'fa2en' :
            $string_convert = str_replace($persian, $english, $string);
            break;

    }

    return $string_convert;
}