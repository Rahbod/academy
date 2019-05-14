<?php
namespace Appnegar\Cms\Controllers\Admin;

use App\Course;
use App\Tag;
use App\Term;
use App\User;
use Appnegar\Cms\Controllers\AdminController;
use Appnegar\Cms\Traits\AdminComment;

class TermController extends AdminController{
    use AdminComment;

    public function __construct(){
        $this->resource='Term';
    }

    protected function getTableConditions(){
//        return ['lang'=>session('lang')];
    }

    protected function getOrderScopes()
    {
        return ['course_id'];
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
            'course_id'=>'required|exists:courses,id',
            'title_fa'=>'required',
            'order'=>'nullable|numeric|min:1',
            'status'=>'nullable|numeric|min:0|max:1',
        ];
        return $rules;
    }

    protected function getFormData($data)
    {
        return[
            'model'=>$data,
            'options'=>[
                'course_id'=>Course::select('id','title_fa AS text')->get(),
                'teacher_id'=>User::where('type','teacher')->select('id','name AS text')->get(),
                'tag_id'=>Tag::select('id','name as text')->get()
            ]
        ];
    }
}