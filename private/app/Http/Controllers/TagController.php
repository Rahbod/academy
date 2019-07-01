<?php
/**
 * Created by PhpStorm.
 * User: mujtaba
 * Date: 6/30/2019
 * Time: 6:28 PM
 */

namespace App\Http\Controllers;


use App\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TagController
{
    public function show(Request $request, $resource = 'content', $id)
    {
        $tag = Tag::findOrFail($id);
        $model_name = ucfirst($resource);
        $model = 'App\\' . $model_name;

        $contents = $model::where('status', 1)
            ->where(function ($query) {
                $query->where('published_at', null)->orWhere('published_at', '<=', Carbon::now());
            })->where('lang', session('lang'))
            ->whereHas('tags', function ($query) use ($tag) {
                $query->where('id', $tag->id);
            })->with('tags')->paginate(1);
//        dd($contents);

        return view('main_template.pages.search')
            ->with('contents', $contents)
            ->with('model_name', $model_name)
            ->with('tag', $tag);
    }

}