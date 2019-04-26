<?php

namespace Appnegar\Cms\Traits;
use Illuminate\Http\Request;
use App\Comment;

trait AdminComment
{
    public function indexComment()
    {
        $actions = getActions(session('department'), $this->resource);
        $lang_resource = $lang_resource=$this->getTrans('Comment');
        $model_name = '\\App\\Comment';
        $fields = $model_name::getFields();
        return ['actions' => $actions, 'lang_resource' => $lang_resource, 'fields' => $fields];
    }
    public function CommentsListView ()
    {
        $models = $this->getData(['archive'=>0,'commentable_type'=>"App\\".$this->resource,'lang'=>session('lang')],'Comment');
        $this->filterModels($models);

        return $models;
    }

    public function showComment($id)
    {
        $model=Comment::findOrFail($id);
        $author=$model->author()->select('name','email')->first();
        $model = $model->toArray();
        if($author){
            $model['name']=$author->name;
            $model['email']=$author->email;
        }

        return response()->json(['model'=>$model]);
    }

    public function editComment(Request $request,$id)
    {
        if ($request->isMethod('get')) {
            $comment = Comment::findOrFail($id);
            $author=$comment->author()->select('name','email')->first();
            $comment = $comment->toArray();
            if($author){
                $comment['name']=$author->name;
                $comment['email']=$author->email;
            }


            return response()
                ->json([
                    'model' => $comment,
                    'options' => [],
                ]);
        } elseif ($request->isMethod('put')) {
            $this->validate($request,[
                'content'=>'required',
                'status'=>'required|numeric:min,0',
                'archive'=>'required|numeric:min,0',
                'like'=>'required|numeric:min,0',
                'dis_like'=>'required|numeric:min,0',
            ]);

            $comment = Comment::findOrFail($id);
            $class_name=class_basename($comment->commentable()->first());
            if($class_name == $this->resource){
                $comment->content=$request->input('content');
                $comment->status=$request->input('status');
                $comment->archive=$request->input('archive');
                $comment->like=$request->input('like');
                $comment->dis_like=$request->input('dis_like');
                $comment->save();

                return response()->json([
                    'message' => 'نظر با موفقیت بروزرسانی شد'
                ]);
            }
            else{
                return response()->json([
                    'message' => 'شما اجازه ویرایش این نظر را ندارید'
                ], 442);
            }
        }
        return response()->json([
            'message' => 'method not allow'
        ], 442);
    }

    public function destroyComment($id)
    {
        $ids = explode(',', $id);
        $message = "";
        $delete_status = true;
        foreach ($ids as $id){
            $comment=Comment::findOrFail($id);
            $class_name=class_basename($comment->commentable()->first());
            if($class_name == $this->resource){
                $comment->delete();
            }
            else{
                $delete_status = false;
                $message .= "<br>" . " شما اجازه حذف نظر با شناسه ".$comment->id." را ندارید";
            }
        }
        if ($delete_status == false) {
            return response()->json([
                'message' => $message
            ], 442);
        }
        return response()->json([
            'success' => 'نظرات با موفقیت حذف شد'
        ]);
    }
}