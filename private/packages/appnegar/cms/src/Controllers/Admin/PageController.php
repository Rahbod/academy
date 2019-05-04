<?php
namespace Appnegar\Cms\Controllers\Admin;

use App\Gallery;
use App\Tag;
use Appnegar\Cms\Controllers\AdminController;
use Appnegar\Cms\Traits\AdminComment;
use Appnegar\Cms\Traits\AdminFileManager;
use Appnegar\Cms\Traits\AdminSettingTrait;

class PageController extends AdminController{
    use AdminComment;
    use AdminFileManager;
    use AdminSettingTrait;

    public function __construct(){
        $this->resource='Page';
        $config=config('system.page');
        $this->config=[
            'page'=>[
                'image' => [
                    'size' => $config['image_size'],
                    'width' => $config['image_width'],
                    'height' => $config['image_height'],
                    'extension' => $config['image_extension'],
                    'destination' => $config['image_destination'],
                ],
            ]
        ];
    }

    protected function getTableConditions(){
        return ['lang'=>session('lang')];
    }
    protected function getOrderScopes()
    {
        return ['lang'];
    }

    protected function setModel($model)
    {
        $model->tag_id=$model->tags()->pluck('id');
        if($model->author_id !== null){
            $model->author_id=$model->author->name;
        }
        return $model;
    }

    protected function validationRules($request, $id = null)
    {
        $rules=[
            'tag_id'=>'nullable|array',
            'title'=>'required',
            'summary'=>'nullable',
            'image'=>'nullable|image|max:'.$this->config['page']['image']['size'] . '|mimes:' . trimArrayString($this->config['page']['image']['extension']),
            'text'=>'required',
            'order'=>'nullable|numeric|min:1',
            'show_count'=>'nullable|numeric|min:1',
            'status'=>'nullable|numeric|min:0|max:1'
        ];
        return $rules;
    }

    protected function getFormData($data)
    {
        return[
            'model'=>$data,
            'options'=>[
                'tag_id'=>Tag::select('id','name as text')->get()
            ]
        ];
    }
}