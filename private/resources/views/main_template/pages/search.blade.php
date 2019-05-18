@extends('main_template.master_page.master')

@push('styles')

@endpush

@section('content')
    <section class="searchPage">
        <div class="dlab-bnr-inr overlay-black-middle">
            <div class="container">
                <div class="dlab-bnr-inr-entry">
                    <h1 class="text-white">@lang('messages.global.search')</h1>
                    <!-- Breadcrumb row -->
                @include('main_template.modules.breadcrumb')

                <!-- Breadcrumb row END -->
                </div>
            </div>
        </div>
        <div class="content-inner-2">
            <div class="container">
                <div class="section-head text-black text-center m-b20 pb-4 border-bottom">
                    <h2 class="m-b10">@lang('messages.global.search')</h2>
                    <h5>
                        @lang('messages.global.search-query') {{isset($search_in) ? __('messages.global.'.$search_in) : '' }}
                        :
                        <span class="text-danger"><b>{{isset($search_for) ? $search_for : __('messages.global.no-search-query')}}</b></span>
                    </h5>
                </div>

                <ul class="nav nav-pills mb-5 justify-content-center" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link {{isset($search_in) ? ($search_in=='news' ? 'active' : '') : '' }}"
                           id="pills-news-tab" data-toggle="pill" href="#pills-news" role="tab"
                           aria-controls="pills-news" aria-selected="true">@lang('messages.global.news')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{isset($search_in) ? ($search_in=='article' ? 'active' : '') : '' }}"
                           id="pills-article-tab" data-toggle="pill" href="#pills-article" role="tab"
                           aria-controls="pills-article" aria-selected="false">@lang('messages.global.articles')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{isset($search_in) ? ($search_in=='courses' ? 'active' : '') : '' }}"
                           id="pills-course-tab" data-toggle="pill" href="#pills-course" role="tab"
                           aria-controls="pills-course" aria-selected="false">@lang('messages.global.courses')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{isset($search_in) ? ($search_in=='translations' ? 'active' : '') : '' }}"
                           id="pills-translation-tab" data-toggle="pill" href="#pills-translation"
                           role="tab"
                           aria-controls="pills-translation"
                           aria-selected="false">@lang('messages.global.translations')</a>
                    </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade {{isset($search_in) ? ($search_in=='news' ? 'show active' : '') : '' }}"
                         id="pills-news" role="tabpanel"
                         aria-labelledby="pills-news-tab">
                        <div class="container">
                            <div class="row">
                                @if(isset($news))
                                    @foreach($news as $news_item)
                                        <div class="post card-container col-lg-4 col-md-6 col-sm-6">
                                            <div class="blog-post blog-grid blog-style-1">
                                                <div class="dlab-post-media dlab-img-effect radius-sm">
                                                    <a title="{{$news_item['title']}}"
                                                       href="{{url(session('lang').'/news/'.$news_item['id'].'/'.str_replace(' ','-',$news_item['title']))}}">
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
                                                               href="{{url(session('lang').'/news/'.$news_item['id'].'/'.str_replace(' ','-',$news_item['title']))}}">
                                                                {{$news_item['title']}}
                                                            </a>
                                                        </h5>
                                                    </div>
                                                    <div class="dlab-post-readmore blog-share">
                                                        <a title="{{$news_item['title']}}"
                                                           class="site-button-link border-link black"
                                                           href="{{url(session('lang').'/news/'.$news_item['id'].'/'.str_replace(' ','-',$news_item['title']))}}">
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
                    <div class="tab-pane fade {{isset($search_in) ? ($search_in=='article' ? 'show active' : '') : '' }}"
                         id="pills-article" role="tabpanel" aria-labelledby="pills-article-tab">
                        <div class="container">
                            <div class="row">
                                @if(isset($articles))
                                    @foreach($articles as $article)
                                        <div class="post card-container col-lg-4 col-md-6 col-sm-6">
                                            <div class="blog-post blog-grid blog-style-1">
                                                <div class="dlab-post-media dlab-img-effect radius-sm">
                                                    <a title="{{$article['title']}}"
                                                       href="{{url(session('lang').'/article/'.$article['id'].'/'.str_replace(' ','-',$article['title']))}}">
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
                                                               href="{{url(session('lang').'/article/'.$article['id'].'/'.str_replace(' ','-',$article['title']))}}">
                                                                {{$article['title']}}
                                                            </a>
                                                        </h5>
                                                    </div>
                                                    <div class="dlab-post-readmore blog-share">
                                                        <a title="{{$article['title']}}"
                                                           class="site-button-link border-link black"
                                                           href="{{url(session('lang').'/article/'.$article['id'].'/'.str_replace(' ','-',$article['title']))}}">
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
                    <div class="tab-pane fade {{isset($search_in) ? ($search_in=='courses' ? 'show active' : '') : '' }}"
                         id="pills-course" role="tabpanel" aria-labelledby="pills-course-tab">
                        <div class="container">
                            <div class="row">
                                @if(isset($courses))
                                    @foreach($courses as $course)
                                        <div class="post card-container col-lg-4 col-md-6 col-sm-6">
                                            <div class="blog-post blog-grid blog-style-1">
                                                <div class="dlab-post-media dlab-img-effect radius-sm">
                                                    <a title="{{$course['title_'.session('lang')]}}"
                                                       href="{{url(session('lang').'/courses/'.$course['id'].'/'.str_replace(' ','-',$course['title_'.session('lang')]))}}">
                                                        <img src="{{$course['image']}}"
                                                             alt="{{$course['title_'.session('lang')]}}">
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
                                                            <a title="{{$course['title_'.session('lang')]}}"
                                                               href="{{url(session('lang').'/courses/'.$course['id'].'/'.str_replace(' ','-',$course['title_'.session('lang')]))}}">
                                                                {{$course['title_'.session('lang')]}}
                                                            </a>
                                                        </h5>
                                                    </div>
                                                    <div class="dlab-post-readmore blog-share">
                                                        <a title="{{$course['title']}}"
                                                           class="site-button-link border-link black"
                                                           href="{{url(session('lang').'/courses/'.$course['id'].'/'.str_replace(' ','-',$course['title_'.session('lang')]))}}">
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
                    <div class="tab-pane fade {{isset($search_in) ? ($search_in=='translations' ? 'show active' : '') : '' }}"
                         id="pills-translation" role="tabpanel"
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