<?php

namespace App\Repositories;

use App\Content;
use App\Repositories\Interfaces\HomeInterface;
use Illuminate\Database\Eloquent\Model;

class HomeRepository implements HomeInterface
{
    // model property on class instances
    protected $model;

    // Constructor to bind model to repo
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

//    public function find($id)
//    {
//        return $this->model->find($id);
//    }
//
//    public function repoGallery()
//    {
//        return $this->model->where('lang',session('lang'))->where('is_news', 1)->whereStatus(1)->orderByDesc('updated_at')->take(5)->get();
//    }
//
//    public function repoFilms()
//    {
//        return $this->model->where('lang',session('lang'))->where('is_news', 0)->whereStatus(1)->orderByDesc('show_count')->take(5)->get();
//    }
//
//    public function repoSpeeches()
//    {
//        return $this->model->where('lang',session('lang'))->where('category_id', 1)->where('status', 1)->orderByDesc('updated_at')->take(5)->get();
//    }

    public function repoLastNews()
    {
        return $this->model->where('lang',session('lang'))->where('is_news', 1)->where('status', 1)->orderByDesc('created_at')->take(5)->get();
    }
    public function repoMostViewed()
    {
        return $this->model->where('lang',session('lang'))->where('is_news', 1)->where('status', 1)->orderByDesc('show_count')->take(5)->get();
    }
    public function repoBayanyeha()
    {
        return $this->model->where('lang',session('lang'))->where('category_id', 1)->where('status', 1)->orderByDesc('created_at')->take(5)->get();
    }

}
