@extends('main_template.master_page.master')

@section('content')
    <section class="sliderSection">
        <div class="mainSlider">
            @if(isset($main_sliders))
                @foreach($main_sliders['sliders'] as $slider)
                    <div class="mainSlider--item position-relative">
                        <img class="" src="{{$slider['image']}}" alt="{{$slider['title']}}"/>

                        <div class="mainSlider--title">
                            <h3 class="-show2Lines">{{$slider['title']}}</h3>
                            <p class="-show2Lines">{!! $slider['text'] !!}</p>

                            <a href="{{$slider['link']}}" title="{{ $slider['title'] }}"
                               class="mainSlider__site-button button-md">@lang('messages.global.details')</a>
                            {{--<a href="{{url(session('lang'). '/contact-us')}}"--}}
                            {{--class="mainSlider__site-button white button-md" title="talk to us">@lang('messages.global.contact')</a>--}}
                        </div>
                    </div>
                @endforeach

            @else
                <div class="mainSlider--item position-relative">
                    <img class="" src="{{asset('assets/site/media/images/main_slider/p6.jpg')}}"
                         alt="no slider defined"/>
                </div>
            @endif
        </div>
    </section>
    <section class="top-courses sectionPadding bg-white">
        <div class="container">
            <div class="sectionHeader text-center">
                <h2 class="text-uppercase mb-0">@lang('messages.home.course-title')</h2>
                <p class="font-18">@lang('messages.home.course-description')</p>
            </div>

            <div class="row d-flex mb-3 px-3 tags">
                @foreach($courses as $course)
                    @foreach($course['tags'] as $tag)
                        <a href="{{url(session('lang'). '/course/tags/'.$tag['id'].'/'.str_replace(' ','-',$tag['name']))}}"
                           class="site-button mb-2 mb-lg-0">
                            {{$tag['name']}}
                        </a>
                    @endforeach
                @endforeach
            </div>

            <div class="row">
                @if(isset($courses) && count($courses) > 0 )

                    @foreach($courses as $course)
                        <div class="col-md-4 col-sm-6 m-b30 card-container">
                            <div class="dlab-box">
                                <div class="dlab-media">
                                    <a href="{{url(session('lang').'/courses/'. $course['id'] .'/'.str_replace(' ','-',$course['title_'.session('lang')]) )}}">
                                        <img class="img-fluid" src="{{$course['image']}}" alt="">
                                    </a>

                                    <div class="tr-price">
                                        <span>{{$course['duration']}} @lang('messages.global.month')</span>
                                    </div>
                                </div>
                                <div class="dlab-info p-a20 border-1 text-center">
                                    <h4 class="dlab-title m-t0 -show2Lines">
                                        <a title="{{$course['title_'.session('lang')]}}"
                                           href="{{url(session('lang').'/courses/'. $course['id'] .'/'.str_replace(' ','-',$course['title_'.session('lang')])) }}">
                                            {{$course['title_'.session('lang')]}}
                                        </a>
                                    </h4>
                                    <p class="-show2Lines">
                                        {!! $course['description_'.session('lang')] !!}
                                    </p>

                                    <div class="tr-btn-info d-flex justify-content-between">
                                        @auth
                                            <a href="{{url(session('lang').'/courses/register/'. $course['id'] .'/'.str_replace(' ','-',$course['title_'.session('lang')]) )}}"
                                               class="site-button radius-no">
                                                <i class="fa fa-location-arrow" aria-hidden="true"></i>
                                                @lang('messages.global.register')
                                            </a>
                                        @endauth

                                        @guest
                                            <a href="{{url(session('lang').'/login') }}"
                                               class="site-button radius-no">
                                                <i class="fas fa-sign-in-alt"></i>
                                                @lang('messages.global.login')
                                            </a>
                                        @endguest

                                        <a href="{{url(session('lang').'/courses/'. $course['id'] .'/'.str_replace(' ','-',$course['title_'.session('lang')])) }}"
                                           class="site-button bg-primary-dark radius-no">
                                            <i class="fa fa-info-circle"
                                               aria-hidden="true"></i>@lang('messages.global.details')</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-12 alert alert-info" role="alert">
                        @lang('messages.global.no-result')
                    </div>
                @endif

            </div>
        </div>
    </section>
    <section class="translation"
             style="background-image:url('{{asset('/assets/site/media/images/translation/translation_2000x767.jpg')}}')">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="add-area">
                        <h3>translate your documents with us</h3>
                        <h2>Discount <span style="color:#21ab64;">10-30%</span> Off</h2>
                        <p>If you’re looking for a truly precise translator with cool history,here you will see what
                            you are searching for
                        </p>
                        <a title="@lang('messages.global.see-more-details')"
                           href="{{route('translations',['lang'=>session('lang')])}}"
                           class="site-button white">@lang('messages.global.see-more-details')</a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6"></div>
            </div>
        </div>
    </section>
    <section class="newsSlider content-inner">
        <div class="container">
            <div class="section-head d-flex text-black">
                <div class="flex-grow-1">
                    <h2 class="text-uppercase m-b0">@lang('messages.home.news-title')</h2>
                    <p class="m-b0">@lang('messages.home.news-description')</p>
                </div>
                @if(isset($news))

                    <div class="align-self-center">
                        <a title="@lang('messages.global.view-all')" href="{{url(session('lang').'/news' )}}"
                           class="site-button button-md float-right m-t5">@lang('messages.global.view-all')</a>
                    </div>
                @endif
            </div>
        </div>
        @if(isset($news))
            <div class="newsSlider--container">
                @foreach($news as $item)
                    <div class="item">
                        <div class="dlab-box">
                            <div class="dlab-media dlab-img-effect zoom-slow dlab-img-overlay2">
                                <img src="{{asset('assets/site/media/images/news_slider/pic1.jpg')}}" alt="">
                                {{--<img src="{{$item['image']}}" alt="">--}}
                                <div class="dlab-info-has p-a20 no-hover ">
                                    <div class="dlab-info-has-text">
                                        <h3 class="text-white -show2Lines">{{$item['title']}}
                                            {{--<span class="text-white float-right">{{$item['summary']}}</span>--}}
                                        </h3>
                                        <a title="{{$item['title']}}"
                                           href="{{url(session('lang').'/news/'.$item['id'].'/'.str_replace(' ','-',$item['title']))}}"
                                           class="site-button-link">@lang('messages.global.view-details')</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                @endforeach
            </div>
        @else
            <div class="alert alert-info mx-5 text-center" role="alert">
                @lang('messages.global.no-result')
            </div>
        @endif
    </section>
    <section class="articlesSection mb-5">
        <div class="section-full bg-white content-inner dlab-about-1 promotions">
            <div class="container">
                <div class="section-head d-flex text-black">
                    <div class="flex-grow-1">
                        <h2 class="text-uppercase m-b0">@lang('messages.home.article-title')</h2>
                        <p class="m-b0">@lang('messages.home.article-description')</p>
                    </div>
                    @if(isset($articles))

                        <div class="align-self-center">
                            <a title="view all" href="{{url(session('lang').'/article' )}}"
                               class="site-button button-md float-right m-t5">@lang('messages.global.view-all')</a>
                        </div>
                    @endif
                </div>

                <div class="row packages">
                    @if(isset($articles))
                        @foreach($articles as $article)
                            <div class=" col-xl-3 col-lg-4 col-sm-6 col-md-6 m-b30">
                                <div class="dlab-box">
                                    <div class="dlab-media">
                                        <a title="{{$article['title']}}"
                                           href="{{url(session('lang').'/article/'.$article['id'].'/'.str_replace(' ','-',$article['title']))}}">
                                            <img src="{{$article['logo']}}" alt="{{$article['title']}}">
                                        </a>
                                    </div>
                                    <div class="dlab-info p-a15 border-1">
                                        <h4 class="dlab-title m-t0 -show1Lines">
                                            <a class=""
                                               {{$article['title']}} href="{{url(session('lang').'/article/'.$article['id'].'/'.str_replace(' ','-',$article['title']))}}">
                                                {{$article['title']}}
                                            </a>
                                        </h4>
                                        <span class="location">
                                            @if(isset($article['tags']))
                                                @foreach($article['tags'] as $tag)
                                                    <a title="{{$tag['name']}}"
                                                       href="{{url(session('lang').'/tags/'.$tag['id'])}}">{{$tag['name']}}</a>
                                                @endforeach
                                            @endif
                                            </span>
                                        <div class="package-content">
                                            <ul class="package-meta">
                                                <li><span class="fa fa-calendar">
                                                </span> @lang('messages.global.published-at')
                                                    : {{$article['created_at']}}</li>
                                                <li><span class="fa fa-user"></span> @lang('messages.global.seen')
                                                    : {{$article['show_count']}}</li>
                                            </ul>
                                            <div class="clearfix">
                                                {{--<span class="package-price pull-left text-primary">900,00 T</span>--}}
                                                <a title="{{$article['title']}}"
                                                   href="{{url(session('lang').'/article/'.$article['id'].'/'.str_replace(' ','-',$article['title']))}}"
                                                   class="site-button float-right">@lang('messages.global.view-details')</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    @else
                        <div class="col-12 text-center">
                            <div class="alert alert-info mx-3" role="alert">
                                @lang('messages.global.no-result')
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
