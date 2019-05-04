<?php
namespace Appnegar\Cms\Controllers\Admin;

use Appnegar\Cms\Controllers\AdminController;
use Illuminate\Validation\Rule;

class AdminCategoryController extends AdminController{


    protected function getTableConditions(){
        return ['lang'=>session('lang')];
    }

    protected function getOrderScopes(){
        return ['lang','parent_id'];
    }

    protected function setModel($model)
    {
        if($model->author_id !== null){
            $model->author_id=$model->author->name;
        }
        return $model;
    }

    protected function validationRules($request, $id = null)
    {
        $model_name="\App\\".$this->resource;
        $rules = [
            'name' => [
                'required',
                Rule::unique($this->getResourceName($this->resource), 'name')->where(function ($query) use ($id, $request) {
                    $query->where('parent_id', $request->parent_id);
                    if ($id !== null) {
                        $query->where('id', '<>', $id);
                    }
                })
            ],
            'special_name' => [
                'nullable',
                Rule::unique($this->getResourceName($this->resource), 'special_name')->where(function ($query) use ($id, $request) {
                    $query->where('parent_id', $request->parent_id);
                    if ($id !== null) {
                        $query->where('id', '<>', $id);
                    }
                })
            ],
            'parent_id' => "exists:{$this->getResourceName($this->resource)},id|nullable",
            'status' => 'numeric|between:0,1|nullable',
            'order' => 'numeric|min:0|nullable',
        ];
        if ($id !== null) {
            if($request->parent_id !== null){
                $rules['parent_id']=[
                    Rule::exists($this->getResourceName($this->resource),'id')->where(function ($query)use($request,$id,$model_name){
                        if($id !== null){
                            $model=$model_name::findOrFail($id);
                            $not_in_ids=array_merge([$id], $model->descendants()->pluck('id')->toArray());
                            $query->whereNotIn('id',$not_in_ids);
                        }
                    })
                ];
            }
        }

        return $rules;
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
                'parent_id' => $this->getCategories($not_in_ids)
            ]
        ];
    }
}