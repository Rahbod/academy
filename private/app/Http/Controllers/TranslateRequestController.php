<?php

namespace App\Http\Controllers;

use App\TranslateRequest;
use Illuminate\Http\Request;

class TranslateRequestController extends Controller
{
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
            $model->save();

            if ($request->hasFile('file')) {
                $files=$request->file('file');
                foreach ($files as $file){
//                    store attachment model
                }
            }
        }


        dd($request->all());
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
}
