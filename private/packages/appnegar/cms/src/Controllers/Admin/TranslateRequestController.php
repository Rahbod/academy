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