<?php
namespace Appnegar\Cms\Controllers\Admin;

use App\Page;
use App\StaticMenu;
use Appnegar\Cms\Controllers\AdminController;
use Illuminate\Validation\Rule;

class StaticMenuController extends AdminController{

    public function __construct(){
        $this->resource='StaticMenu';
    }

    protected function getTableConditions(){
        return ['lang'=>session('lang')];
    }

    protected function getOrderScopes(){
        return ['lang','parent_id'];
    }

    protected function setRequest($request,$model){
        if (!$request['lang']){
            $request['lang']=session('lang');
        }
        if($request['id'] == 0){
            $user = session('user_info_' . session('department'));
            $request['author_id']=$user['id'];
        }else{
            $request['author_id']=$model['author_id'];
        }
        if($request['has_content']==0){
            $request['type']=null;
            $request['page_id']=null;
            $request['link']=null;
        }elseif ($request['has_content']==0){
            if($request['type'] == 'page'){
                $request['link']=null;
            }else if (in_array($request['type'],['action','link'])){
                $request['page_id']=null;
            }
        }

        return $request;
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
            'has_content' => 'numeric|between:0,1|required',
            'type' => 'nullable|in:action,page,link',
            'page_id' => 'nullable|exists:pages,id',
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
        $form_date=[
            'model'=>$data,
            'options'=>[
                'parent_id' => StaticMenu::whereNotIn('id',$not_in_ids)->select(['id','name As text'])->get(),
                'page_id' => Page::select(['id','title As text'])->get(),
                'link'=>\Config::get('actions')
            ]
        ];

        if(isset($data['has_content']) && $data['has_content'] === 1){
            $info=StaticMenu::getFormFields();
            $type_index=$this->getSubFormIndex($info , 'type');
            if($type_index){
                $info[$type_index]['type']='select';
            }
//            dd($data);
            if($data['type'] === 'page'){
                $page_id_index=$this->getSubFormIndex($info , 'page_id');
                if($page_id_index){
                    $info[$page_id_index]['type']='select';
                }
            }elseif($data['type'] === 'action' || $data['type'] === 'link'){
                $link_index=$this->getSubFormIndex($info , 'link');
                if($data['type'] === 'action'){
                    $info[$link_index]['type']='select';
                }
                if($data['type'] === 'link'){
                    $info[$link_index]['type']='text';
                }
            }
            $form_date['info']=$info;
//            dd($type_index);

        }

        return $form_date;
    }

    protected function getSubFormIndex($info,$name){
        foreach ($info as $key=>$value){
            if($value['name'] == $name){
                return $key;
            }
        }
        return null;
    }



}