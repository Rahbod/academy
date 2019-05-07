@extends('main_template.master_page.master')

@push('styles')

@endpush

@section('content')
    @if(isset($main_sliders))
        <section class="sliderSection">
            <div class="mainSlider">
                @foreach($main_sliders['sliders'] as $slider)
                    <div class="mainSlider--item position-relative">
                        <img class=""
                             src="{{asset('/assets/site/media/images/main_slider/p1.jpg')}}"
                             alt="{{$slider['title']}}"/>

                        <div class="mainSlider--title">
                            <h3>{{$slider['title']}}</h3>
                            <p>{!! $slider['text'] !!}</p>

                            <a href="{{$slider['link']}}" title="{{ $slider['title'] }}"
                               class="mainSlider__site-button button-md">details</a>
                            <a href="{{url(session('lang'). '/contact-us')}}"
                               class="mainSlider__site-button white button-md" title="talk to us">talk to us</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    @endif

    @if(isset($courses) && count($courses) > 0 )
        <section class="top-courses sectionPadding bg-white">
            <div class="container">
                <div class="sectionHeader text-center">
                    <h2 class="text-uppercase mb-0">top courses</h2>
                    <p class="font-18">courses with best teacher around the world.</p>
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
                    @foreach($courses as $course)
                        <div class="col-lg-4 col-md-6 col-sm-6 m-b30 card-container">
                            <div class="dlab-box">
                                <div class="dlab-media">
                                    <a href="{{session('lang').'/courses/'. $course['id'] .'/'.str_replace(' ','-',$course['title']) }}">
                                        <img class="img-fluid" src="{{$course['image']}}" alt="">
                                    </a>

                                    <div class="tr-price">
                                        <span>{{$course['duration']}} month</span>
                                    </div>
                                </div>
                                <div class="dlab-info p-a20 border-1 text-center">
                                    <h4 class="dlab-title m-t0">
                                        <a title="{{$course['title']}}"
                                           href="{{session('lang').'/courses/'. $course['id'] .'/'.str_replace(' ','-',$course['title']) }}">
                                            {{$course['title']}}
                                        </a>
                                    </h4>
                                    <p>
                                        {!! $course['description'] !!}
                                    </p>

                                    <div class="tr-btn-info d-flex justify-content-between">
                                        <a href="{{session('lang').'/courses/register/'. $course['id'] .'/'.str_replace(' ','-',$course['title']) }}"
                                           class="site-button radius-no">
                                            <i class="fa fa-location-arrow" aria-hidden="true"></i>
                                            register
                                        </a>
                                        <a href="{{session('lang').'/courses/'. $course['id'] .'/'.str_replace(' ','-',$course['title']) }}"
                                           class="site-button bg-primary-dark radius-no">
                                            <i class="fa fa-info-circle" aria-hidden="true"></i> details </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

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
                        <a href="{{url(session('lang').'/translation')}}" class="site-button white">See more details</a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6"></div>
            </div>
        </div>
    </section>

    @if(isset($news))
        <section class="newsSlider content-inner">
            <div class="container">
                <div class="section-head d-flex text-black">
                    <div class="flex-grow-1">
                        <h2 class="text-uppercase m-b0">Newest News</h2>
                        <p class="m-b0">lately news from our site</p>
                    </div>
                    <div class="align-self-center">
                        <a href="void:;" class="site-button button-md float-right m-t5">View All</a>
                    </div>
                </div>
            </div>
            <div class="newsSlider--container">
                @foreach($news as $item)
                    <div class="item">
                        <div class="dlab-box">
                            <div class="dlab-media dlab-img-effect zoom-slow dlab-img-overlay2">
                                <img src="{{asset('assets/site/media/images/news_slider/pic1.jpg')}}" alt="">
                                {{--<img src="{{$item['image']}}" alt="">--}}
                                <div class="dlab-info-has p-a20 no-hover ">
                                    <div class="dlab-info-has-text">
                                        <h3 class="text-white">{{$item['title']}}<span
                                                    class="text-white float-right">{{$item['summary']}}</span>
                                        </h3>
                                        <a title="{{$item['title']}}"
                                           href="{{url(session('lang').'/news/'.$item['id'].'/'.str_replace(' ','-',$item['title']))}}"
                                           class="site-button-link">more details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                @endforeach
            </div>
        </section>
    @endif
    @if(isset($last_section))
        <div class="section-full bg-white content-inner dlab-about-1 promotions">
            <div class="container">
                <div class="section-head text-black text-center">
                    <h2 class="text-uppercase m-b0">PACKAGES</h2>
                    <p class="font-18">BEST TRAVEL PACKAGES </p>
                </div>
                <div class="row packages">
                    <div class="col-lg-6 col-xl-3 col-sm-6 col-md-6 m-b30">
                        <div class="dlab-box">
                            <div class="dlab-media">
                                <a href="#"><img src="{{asset('assets/site/media/images/promotion/img3.jpg')}}" alt=""></a>
                            </div>
                            <div class="dlab-info p-a15 border-1">
                                <h4 class="dlab-title m-t0"><a href="packages.html">title 1</a></h4>
                                <span class="location">tag 1 ,tag 2 ,tag 3</span>
                                <div class="package-content">
                                    <ul class="package-meta">
                                        <li><span class="fa fa-calendar"></span> No of Days: 2</li>
                                        <li><span class="fa fa-user"></span> Remain: 1</li>
                                    </ul>
                                    <div class="clearfix">
                                        <span class="package-price pull-left text-primary">900,00 T</span>
                                        <a href="void:;" class="site-button float-right">View details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-3 col-sm-6 col-md-6 m-b30">
                        <div class="dlab-box">
                            <div class="dlab-media">
                                <a href="#"><img src="{{asset('assets/site/media/images/promotion/img4.jpg')}}" alt=""></a>
                            </div>
                            <div class="dlab-info p-a15 border-1">
                                <h4 class="dlab-title m-t0"><a href="packages.html">title 1</a></h4>
                                <span class="location">tag 1 ,tag 2 ,tag 3</span>
                                <div class="package-content">
                                    <ul class="package-meta">
                                        <li><span class="fa fa-calendar"></span> No of Days: 2</li>
                                        <li><span class="fa fa-user"></span> Remain: 1</li>
                                    </ul>
                                    <div class="clearfix">
                                        <span class="package-price pull-left text-primary">900,00 T</span>
                                        <a href="void:;" class="site-button float-right">View details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-3 col-sm-6 col-md-6 m-b30">
                        <div class="dlab-box">
                            <div class="dlab-media">
                                <a href="#"><img src="{{asset('assets/site/media/images/promotion/img3.jpg')}}" alt=""></a>
                            </div>
                            <div class="dlab-info p-a15 border-1">
                                <h4 class="dlab-title m-t0"><a href="packages.html">title 1</a></h4>
                                <span class="location">tag 1 ,tag 2 ,tag 3</span>
                                <div class="package-content">
                                    <ul class="package-meta">
                                        <li><span class="fa fa-calendar"></span> No of Days: 2</li>
                                        <li><span class="fa fa-user"></span> Remain: 1</li>
                                    </ul>
                                    <div class="clearfix">
                                        <span class="package-price pull-left text-primary">900,00 T</span>
                                        <a href="void:;" class="site-button float-right">View details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-3 col-sm-6 col-md-6 m-b30">
                        <div class="dlab-box">
                            <div class="dlab-media">
                                <a href="#"><img src="{{asset('assets/site/media/images/promotion/img5.jpg')}}" alt=""></a>
                            </div>
                            <div class="dlab-info p-a15 border-1">
                                <h4 class="dlab-title m-t0"><a href="packages.html">title 1</a></h4>
                                <span class="location">tag 1 ,tag 2 ,tag 3</span>
                                <div class="package-content">
                                    <ul class="package-meta">
                                        <li><span class="fa fa-calendar"></span> No of Days: 2</li>
                                        <li><span class="fa fa-user"></span> Remain: 1</li>
                                    </ul>
                                    <div class="clearfix">
                                        <span class="package-price pull-left text-primary">900,00 T</span>
                                        <a href="void:;" class="site-button float-right">View details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

@push('scripts')

@endpush