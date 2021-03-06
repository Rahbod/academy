<?php
namespace Appnegar\Cms\Controllers\Admin;

use App\Tag;
use Appnegar\Cms\Controllers\AdminController;
use Appnegar\Cms\Traits\AdminComment;
use Appnegar\Cms\Traits\AdminFileManager;
use Appnegar\Cms\Traits\AdminSettingTrait;

class CourseController extends AdminController{
    use AdminComment;
    use AdminFileManager;
    use AdminSettingTrait;

    public function __construct(){
        $this->resource='Course';
        $config=config('system.course');
        $this->config=[
            'course'=>[
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
//
//    protected function getTableConditions(){
//        return ['lang'=>session('lang')];
//    }
//    protected function getOrderScopes()
//    {
//        return ['lang'];
//    }

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
            'tag_id'=>'nullable|array',
            'title_fa'=>'required',
            'title_en'=>'required',
            'image'=>'required|image|max:'.$this->config['course']['image']['size'] . '|mimes:' . trimArrayString($this->config['course']['image']['extension']),
            'description_fa'=>'nullable',
            'description_en'=>'nullable',
            'duration'=>'required',
            'order'=>'nullable|numeric|min:1',
            'status'=>'nullable|numeric|min:0|max:1'
        ];
        if($id !== null){
            $rules['image']='nullable|image|max:'.$this->config['course']['image']['size'] . '|mimes:' . trimArrayString($this->config['course']['image']['extension']);
        }
        return $rules;
    }

    protected function getFormData($data)
    {
        return[
            'model'=>$data,
            'options'=>[
                'category_id'=>$this->getCategories([],'Category',['course']),
                'tag_id'=>Tag::select('id','name as text')->get()
            ]
        ];
    }
}