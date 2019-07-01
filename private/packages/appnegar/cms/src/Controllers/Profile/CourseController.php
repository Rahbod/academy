<?php
namespace Appnegar\Cms\Controllers\Profile;

use App\Tag;
use Appnegar\Cms\Controllers\AdminController;
use Appnegar\Cms\Traits\AdminComment;
use Appnegar\Cms\Traits\AdminFileManager;
use Appnegar\Cms\Traits\AdminSettingTrait;

class CourseController extends AdminController{
//    use AdminComment;
//    use AdminFileManager;
//    use AdminSettingTrait;

    public function __construct(){
        $this->resource='UserClass';
    }

    public function index():array
    {
        $actions = getActions(session('department'), 'Course');
        $fields = $this->getFields();
        $lang_resource = $this->getTrans(null,$fields);
        return ['actions' => $actions, 'lang_resource' => $lang_resource, 'fields' => $fields];
    }

    public function myClassrooms()
    {
        $user=session('user_info');
        $conditions=[
            'user_id'=>$user['id'],
        ];
        return $this->getTableData($conditions);
    }

    public function show($id)
    {
        $model_name = "App\\" . $this->resource;
        $model = $model_name::with('classroom')->findOrFail($id);

        $data = json_encode($model->toArray());
        $data = json_decode($data);
        if(isset($data->avatar)){
            $avatar=url($data->avatar);
            $data->avatar="<img src='$avatar'/>";
        }
        if(isset($model->image)){
            $image=url($data->image);
            $model->image="<img src='$image'/>";
        }
        if(isset($data->logo)){
            $logo=url($data->logo);
            $data->logo="<img src='$logo'/>";
        }
        if(isset($data->user_id)){
            $data->user_id=$model->user->username;
        }
        if(isset($data->author_id)){
            $data->author_id=$model->author->username;
        }
        if(isset($data->category_id)){
            $data->category_id=$model->category->name;
        }
        $data=$this->filterModel($data);

        return response()->json(['model' => $data]);
    }

    protected function getTableData($conditions){
        $models = $this->getData($conditions);
        $this->filterModels($models);
        return $models;
    }

    protected function getFields(): array
    {
        $model_name = '\\App\\' . $this->resource;
        $fields = $model_name::getFields();
        $unset_relations=['user'];
        $temp_fields=[];
        foreach ($fields as $index=>$field){
            if($field['name'] === $this->getResourceName()){
                $fields[$index]=$this->getMainFields($fields[$index]);
            }
            if(!in_array($field['name'], $unset_relations, true)){
                $temp_fields[]=$fields[$index];
            }
        }

        return $temp_fields;
    }

    protected function getMainFields($field){
        foreach ($field['items'] as $index=>$item){
            switch ($item['name']){
                case 'user_id':{
                    $field['items'][$index]['searchable']=false;
                }
            }
        }
        return $field;
    }
}