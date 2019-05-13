@extends('main_template.master_page.master')

@push('styles')

@endpush

@section('content')
    <section class="searchPage">
        <div class="dlab-bnr-inr overlay-black-middle">
            <div class="container">
                <div class="dlab-bnr-inr-entry">
                    <h1 class="text-white">Translation</h1>
                    <!-- Breadcrumb row -->
                    <div class="breadcrumb-row">
                        <ul class="list-inline">
                            <li><a href="#">Home</a></li>
                            <li>Translation</li>
                        </ul>
                    </div>
                    <!-- Breadcrumb row END -->
                </div>
            </div>
        </div>
        <div class="content-inner-2">
            <div class="container">
                <div class="section-head text-black text-center m-b20">
                    <h2 class="m-b10">Search</h2>
                    <p>
                        you searched for : <span class="text-danger"><b>{{$search_for}}</b></span>
                    </p>
                </div>

                <ul class="nav nav-pills mb-5 justify-content-center" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="pills-news-tab" data-toggle="pill" href="#pills-news" role="tab"
                           aria-controls="pills-news" aria-selected="true">News</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-article-tab" data-toggle="pill" href="#pills-article" role="tab"
                           aria-controls="pills-article" aria-selected="false">Article</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-course-tab" data-toggle="pill" href="#pills-course" role="tab"
                           aria-controls="pills-course" aria-selected="false">Course</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-translation-tab" data-toggle="pill" href="#pills-translation"
                           role="tab"
                           aria-controls="pills-translation" aria-selected="false">Translation</a>
                    </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-news" role="tabpanel"
                         aria-labelledby="pills-news-tab">
                        <div class="container">
                            <div class="row">
                                @if(isset($news))
                                    @foreach($news as $news_item)
                                        <div class="post card-container col-lg-4 col-md-6 col-sm-6">
                                            <div class="blog-post blog-grid blog-style-1">
                                                <div class="dlab-post-media dlab-img-effect radius-sm">
                                                    <a title="{{$news_item['title']}}"
                                                       href="{{url(session('lang').'/'.$news_item['type'].'/'.$news_item['id'].'/'.str_replace(' ','-',$news_item['title']))}}">
                                                        <img src="{{$news_item['logo']}}" alt="{{$news_item['title']}}">
                                                    </a>
                                                </div>
                                                <div class="dlab-info">
                                                    <div class="dlab-post-meta">
                                                        <ul class="d-flex align-items-center">
                                                            <li class="post-date">{{$news_item['created_at']}}</li>
                                                            <li class="post-comment">{{$news_item['show_count']}}</li>
                                                        </ul>
                                                    </div>
                                                    <div class="dlab-post-title ">
                                                        <h5 class="post-title font-20">
                                                            <a title="{{$news_item['title']}}"
                                                               href="{{url(session('lang').'/'.$news_item['type'].'/'.$news_item['id'].'/'.str_replace(' ','-',$news_item['title']))}}">
                                                                {{$news_item['title']}}
                                                            </a>
                                                        </h5>
                                                    </div>
                                                    <div class="dlab-post-readmore blog-share">
                                                        <a title="{{$news_item['title']}}"
                                                           class="site-button-link border-link black"
                                                           href="{{url(session('lang').'/'.$news_item['type'].'/'.$news_item['id'].'/'.str_replace(' ','-',$news_item['title']))}}">
                                                            READ MORE
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="col-12">
                                        <div class="alert alert-info text-center rounded" role="alert">
                                            <b>no result !</b>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-article" role="tabpanel" aria-labelledby="pills-article-tab">
                        <div class="container">
                            <div class="row">
                                @if(isset($articles))
                                    @foreach($articles as $article)
                                        <div class="post card-container col-lg-4 col-md-6 col-sm-6">
                                            <div class="blog-post blog-grid blog-style-1">
                                                <div class="dlab-post-media dlab-img-effect radius-sm">
                                                    <a title="{{$article['title']}}"
                                                       href="{{url(session('lang').'/'.$article['type'].'/'.$article['id'].'/'.str_replace(' ','-',$article['title']))}}">
                                                        <img src="{{$article['logo']}}" alt="{{$article['title']}}">
                                                    </a>
                                                </div>
                                                <div class="dlab-info">
                                                    <div class="dlab-post-meta">
                                                        <ul class="d-flex align-items-center">
                                                            <li class="post-date">{{$article['created_at']}}</li>
                                                            <li class="post-comment">{{$article['show_count']}}</li>
                                                        </ul>
                                                    </div>
                                                    <div class="dlab-post-title ">
                                                        <h5 class="post-title font-20">
                                                            <a title="{{$article['title']}}"
                                                               href="{{url(session('lang').'/'.$article['type'].'/'.$article['id'].'/'.str_replace(' ','-',$article['title']))}}">
                                                                {{$article['title']}}
                                                            </a>
                                                        </h5>
                                                    </div>
                                                    <div class="dlab-post-readmore blog-share">
                                                        <a title="{{$article['title']}}"
                                                           class="site-button-link border-link black"
                                                           href="{{url(session('lang').'/'.$article['type'].'/'.$article['id'].'/'.str_replace(' ','-',$article['title']))}}">
                                                            READ MORE
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="col-12">
                                        <div class="alert alert-info text-center rounded" role="alert">
                                            <b>no result !</b>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                    </div>
                    <div class="tab-pane fade" id="pills-course" role="tabpanel" aria-labelledby="pills-course-tab">
                        <div class="container">
                            <div class="row">
                                @if(isset($courses))
                                    @foreach($courses as $course)
                                        <div class="post card-container col-lg-4 col-md-6 col-sm-6">
                                            <div class="blog-post blog-grid blog-style-1">
                                                <div class="dlab-post-media dlab-img-effect radius-sm">
                                                    <a title="{{$course['title']}}"
                                                       href="{{url(session('lang').'/courses/'.$course['id'].'/'.str_replace(' ','-',$course['title']))}}">
                                                        <img src="{{$course['image']}}" alt="{{$course['title']}}">
                                                    </a>
                                                </div>
                                                <div class="dlab-info">
                                                    <div class="dlab-post-meta">
                                                        <ul class="d-flex align-items-center">
                                                            <li class="post-date">{{$course['created_at']}}</li>
                                                            <li class="post-comment">{{$course['duration']}} month</li>
                                                        </ul>
                                                    </div>
                                                    <div class="dlab-post-title ">
                                                        <h5 class="post-title font-20">
                                                            <a title="{{$course['title']}}"
                                                               href="{{url(session('lang').'/courses/'.$course['id'].'/'.str_replace(' ','-',$course['title']))}}">
                                                                {{$course['title']}}
                                                            </a>
                                                        </h5>
                                                    </div>
                                                    <div class="dlab-post-readmore blog-share">
                                                        <a title="{{$course['title']}}"
                                                           class="site-button-link border-link black"
                                                           href="{{url(session('lang').'/courses/'.$course['id'].'/'.str_replace(' ','-',$course['title']))}}">
                                                            READ MORE
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="col-12">
                                        <div class="alert alert-info text-center rounded" role="alert">
                                            <b>no result !</b>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                    </div>
                    <div class="tab-pane fade" id="pills-translation" role="tabpanel"
                         aria-labelledby="pills-translation-tab">
                        <div class="container">
                            <div class="row">
                                @if(isset($translations))
                                    @foreach($translations as $translation)
                                        <div class="post card-container col-lg-4 col-md-6 col-sm-6">
                                            <div class="blog-post blog-grid blog-style-1">
                                                <div class="dlab-post-media dlab-img-effect radius-sm">
                                                    <a title="{{$translation['title']}}"
                                                       href="{{url(session('lang').'/translations/'.$translation['id'].'/'.str_replace(' ','-',$translation['title']))}}">
                                                        {{--                                                        <img src="{{$translation['image']}}" alt="{{$translation['title']}}">--}}
                                                    </a>
                                                </div>
                                                <div class="dlab-info">
                                                    <div class="dlab-post-meta">
                                                        <ul class="d-flex align-items-center">
                                                            <li class="post-date">{{$translation['created_at']}}</li>
                                                            <li class="post-comment">{{$translation['price']}}month
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="dlab-post-title ">
                                                        <h5 class="post-title font-20">
                                                            <a title="{{$translation['title']}}"
                                                               href="{{url(session('lang').'/translations/'.$translation['id'].'/'.str_replace(' ','-',$translation['title']))}}">
                                                                {{$translation['title']}}
                                                            </a>
                                                        </h5>
                                                    </div>
                                                    <div class="dlab-post-readmore blog-share">
                                                        <a title="{{$translation['title']}}"
                                                           class="site-button-link border-link black"
                                                           href="{{url(session('lang').'/translations/'.$translation['id'].'/'.str_replace(' ','-',$translation['title']))}}">
                                                            READ MORE
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="col-12">
                                        <div class="alert alert-info text-center rounded" role="alert">
                                            <b>no result !</b>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


@push('scripts')

@endpush