<?php

namespace Appnegar\Cms\Controllers\SystemManagement;

use App\Events\ChangeMenu;
use App\Menu;
use App\MenuItem;
use App\Path;
use Illuminate\Http\Request;
use Appnegar\Cms\Controllers\AdminController;

class MenuController extends AdminController
{
    public function __construct()
    {
        $this->resource = 'Menu';
    }

    protected function setModel($model)
    {
        $data = $model->toArray();
        $menu_items = $nodes = MenuItem::where('menu_id', $model->id)->get()->toTree();
        if ($menu_items !== null) {

            $data['menu_items'] = $menu_items->toArray();
        }
        return $data;
    }

    /**
     * @param $model
     * @param $request
     * @param $action
     * @param null $order_conditions
     * @param null $fields
     * @return mixed
     */
    protected function saveModel($model, $request,$action, $order_conditions = null, $fields = null)
    {
        $model->name = $request->name;
        $model->display_name = $request->display_name;
        $model->icon_type = $request->icon_type;
        $model->description = $request->description;

        if (isset($request->order_ids) and $request->order_ids !== null) {
            $order_ids = json_decode($request->order_ids, true);
            $this->orderMenuItems($order_ids, null);
        }
        $status = $model->save();

        if($status){
//            event(new ChangeMenu());
        }

        return ['status'=>$status];
    }

    /**
     * @param array $modelItems
     * @param $root
     */
    private function orderMenuItems(array $modelItems, $root)
    {
        $prev_item = null;
        $parent_id = null;
        if ($root !== null) {
            $parent_id = $root->id;
        }
        foreach ($modelItems as $index => $modelItem) {

            $item = MenuItem::findOrFail($modelItem['id']);

            $item->order = $index + 1;
            $item->parent_id = $parent_id;
            if ($prev_item !== null) {
                $item->insertAfterNode($prev_item);

            } else {
                $item->save();
            }
            $prev_item = $item;


            if (isset($modelItem['children'])) {
                $this->orderMenuItems($modelItem['children'], $item);
            }
        }
    }

    /**
     * @param null $id
     * @return array
     * @internal param $request
     */
    protected function validationRules($request,$id = null)
    {
        $rules = [
            'name' => 'required|unique:menus,name',
            'display_name' => 'required|unique:menus,display_name',
        ];
        if ($id !== null) {
            $rules['name'] .= ',' . $id;
            $rules['display_name'] .= ',' . $id;
        }
        return $rules;
    }

    /**
     * @param array $data
     * @return array
     * @internal param null $model
     */
    protected function getFormData($data)
    {

        return [
            'model' => $data,
            'options' => ['menu_items.path_id' => Path::where('method', 'get')->orderBy('id')->get(['id', 'display_name  AS text'])],
        ];
    }

}