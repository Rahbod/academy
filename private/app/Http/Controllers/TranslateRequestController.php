<?php

namespace App\Http\Controllers;

use App\Attachment;
use App\Category;
use App\TranslateRequest;
use Illuminate\Http\Request;
use Appnegar\Cms\Traits\AdminFileEditor;

class TranslateRequestController extends Controller
{
    use AdminFileEditor;
    protected $config;
    protected $resource;

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

    public function index()
    {
        return $this->viewPage('translate');
    }

    public function editing()
    {
        return $this->viewPage('editing');
    }

    public function consultation()
    {
        return $this->viewPage('consultation');
    }

    public function viewPage($type)
    {
        if(!\Auth::check()) {
            session(['redirect' => url(session('lang') . "/{$type}-request")]);
            return redirect(session('lang') . '/login');
        }

        $categories=Category::where('lang',session('lang'))->where('type','translate')->get();
//        dd($categories);
        return view('main_template.pages.translation')->with('categories',$categories)->with('type', $type);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'category_id'=>'required|exists:categories,id',
            'title'=>'required',
            'type'=>'required',
            'source_language'=>'required',
            'translation_language'=>'required',
            'description'=>'nullable',
            'file.*'=>'required|file|max:'.$this->config['attachment']['source']['size'] . '|mimes:' . trimArrayString($this->config['attachment']['source']['extension']),
        ]);

        if($request->source_language == $request->translation_language)
            return response()->json(['message'=>trans('messages.global.translation_language_invalid')],401);

        if(\Auth::check()){
            $user=  \Auth::user();

            $model=new TranslateRequest();
            $model->author_id=$user->id;
            $model->category_id=$request->category_id;
            $model->type=$request->type;
            $model->title=$request->title;
            $model->source_language=$request->source_language;
            $model->translation_language=$request->translation_language;
            $model->status='PENDING';
            $status=$model->save();

            if ($request->hasFile('file')) {
                $files=$request->file('file');
//dd($files);
                foreach ($files as $file){
                    $result=$this->saveFile($file,$this->config['attachment']['source'],'attachment');
                    if($result['status']){
                        $attachment=new Attachment();
                        $attachment->user_id=$user->id;
                        $attachment->title=$result['data'];
                        $attachment->source=$result['data'];
                        $attachment->attachmentable_type='App\\'.$this->resource;
                        $attachment->attachmentable_id=$model->id;
                        $attachment->save();

                    }else{
                        dd($result);
                    }
                }
            }else{
                dd($request->all());
            }

           return $this->getResponseMessage($status,$this->resource,'create');
        }

        return response()->json(['message'=>'unauthenticated!'],401);
//        dd($request->all());
    }

    protected function getResponseMessage($status, $resource, $action, $message = null, $json_response = true)
    {
        $default_massage = $this->getMessage($status, $resource, $action);
        if ($message !== null) {
            $message = "<p>" . $default_massage . "</p>" . $message;
        } else {
            $message = $default_massage;
        }
        $status_code = $status ? 200 : 442;
        if ($json_response) {
            return response()->json([
                'message' => $message
            ], $status_code);
        }

        return ['message' => trans($message), 'status' => $status];
    }

    protected function getMessage($status, $resource, $action)
    {
        $resource_name = $this->getResourceName($resource);
        $resource = __($resource_name . '.title');
        $action = __('main.actions.' . strtolower($action));
        if ($status) {
            $message = __('main.messages.action_success', ['resource' => $resource, 'action' => $action]);

        } else {
            $message = __('main.messages.action_error', ['resource' => $resource, 'action' => $action]);
        }
        return $message;
    }

    protected function getResourceName($resource, $singular = false)
    {
        $resource_name = ltrim(strtolower(preg_replace('/[A-Z]([A-Z](?![a-z]))*/', '_$0', $resource)), '_');
        if ($singular == false) {
            $resource_name = str_plural($resource_name);
        }
        return $resource_name;
    }
}
