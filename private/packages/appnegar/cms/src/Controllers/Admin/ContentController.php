<?php
namespace Appnegar\Cms\Controllers\Admin;

use App\Gallery;
use App\Tag;
use Appnegar\Cms\Controllers\AdminController;
use Appnegar\Cms\Traits\AdminComment;
use Appnegar\Cms\Traits\AdminFileManager;
use Appnegar\Cms\Traits\AdminSettingTrait;

class ContentController extends AdminController{
    use AdminComment;
    use AdminFileManager;
    use AdminSettingTrait;

    public function __construct(){
        $this->resource='Content';
        $config=config('system.content');
        $this->config=[
            'content'=>[
                'logo' => [
                    'size' => $config['logo_size'],
                    'width' => $config['logo_width'],
                    'height' => $config['logo_height'],
                    'extension' => $config['logo_extension'],
                    'destination' => $config['logo_destination'],
                ],
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
            'category_id'=>'required|exists:categories,id',
            'type'=>'required|in:article,news',
            'tag_id'=>'nullable|array',
            'title'=>'required',
            'summary'=>'nullable',
            'logo'=>'nullable|image|max:'.$this->config['content']['logo']['size'] . '|mimes:' . trimArrayString($this->config['content']['logo']['extension']),
            'image'=>'nullable|image|max:'.$this->config['content']['image']['size'] . '|mimes:' . trimArrayString($this->config['content']['image']['extension']),
            'text'=>'required',
            'source'=>'nullable',
            'order'=>'nullable|numeric|min:1',
            'source_link'=>'nullable',
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
                'category_id'=>$this->getCategories([],'Category',['news','article']),
                'tag_id'=>Tag::select('id','name as text')->get()
            ]
        ];
    }
}