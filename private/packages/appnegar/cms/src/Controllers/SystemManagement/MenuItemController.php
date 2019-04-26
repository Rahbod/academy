<?php

namespace Appnegar\Cms\Controllers\SystemManagement;

//use App\Events\ChangeMenu;
use Illuminate\Validation\Rule;

use App\Menu;
use App\MenuItem;
use App\Path;
use Illuminate\Http\Request;
use Appnegar\Cms\Controllers\AdminController;


class MenuItemController extends AdminController
{
    public function __construct()
    {
        $this->resource = 'MenuItem';
    }

    protected function getOrderScopes(){
        return ['menu_id','parent_id'];
    }

    protected function setModel($model)
    {
        $menu = Menu::select(['icon_type'])->findOrFail($model['menu_id']);
        $model->icon_type = $menu->icon_type;
        return $model;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ids = explode(',', $id);
        return $this->deleteModels($this->resource,[],$ids,true,false,$this->getOrderScopes());
    }


    /**
     * @param $parent_id
     * @param $menu_id
     */
    protected function fixTree($parent_id, $menu_id)
    {
        $models = MenuItem::where('parent_id', $parent_id)->where('menu_id', $menu_id)->orderBy('order')->get();
        if ($models) {
            $prev_item = null;
            foreach ($models as $item) {
                if ($prev_item !== null) {
                    $item->afterNode($prev_item)->save();
                }
                $prev_item = $item;
            }
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function changeMenu(Request $request)
    {
        $this->validate($request, [
            'menu_id' => 'required|exists:menus,id'
        ]);
        $menu = Menu::findOrFail($request->menu_id);


        $not_in_ids = [];
        if ($request->id != 0) {
            $model = MenuItem::findOrFail($request->id);
            if ($model !== null) {
                $not_in_ids = array_merge([$model->id], $model->descendants()->pluck('id')->toArray());
            }
        }

        $menu_ids = $this->getMenuItems($menu->id, $not_in_ids);


        return response()->json(['menu_id' => $menu_ids, 'icon_type' => $menu->icon_type]);
    }

    /**
     * @param $menu_id
     * @param array $not_in_ids
     * @return array
     */
    protected function getMenuItems($menu_id, $not_in_ids = [])
    {
        $nodes = MenuItem::whereNotIn('id', $not_in_ids);
        if ($menu_id !== null) {
            $nodes->where('menu_id', $menu_id);
        }
        $nodes = $nodes->get()->toTree();
        $array = [];
        $traverse = function ($nodes, $prefix = '-', &$array) use (&$traverse) {
            foreach ($nodes as $nodes) {
//                echo PHP_EOL . $prefix . ' ' . $category->name;
                $array[] = ['id' => $nodes->id, 'text' => $prefix . ' ' . $nodes->display_name];

                $traverse($nodes->children, $prefix . '- ', $array);
            }
        };

        $traverse($nodes, '- ', $array);
        return $array;
    }

    /**
     * @param $request
     * @param null $id
     * @return array
     */
    protected function validationRules($request, $id = null)
    {
        $rules = [
            'path_id' => 'required_without:url|exists:paths,id',
            'menu_id' => 'required|exists:menus,id',
            'name' => Rule::unique('menu_items')->where(function ($query) use ($request, $id) {
                $query->where('menu_id', $request->menu_id)->where('parent_id', $request->parent_id);
                if ($id !== null) {
                    $query->where('id', '<>', $id);
                }
            }),
            'display_name' => Rule::unique('menu_items')->where(function ($query) use ($request, $id) {
                $query->where('menu_id', $request->menu_id)->where('parent_id', $request->parent_id);
                if ($id !== null) {
                    $query->where('id', '<>', $id);
                }
            }),
            'url' => 'required_without:path_id',
            'target' => 'required',
            'order' => 'numeric|min:0',
        ];
        if ($request->parent_id !== null) {
            $rules['parent_id'] = [
                Rule::exists('menu_items', 'id')->where(function ($query) use ($request, $id) {
                    $query->where('menu_id', $request->menu_id);
                    if ($id !== null) {
                        $model = MenuItem::findOrFail($id);
                        $not_in_ids = array_merge([$id], $model->descendants()->pluck('id')->toArray());
                        $query->whereNotIn('id', $not_in_ids);
                    }
                })
            ];
        }
        return $rules;
    }

    /**
     * @param array $data
     * @param null $model
     * @return array
     */
    protected function getFormData($data)
    {
        $not_in_ids = [];
        $menu_id = null;
        if ($data['id'] !== 0) {
            $menu_id = $data['menu_id'];
            $not_in_ids = array_merge([$data['id']], $data->descendants()->pluck('id')->toArray());
        }

        return [
            'model' => $data,
            'options' => [
                'parent_id' => $this->getMenuItems($menu_id, $not_in_ids),
                'path_id' => Path::orderBy('id')->get(['id', 'display_name  AS text']),
                'menu_id' => Menu::orderBy('id')->get(['id', 'display_name  AS text'])
            ],
            'image_path' => [],
            'name' => 'menu_item',

        ];

    }

//    /**
//     * @param $model
//     * @param $request
//     * @return int
//     */
//    protected function updateOrder($model, $request)
//    {
//        $query = MenuItem::where('menu_id', $request->menu_id)->where('parent_id', $request->parent_id);
//        if ($model->id) {
//            $query->where('id', '<>', $model->id);
//        }
//        $max = $query->max('order');
//        if ($request->order > $max or $request->order == null) {
//            $new_order = $max + 1;
//        } elseif ($request->order == 0) {
//            $new_order = 1;
//        } else {
//            $new_order = $request->order;
//        }
//
//
//        if ($model->id == null || $model->parent_id != $request->parent_id || $model->menu_id != $request->menu_id) { //when create new model
//
//            MenuItem::where('menu_id', $request->menu_id)->where('parent_id', $request->parent_id)->where('order', '>=', $new_order)->increment('order', 1);
//            if (($model->parent_id != $request->parent_id || $model->menu_id != $request->menu_id) and $model->id != null) {
//                MenuItem::where('menu_id', $model->menu_id)->where('parent_id', $model->parent_id)->where('order', '>', $model->order)->decrement('order', 1);
//            }
//        } else { //when update model
//            if ($new_order < $model->order) {
//                MenuItem::where('menu_id', $request->menu_id)->where('parent_id', $request->parent_id)->where('order', '>=', $new_order)->where('order', '<', $model->order)->increment('order', 1);
//            }
//            if ($new_order > $model->order) {
//                MenuItem::where('menu_id', $request->menu_id)->where('parent_id', $request->parent_id)->where('order', '<=', $new_order)->where('order', '>', $model->order)->decrement('order', 1);
//            }
//
//        }
//
//        return $new_order;
//
//    }

}