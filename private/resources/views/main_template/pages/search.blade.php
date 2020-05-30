@extends('main_template.master_page.master')

@push('styles')

@endpush

@section('content')
    <section class="searchPage">
{{--        <div class="dlab-bnr-inr overlay-black-middle">--}}
{{--            <div class="container">--}}
{{--                <div class="dlab-bnr-inr-entry">--}}
{{--                    <h1 class="text-white">@lang('messages.global.search')</h1>--}}
{{--                    <!-- Breadcrumb row -->--}}
{{--                @include('main_template.modules.breadcrumb')--}}

{{--                <!-- Breadcrumb row END -->--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
        <div class="content-inner-2">
            <div class="container">
                @if(isset($contents))
                    <div class="section-head text-black text-center m-b20 pb-4 border-bottom">
                        <h2 class="m-b10">@lang('messages.global.tags')</h2>
                        <div>
                            @lang('messages.global.tags-description')
                            <b>{{isset($tag->name) ??  $tag->name}}</b>
                        </div>
                    </div>
                @else
                    <div class="section-head text-black text-center m-b20 pb-4 border-bottom">
                        <h2 class="m-b10">@lang('messages.global.search')</h2>
                        <div>
                            @lang('messages.global.search-query') @lang('messages.global.in')
                            <b>{{isset($search_in) ? __('messages.global.'.$search_in) : '' }}</b>
                            :
                            <span class="text-danger"><b>{{isset($search_for) ? $search_for : __('messages.global.no-search-query')}}</b></span>
                        </div>
                    </div>
                @endif


                <ul class="nav nav-pills mb-5 justify-content-center" id="pills-tab" role="tablist">
                    @if(! isset($contents))
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
                    @endif
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    @if(isset($contents))
                        <div class="tab-pane fade show active"
                             id="pills-tags" role="tabpanel" aria-labelledby="pills-tags-tab">
                            <div class="container">
                                <div class="row">
                                    @if(count($contents) > 0)
                                        @if($model_name=='Course')
                                            @foreach($contents as $course)
                                                <div class="post card-container col-lg-4 col-md-6 col-sm-6">
                                                    <div class="blog-post blog-grid blog-style-1 border">
                                                        <div class="dlab-post-media dlab-img-effect radius-sm">
                                                            <a title="{{$course['title_'.session('lang')]}}"
                                                               href="{{url(session('lang').'/courses/'.$course['id'].'/'.str_replace(' ','-',$course['title_'.session('lang')]))}}">
                                                                <img src="{{$course['image']}}"
                                                                     alt="{{$course['title_'.session('lang')]}}">
                                                            </a>
                                                        </div>
                                                        <div class="dlab-info p-2">
                                                            <div class="dlab-post-meta">
                                                                <ul class="d-flex align-items-center">
                                                                    <li class="post-date">{{$course['created_at']}}</li>
                                                                    <li class="post-comment">{{$course['duration']}} @lang('messages.global.month')</li>
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
                                                                <a title="{{$course['title_'.session('lang')]}}"
                                                                   class="site-button-link border-link black"
                                                                   href="{{url(session('lang').'/courses/'.$course['id'].'/'.str_replace(' ','-',$course['title_'.session('lang')]))}}">
                                                                    @lang('messages.global.see-more-details')
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            @foreach($contents as $news_item)
                                                <div class="post card-container col-lg-4 col-md-6 col-sm-6">
                                                    <div class="blog-post blog-grid blog-style-1 border">
                                                        <div class="dlab-post-media dlab-img-effect radius-sm">
                                                            <a title="{{$news_item['title']}}"
                                                               href="{{url(session('lang').'/news/'.$news_item['id'].'/'.str_replace(' ','-',$news_item['title']))}}">
                                                                <img src="{{$news_item['logo']}}"
                                                                     alt="{{$news_item['title']}}">
                                                            </a>
                                                        </div>
                                                        <div class="dlab-info p-2">
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
                                                                    @lang('messages.global.see-more-details')
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif

                                        <div class="col-12">
                                            {{$contents->links()}}
                                        </div>
                                    @else
                                        <div class="col-12">
                                            <div class="alert alert-info text-center rounded" role="alert">
                                                <b>{{__('messages.global.no-result')}}</b>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="tab-pane fade {{isset($search_in) ? ($search_in=='news' ? 'show active' : '') : '' }}"
                             id="pills-news" role="tabpanel"
                             aria-labelledby="pills-news-tab">
                            <div class="container">
                                <div class="row">
                                    @if(isset($news))
                                        @foreach($news as $news_item)
                                            <div class="post card-container col-lg-4 col-md-6 col-sm-6">
                                                <div class="blog-post blog-grid blog-style-1 border">
                                                    <div class="dlab-post-media dlab-img-effect radius-sm">
                                                        <a title="{{$news_item['title']}}"
                                                           href="{{url(session('lang').'/news/'.$news_item['id'].'/'.str_replace(' ','-',$news_item['title']))}}">
                                                            <img src="{{$news_item['logo']}}"
                                                                 alt="{{$news_item['title']}}">
                                                        </a>
                                                    </div>
                                                    <div class="dlab-info p-2">
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
                                                                @lang('messages.global.see-more-details')
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="col-12">
                                            <div class="alert alert-info text-center rounded" role="alert">
                                                <b>{{__('messages.global.no-result')}}</b>
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
                                                <div class="blog-post blog-grid blog-style-1 border">
                                                    <div class="dlab-post-media dlab-img-effect radius-sm">
                                                        <a title="{{$article['title']}}"
                                                           href="{{url(session('lang').'/article/'.$article['id'].'/'.str_replace(' ','-',$article['title']))}}">
                                                            <img src="{{$article['logo']}}" alt="{{$article['title']}}">
                                                        </a>
                                                    </div>
                                                    <div class="dlab-info p-2">
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
                                                                @lang('messages.global.see-more-details')
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="col-12">
                                            <div class="alert alert-info text-center rounded" role="alert">
                                                <b>{{__('messages.global.no-result')}}</b>
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
                                                <div class="blog-post blog-grid blog-style-1 border">
                                                    <div class="dlab-post-media dlab-img-effect radius-sm">
                                                        <a title="{{$course['title_'.session('lang')]}}"
                                                           href="{{url(session('lang').'/courses/'.$course['id'].'/'.str_replace(' ','-',$course['title_'.session('lang')]))}}">
                                                            <img src="{{$course['image']}}"
                                                                 alt="{{$course['title_'.session('lang')]}}">
                                                        </a>
                                                    </div>
                                                    <div class="dlab-info p-2">
                                                        <div class="dlab-post-meta">
                                                            <ul class="d-flex align-items-center">
                                                                <li class="post-date">{{$course['created_at']}}</li>
                                                                <li class="post-comment">{{$course['duration']}} @lang('messages.global.month')</li>
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
                                                                @lang('messages.global.see-more-details')
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="col-12">
                                            <div class="alert alert-info text-center rounded" role="alert">
                                                <b>{{__('messages.global.no-result')}}</b>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection