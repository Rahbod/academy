<?php
namespace Appnegar\Cms\Controllers\Profile;


use Appnegar\Cms\Controllers\AdminController;

class TranslateRequestController extends AdminController{

    public function __construct(){
        $this->resource='TranslateRequest';
        $attachment_config=config('system.attachment');
        $translate_config=config('system.translate_request');
        $this->config=[
            'attachment'=>[
                'source' => [
                    'size' => $attachment_config['attachment_size'],
                    'extension' => $attachment_config['attachment_extension'],
                    'destination' => $attachment_config['attachment_destination'],
                ],
            ],
            'translate_request'=>[
                'translated_file' => [
                    'size' => $translate_config['translated_file_size'],
                    'extension' => $translate_config['translated_file_extension'],
                    'destination' => $translate_config['translated_file_destination'],
                ],
            ]
        ];
    }

    public function index():array
    {
        $actions = getActions(session('department'), $this->resource);
        $fields = $this->getFields();
        $lang_resource = $this->getTrans(null,$fields);
        return ['actions' => $actions, 'lang_resource' => $lang_resource, 'fields' => $fields];
    }

    protected function getTableData($conditions){
        $models = $this->getData($conditions);
        $this->filterModels($models);
        return $models;
    }

    public function unverifiedRequests()
    {
        $user=session('user_info');
        $conditions=[
            'author_id'=>$user['id'],
            'status'=>'PENDING',
        ];
        return $this->getTableData($conditions);
    }
    public function rejectedRequests()
    {
        $user=session('user_info');
        $conditions=[
            'author_id'=>$user['id'],
            'status'=>'REJECTED',
        ];
        return $this->getTableData($conditions);
    }
    public function awaitingPaymentRequests()
    {
        $user=session('user_info');
        $conditions=[
            'author_id'=>$user['id'],
            'status'=>'AWAITING_PAYMENT',
        ];
        return $this->getTableData($conditions);
    }
    public function paidRequests()
    {
        $user=session('user_info');
        $conditions=[
            'author_id'=>$user['id'],
            'status'=>'PAID',
        ];
        return $this->getTableData($conditions);
    }
    public function translatedRequests()
    {
        $user=session('user_info');
        $conditions=[
            'author_id'=>$user['id'],
            'status'=>'TRANSLATED',
        ];
        return $this->getTableData($conditions);
    }

    public function show($id)
    {
        $model_name = "App\\" . $this->resource;
        $model = $model_name::with('transaction')->with(['attachments'=>function ($query){
            $query->select(['id','attachmentable_id','attachmentable_type','source','title']);
        }])->findOrFail($id);

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
        if(isset($data->translated_file) and  $data->translated_file!== null){
            $data->translated_file="<a href='{$data->translated_file}'>download</a>";
        }
        $data=$this->filterModel($data);

        return response()->json(['model' => $data]);
    }

    protected function validationRules($request, $id = null)
    {
        return[
            'category_id'=>'required',
            'title'=>'required',
            'translation_language'=>'required',
            'description'=>'nullable',
            'attachment.*.source'=>'nullable|file|max:'.$this->config['attachment']['source']['size'] . '|mimes:' . trimArrayString($this->config['attachment']['source']['extension']),
        ];
    }

    protected function setRequest($request, $model)
    {
        if (!$request['lang']) {
            $request['lang'] = session('lang');
        }

        $request['translated_file']=null;
        $request['status']='PENDING';
        $request['price']=null;
        $request['author_id']=session('user_info')['id'];

        return $request;
    }

    protected function getFormData($data)
    {
        return [
            'model' => $data,
            'options' => [
                'category_id'=>$this->getCategories([],'Category',['translate']),
            ],
        ];
    }

    protected function getFields(){
        $model_name = '\\App\\' . $this->resource;
        $fields = $model_name::getFields();
        $unset_relations=['author','transaction'];
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
                case 'price':
                case 'translated_file':
                case 'status':
                {
                    $field['items'][$index]['input_type']='hidden';
                    break;
                }
                case 'author_id':{
                    $field['items'][$index]['searchable']=false;
                }
            }
        }
        return $field;
    }
}