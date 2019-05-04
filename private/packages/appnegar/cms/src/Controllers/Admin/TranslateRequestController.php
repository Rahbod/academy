<?php
namespace Appnegar\Cms\Controllers\ContentManagement;


use Appnegar\Cms\Controllers\AdminController;

class TranslateRequestController extends AdminController{

    public function __construct(){
        $this->resource='TranslateRequest';
        $config=config('system.attachment');
        $this->config=[
            'attachment'=>[
                'source' => [
                    'size' => $config['attachment_size'],
                    'extension' => $config['attachment_extension'],
                    'destination' => $config['attachment_destination'],
                ],
            ]
        ];
    }

    protected function validationRules($request, $id = null)
    {
        return[
            'category_id'=>'required',
            'title'=>'required',
            'translation_language'=>'required',
            'description'=>'required',
            'status'=>'required',
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