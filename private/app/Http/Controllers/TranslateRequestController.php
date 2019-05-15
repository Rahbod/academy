<?php

namespace App\Http\Controllers;

use App\Attachment;
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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('main_template.pages.translation');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'category_id'=>'required|exists:categories,id',
            'title'=>'required',
            'source_language'=>'required',
            'translation_language'=>'required',
            'description'=>'nullable',
            'files'=>'required'
        ]);

        if(\Auth::check()){
            $user=  \Auth::user();

            $model=new TranslateRequest();
            $model->author_id=$user->id;
            $model->category_id=$request->category_id;
            $model->title=$request->title;
            $model->source_language=$request->source_language;
            $model->translation_language=$request->translation_language;
            $model->status='PENDING';
            $status=$model->save();

            if ($request->hasFile('file')) {
                $files=$request->file('file');
                foreach ($files as $file){
                    $result=$this->saveFile($file,$this->config['attachment'],'attachment');
                    if($result['status']){
                        $attachment=new Attachment();
                        $attachment->user_id=$user->id;
                        $attachment->title=$result['data'];
                        $attachment->source=$result['data'];
                        $attachment->attachmentable_type='App\\'.$this->resource;
                        $attachment->attachmentable_id=$model->id;
                        $attachment->save();

                    }
                }
            }

           return $this->getResponseMessage($status,$this->resource,'create');
        }

        return response()->json(['message'=>'unauthenticated!'],401);
//        dd($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
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

        return ['message' => $message, 'status' => $status];
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
}
