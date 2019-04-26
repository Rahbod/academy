<?php
namespace Appnegar\Cms\Controllers\ContentManagement;

use Appnegar\Cms\Controllers\AdminController;

class SliderGroupController extends AdminController{

    public function __construct(){
        $this->resource='SliderGroup';
    }

    protected function getTableConditions(){
        return ['lang'=>session('lang')];
    }

    protected function getOrderScopes(){
        return ['lang','parent_id'];
    }

    protected function getFormData($data)
    {
        $not_in_ids=[];
        if ($data['id'] !== 0) {
            $not_in_ids=array_merge([$data->id], $data->descendants()->pluck('id')->toArray());
        }
        return[
            'model'=>$data,
            'options'=>[
                'parent_id' => $this->getCategories($not_in_ids,$this->resource)
            ]
        ];
    }
}