<?php

namespace App\Http\View\Composer;


use App\StaticMenu;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class Menus
{
    /**
     * The user repository implementation.
     *
     * @var $categories
     */
    protected $main_menus;
    protected $menus;


    public function __construct()
    {
//        Cache::flush();

        $lang=$this->getLang();

        $this->main_menus = Cache::remember('main_menus_'.$lang, 5000, function () use ($lang){


            $static_menu = StaticMenu::with(['page' => function ($q) use ($lang) {
                $q->where('status', 1)->where('lang', $lang)->orderBy('order')->select('id', 'title');
            }])->where('status', 1)->where('lang', $lang)->orderBy('order')
                ->get()->toTree();
            $array_menu=[];
            foreach ($static_menu as $menu){
                $array_menu[]=$this->setMenu($menu);
            }
            dd($array_menu);
            return $array_menu;
        });

    }

    public function compose(View $view)
    {
        $view->with('main_menus', $this->main_menus);
    }

    protected function setMenu($menu){
        $lang=$this->getLang();
        $menu_item=[
            'id'=>$menu->id,
            'name'=>$menu->name,
            'special_name'=>$menu->special_name,
            'description'=>$menu->description,
            'has_content'=>$menu->has_content,
            'type'=>$menu->type,
            'link'=>$menu->link,
            'active'=>false,
            'children'=>[]
        ];

        if($menu->type === 'page' && $menu->page !== null){
            $menu_item['link']=url('/'.$lang.'/pages/show/'.$menu->page->id);
        }
        if($menu->type === 'action'){
            $menu_item['link']=url('/'.$lang.'/'.$menu->link);
        }
        if(count($menu->children)>0){
            foreach ($menu->children as $child){
                $menu_item['children'][]=$this->setMenu($child);
            }
        }
        if(url(request()->path() === $menu_item['link'])){
            $menu_item['active']=true;
        }

        return $menu_item;
    }

    protected function getLang(){
        $lang = 'fa';
        $array_path=explode('/',request()->path());
        if(count($array_path)>0){
            $lang=$array_path[0];
        }
        return $lang;
    }
}