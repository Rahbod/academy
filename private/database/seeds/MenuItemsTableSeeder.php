<?php

use Illuminate\Database\Seeder;
use App\MenuItem;
use App\Menu;
use App\Department;

class MenuItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0'); // disable foreign key constraints

        MenuItem::truncate();

        $menus = Menu::all();

        $available_routs=[
            'listView',
            'create',
            'updateAllSettings',
            'updateSettings',
            'CommentsListView',
            'showFileManager',
            'reports',
            'register',
            'classrooms',
            'unverifiedRequests',
            'awaitingPaymentRequests',
            'paidRequests',
        ];

        foreach ($menus as $menu) {
            $department = Department::where('name', $menu->name)->with(['resource_groups' => function ($query)use($available_routs) {
                $query->with(['resources' => function ($query)use($available_routs) {
                    $query->with(['actions' => function ($query)use($available_routs) {
                        foreach ($available_routs as $index=>$rout){
                            if($index === 0){
                                $query->where('name',$rout);
                            }
                            else{
                                $query->orWhere('name',$rout);
                            }
                        }
                        $query->with(['paths' => function ($query2) {
                            $query2->where('method', 'get');
                        }])->orderBy('id');
//                        $query->where('name', 'listView')->orWhere('name', 'create')->orWhere('name', 'updateAllSettings')->orWhere('name', 'updateSettings')->orWhere('name', 'CommentsListView')->orWhere('name', 'showFileManager')->orWhere('name', 'reports')->with(['paths' => function ($query2) {
//                            $query2->where('method', 'get');
//                        }])->orderBy('id');

                    }])->orderBy('id');
                }]);

            }])->first();

            $order = 1;
            foreach ($department->resource_groups as $resourceGroup) {

                $parent_menu_item = MenuItem::create([
                    'menu_id' => $menu->id,
                    'name' => $resourceGroup->name,
                    'display_name' => $resourceGroup->display_name,
                    'order' => $order++,
                    'target' => '_blank',
                    'url' => $resourceGroup->name
                ]);

                $order2 = 1;
                foreach ($resourceGroup->resources as $resource) {


                    $prefix = '';
                    $menu_item = $parent_menu_item;

                    if (count($resourceGroup->resources) > 1) {
                        $resource_name = ltrim(strtolower(preg_replace('/[A-Z]([A-Z](?![a-z]))*/', '_$0', $resource->name)), '_');
                        if ($resource_name !== 'profile' and $resource_name !== 'dashboard') {
                            $resource_name = str_plural($resource_name);
                        }
                        $prefix = $resourceGroup->name;
                        if (count($resource->actions)>=1 || $resource_name == 'profile')
                        $menu_item = MenuItem::create([
                            'menu_id' => $menu->id,
                            'parent_id' => $menu_item->id,
                            'name' => $resource_name,
                            'display_name' => 'مدیریت ' . $resource->display_name,
                            'order' => $order2++,
                            'target' => '_blank',
                            'url' => $prefix . '/' . $resource_name
                        ]);

                        $prefix .= '/';
                    }

                    $order3 = 1;
                    if (count($resource->actions) >= 1) {
                        foreach ($action = $resource->actions as $action) {
                            if (count($action->paths) >= 1) {
                                $path = $action->paths[0];
                                if ($action->name == 'updateAllSettings' and $department->name == 'admin') {
                                    MenuItem::create([
                                        'menu_id' => $menu->id,
                                        'parent_id' => $menu_item->id,
                                        'name' => $path->name,
                                        'display_name' => $path->display_name,
                                        'order' => $order3++,
                                        'target' => '_blank',
                                        'path_id' => $path->id,
                                        'url' => $prefix . $path->slug
                                    ]);
                                } elseif (!($department->name == 'site_management' and $resource->name == 'Setting')) {
                                    $slug = $path->slug;
                                    if ($action->name == 'showFileManager') {
                                        $slug = str_replace('{view}/{input_id?}', 'index', $path->slug);
                                    }

                                    if(in_array($action->name,$available_routs)){
                                        MenuItem::create([
                                                'menu_id' => $menu->id,
                                                'parent_id' => $menu_item->id,
                                                'name' => $path->name,
                                                'display_name' => $path->display_name,
                                                'order' => $order3++,
                                                'target' => '_blank',
                                                'path_id' => $path->id,
                                                'url' => $prefix . $slug
                                            ]);
                                    }

//                                    switch ($action->name) {
//                                        case 'listView':
//                                        case 'CommentsListView':
//                                        case 'create':
//                                        case 'showFileManager':
//                                        case 'updateSettings': {
//                                            MenuItem::create([
//                                                'menu_id' => $menu->id,
//                                                'parent_id' => $menu_item->id,
//                                                'name' => $path->name,
//                                                'display_name' => $path->display_name,
//                                                'order' => $order3++,
//                                                'target' => '_blank',
//                                                'path_id' => $path->id,
//                                                'url' => $prefix . $slug
//                                            ]);
//                                            break;
//                                        }
//
//                                    }
                                }

                            }
                        }
                    }
                }
            }
        }

        $menu_items = MenuItem::all();

        foreach ($menu_items as $menu_item) {
            switch ($menu_item->name) {
                case 'dashboard';
                    $menu_item->icon = 'icon-home4';
                    break;
                case 'profile';
                    $menu_item->icon = 'icon-user';
                    break;
                case 'resources';
                    $menu_item->icon = 'icon-database-menu';
                    break;
                case 'sp_namespaces';
                    $menu_item->icon = 'icon-server';
                    break;
                case 'departments';
                    $menu_item->icon = 'icon-city';
                    break;
                case 'resource_groups';
                    $menu_item->icon = 'icon-list2';
                    break;
                case 'actions';
                    $menu_item->icon = 'icon-hammer';
                    break;
                case 'paths';
                    $menu_item->icon = 'icon-road';
                    break;
                case 'templates';
                    $menu_item->icon = 'icon-windows2';
                    break;
                case 'master_pages';
                    $menu_item->icon = 'icon-browser';
                    break;
                case 'sections';
                    $menu_item->icon = 'icon-insert-template';
                    break;
                case 'pages';
                    $menu_item->icon = 'icon-file-check';
                    break;
                case 'frames';
                    $menu_item->icon = 'icon-pagebreak';
                    break;
                case 'settings';
                    $menu_item->icon = 'icon-cog2';
                    break;
                case 'setting_groups';
                    $menu_item->icon = 'icon-equalizer3';
                    break;

                case 'users';
                    $menu_item->icon = 'icon-users4';
                    break;
                case 'roles';
                    $menu_item->icon = 'icon-key';
                    break;
                case 'menus';
                    $menu_item->icon = 'icon-menu2';
                    break;
                case 'menu_items';
                    $menu_item->icon = 'icon-menu7';
                    break;
                case 'activity_logs';
                    $menu_item->icon = 'icon-reading';
                    break;




                case 'categories';
                    $menu_item->icon = 'icon-tree6';
                    break;
                case 'static_menu';
                    $menu_item->icon = 'icon-menu2';
                    break;
                case 'contents';
                    $menu_item->icon = 'icon-stack-text';
                    break;
                case 'courses';
                    $menu_item->icon = 'icon-graduation2';
                    break;
                case 'class_rooms';
                    $menu_item->icon = 'icon-users4';
                    break;
                case 'questions';
                    $menu_item->icon = 'icon-question4';
                    break;
                case 'galleries';
                    $menu_item->icon = 'icon-images3';
                    break;
                case 'gallery_items';
                    $menu_item->icon = 'icon-images2';
                    break;
                case 'videos';
                    $menu_item->icon = 'icon-video-camera3';
                    break;
                case 'sliders';
                    $menu_item->icon = 'icon-image-compare';
                    break;case 'slider_groups';
                case 'sliders_groups';
                    $menu_item->icon = 'icon-list';
                    break;
                case 'audio';
                    $menu_item->icon = 'icon-album';
                    break;
                case 'tags';
                    $menu_item->icon = 'icon-price-tags';
                    break;
                case 'feedbacks';
                    $menu_item->icon = 'icon-envelop5';
                    break;
                case 'user_class';
                    $menu_item->icon = 'icon-profile';
                    break;
                case 'attachment';
                    $menu_item->icon = 'icon-attachment';
                    break;
                case 'translate_request';
                    $menu_item->icon = 'icon-clipboard3';
                    break;
                case 'user_transaction';
                    $menu_item->icon = 'icon-coins';
                    break;
                default:
                    $this->setMenuIcon($menu_item);
                    break;
            }

            $menu_item->save();
        }
    }

    protected function setMenuIcon(&$menu_item){
        try{
            if(strpos($menu_item->name,'.') !== false){
                list($prefix,$name)=explode('.',$menu_item->name);

                if($name){
                    switch ($name) {
                        case 'CommentsListView';
                            $menu_item->icon = 'icon-comment-discussion';
                            break;
                        case 'list_view';
                        case 'listView';
                            $menu_item->icon = 'icon-grid';
                            break;
                        case 'create';
                            $menu_item->icon = 'icon-file-plus';
                            break;
                        case 'showFileManager';
                            $menu_item->icon = 'icon-folder-search';
                            break;
                        case 'updateSettings';
                        case 'updateAllSettings';
                            $menu_item->icon = 'icon-cogs';
                            break;
                        default:
                            echo $menu_item->name;
                            break;

                    }
                }
            }
            else{
                echo $menu_item->name . ' - dont set icon';
                echo "\n";
            }
        }catch (Exception $exception){
            dd($menu_item->name,strpos('.',$menu_item->name),strpos('.',$menu_item->name) !== -1);
        }


    }
}


