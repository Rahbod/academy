<?php
namespace Appnegar\Cms\Controllers\Admin;


use Appnegar\Cms\Controllers\AdminController;
use Appnegar\Cms\Traits\AdminFileManager;
use Appnegar\Cms\Traits\AdminSettingTrait;
use Illuminate\Http\Request;

class AttachmentController extends AdminController{
    use AdminFileManager;
    use AdminSettingTrait;

    public function __construct(){
        $this->resource='Attachment';
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
        $model=$request->attachmentable_type;
        return[
            'id'=>'required',
            'title'=>'nullable',
            'source'=>'nullable|file|max:'.$this->config['attachment']['source']['size'] . '|mimes:' . trimArrayString($this->config['attachment']['source']['extension']),
            'attachmentable_type'=>'required',
            'attachmentable_id'=>'required|exists:'.$model::getTableName().',id',
        ];
    }

    /**
     * @param array $data
     * @return array
     * @internal param null $model
     */
    protected function getFormData($data)
    {
        $attachmentable_id=[];
        if(isset($data['attachmentable_type'])){
            $model=$data['attachmentable_type'];

            $attachmentable_id=$model::select(['id','title AS text'])->get();
        }
        return [
            'model' => $data,
            'options' => [
                'attachmentable_id'=>$attachmentable_id
            ],
        ];
    }

    public function changeAttachmentableType(Request $request)
    {
        $result=[];
        if($request->attachmentable_type){
            $model=$request->attachmentable_type;

            $result=$model::select(['id','title AS text'])->get();
        }

        return $result;
    }

}