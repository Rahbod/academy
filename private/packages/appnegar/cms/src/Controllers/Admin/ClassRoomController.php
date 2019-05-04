<?php
namespace Appnegar\Cms\Controllers\ContentManagement;

use App\Course;
use App\Tag;
use App\User;
use Appnegar\Cms\Controllers\AdminController;
use Appnegar\Cms\Traits\AdminComment;
use Appnegar\Cms\Traits\AdminFileManager;
use Appnegar\Cms\Traits\AdminSettingTrait;

class ClassRoomController extends AdminController{
    use AdminComment;
    use AdminFileManager;
    use AdminSettingTrait;

    public function __construct(){
        $this->resource='ClassRoom';
        $config=config('system.class_room');
        $this->config=[
            'class_room'=>[
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
            'teacher_id'=>'required|exists:users,id',
            'course_id'=>'required|exists:courses,id',
            'title_fa'=>'required',
           'image'=>'nullable|image|max:'.$this->config['class_room']['image']['size'] . '|mimes:' . trimArrayString($this->config['class_room']['image']['extension']),
            'capacity'=>'nullable|numeric|min:1',
            'price'=>'nullable|numeric|min:1',
            'order'=>'nullable|numeric|min:1',
            'status'=>'nullable|numeric|min:0|max:1',
            'registration_start_date'=>'required',
            'registration_end_date'=>'required',
            'course_start_date'=>'required',
            'course_end_date'=>'required',
        ];
        return $rules;
    }

    protected function getFormData($data)
    {
        return[
            'model'=>$data,
            'options'=>[
                'course_id'=>Course::where('lang',session('lang'))->select('id','title AS text')->get(),
                'teacher_id'=>User::where('type','teacher')->select('id','name AS text')->get(),
                'tag_id'=>Tag::select('id','name as text')->get()
            ]
        ];
    }
}