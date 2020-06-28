<?php
namespace Appnegar\Cms\Controllers\Admin;

use App\Course;
use App\Tag;
use App\Term;
use App\User;
use Appnegar\Cms\Controllers\AdminController;
use Appnegar\Cms\Traits\AdminComment;
use Appnegar\Cms\Traits\AdminFileManager;
use Appnegar\Cms\Traits\AdminSettingTrait;
use Illuminate\Http\Request;

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
//        return ['lang'=>session('lang')];
    }

    protected function setModel($model)
    {
        $model->tag_id=$model->tags()->pluck('id');
        if($model->author_id !== null){
            $model->author_id=$model->author->name;
        }
        return $model;
    }

    protected function getOrderScopes()
    {
        return ['term_id'];
    }

    protected function validationRules($request, $id = null)
    {
        $rules=[
            'teacher_id'=>'required|exists:users,id',
            'term_id'=>'required|exists:terms,id',
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
        if($id !== null){
            $rules['image']='required|image|max:'.$this->config['class_room']['image']['size'] . '|mimes:' . trimArrayString($this->config['class_room']['image']['extension']);
        }
        return $rules;
    }

    protected function getFormData($data)
    {
        $terms=[];
        if(!in_array($data['id'],[null,'',0])){
            $current_term=Term::findOrFail($data['term_id']);
            $data['course_id']=$current_term['course_id'];
            $terms=Term::where('course_id',$current_term['course_id'])->select('id','title_fa AS text')->get();
        }
        return[
            'model'=>$data,
            'options'=>[
                'course_id'=>Course::select('id','title_fa as text')->get(),
                'term_id'=>$terms,
                'teacher_id'=>User::where('type','teacher')->select('id','name AS text')->get(),
                'tag_id'=>Tag::select('id','name as text')->get()
            ]
        ];
    }
    public function changeCourse(Request $request){
        $this->validate($request,[
            'course_id'=>'required|exists:courses,id'
        ]);
        $terms=Term::where('course_id',$request->course_id)->select('id','title_fa AS text')->get();
    }
}