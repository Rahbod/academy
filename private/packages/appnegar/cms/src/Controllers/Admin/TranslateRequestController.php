<?php
namespace Appnegar\Cms\Controllers\Admin;


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



    public function show($id)
    {
        $model_name = "App\\" . $this->resource;
        $model = $model_name::with('transaction')->with(['attachments'=>function ($query){
            $query->select(['id','attachmentable_id','attachmentable_type','source','title']);
        }])->findOrFail($id);
//        dd($model->toArray());

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

    protected function validationRules($request, $id = null)
    {
        return[
            'category_id'=>'required',
            'title'=>'required',
            'translation_language'=>'required',
            'description'=>'nullable',
            'translated_file'=>'nullable|file|max:'.$this->config['translate_request']['translated_file']['size'] . '|mimes:' . trimArrayString($this->config['translate_request']['translated_file']['extension']),
            'status'=>'required|in:PENDING,REJECTED,AWAITING_PAYMENT,PAID,TRANSLATED',
            'attachment.*.source'=>'nullable|file|max:'.$this->config['attachment']['source']['size'] . '|mimes:' . trimArrayString($this->config['attachment']['source']['extension']),
        ];
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

}