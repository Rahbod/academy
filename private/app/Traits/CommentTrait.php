<?php namespace App\Traits;

use App\Comment;

trait commentTrait
{
    public function getComments($id, $type)
    {
        return Comment::where('lang', session('lang'))->whereStatus(1)->where('commentable_id', $id)->where('commentable_type', $type)->get()->toArray();
    }

    public function storeComment($request)
    {

        $data = $request->validate([
            'commentable_id' => 'required',
            'commentable_type' => 'required',
            'name' => 'required|max:255',
            'email' => 'required|email',
            'content' => 'required|max:500',
        ]);

        $comment = new Comment();
        $comment->like = 0;
        $comment->status = 0;
        $comment->archive = 0;
        $comment->lang = session('lang');
        $comment->dis_like = 0;
        $comment->author_id = null;
        $comment->parent_id = null;
        $comment->email = $data['email'];
        $comment->name = $data['name'];
        $comment->content = $data['content'];
        $comment->commentable_id = (int)$data['commentable_id'];
        $comment->commentable_type = $data['commentable_type'];
        $comment->save();

        if ($comment) {
            return true;
        }
        return false;

    }

    public function storeCommentLike($request)
    {
        $request->validate([
            'id' => 'required',
            'type' => 'required'
        ]);
        $id = $request->id;
        $comment = Comment::findOrFail($id);

        if ($comment) {
            $comment->increment($request->type);
            return $comment;
        }
        return false;
    }
}