@extends('main_template.master_page.master')

@push('styles')

@endpush

@section('content')
    <section class="newsIndex mb-5">
        <div class="dlab-bnr-inr overlay-black-middle">
            <div class="container">
                <div class="dlab-bnr-inr-entry">
                    <h1 class="text-white">
                        @lang('messages.global.'.$content_type)
                    </h1>
                    <!-- Breadcrumb row -->
                @include('main_template.modules.breadcrumb')
                <!-- Breadcrumb row END -->
                </div>
            </div>
        </div>
        <div class="content-area">
            <div class="container">
                <div class="row">
                @if( isset($contents) && count($contents)>0)
                    <!-- Left part start -->
                        <div class="col-lg-8 col-md-7 col-sm-12">
                            <!-- Blog large img -->
                            @foreach($contents as $content)
                                <div class="blog-post blog-lg blog-style-1">
                                    <div class="dlab-post-media dlab-img-effect zoom-slow radius-sm">
                                        <a title="{{$content['title']}}"
                                           href="{{url(session('lang').'/'.$content['type']. '/'.$content['id'].'/'.str_replace(' ','-',$content['title']))}}">
                                            <img src="{{$content['logo']}}" alt="{{$content['title']}}">
                                        </a>
                                    </div>
                                    <div class="dlab-info">
                                        <div class="dlab-post-meta">
                                            <ul class="d-flex align-items-center">
                                                <li class="post-date">{{$content['created_at']}}</li>
                                                <li class="post-author">@lang('messages.global.by')
                                                    <a href="{{url(session('lang') .'/users/'.$content['author']['id'] .'/'.str_replace(' ','-',$content['author']['name']))}}">{{isset($content['author']) ? $content['author']['name'] :'admin'}}</a>
                                                </li>
                                                <li class="post-comment"><a href="#">{{$content['show_count']}}</a></li>
                                            </ul>
                                        </div>
                                        <div class="dlab-post-title">
                                            <h4 class="post-title font-24">
                                                <a title="{{$content['title']}}"
                                                   href="{{url(session('lang').'/'.$content['type']. '/'.$content['id'].'/'.str_replace(' ','-',$content['title']))}}">{{$content['title']}}</a>
                                            </h4>
                                        </div>
                                        <div class="dlab-post-text">
                                            <p>{!! $content['text'] !!}</p>
                                        </div>
                                        <div class="dlab-post-readmore blog-share">
                                            <a title="{{$content['title']}}"
                                               href="{{url(session('lang').'/'.$content['type'].'/'.$content['id'].'/'.str_replace(' ','-',$content['title']))}}"
                                               rel="bookmark"
                                               class="site-button-link border-link black">@lang('messages.global.view-details')</a>
                                        </div>
                                    </div>

                                </div>
                            @endforeach
                            <div class="pagination-bx clearfix text-center my-5">
                                {{$contents->links()}}

                                {{--<ul class="pagination">--}}
                                {{--<li class="previous mr-2"><a href="#"><i class="fal fa-arrow-left"></i> Prev</a></li>--}}
                                {{--<li class="active"><a href="#">1</a></li>--}}
                                {{--<li><a href="#">2</a></li>--}}
                                {{--<li><a href="#">3</a></li>--}}
                                {{--<li class="next ml-2"><a href="#">Next <i class="fal fa-arrow-right"></i></a></li>--}}
                                {{--</ul>--}}
                            </div>
                        </div>
                    @else
                        <div class="col-lg-8 col-md-7 col-sm-12">
                            <div class="alert alert-info text-center rounded" role="alert">
                                <b>@lang('messages.global.no-result')</b>
                            </div>
                        </div>
                @endif
                <!-- Left part END -->
                    <!-- Side bar start -->
                    <div class="col-lg-4 col-md-5 col-sm-12 sticky-top">
                        <aside class="side-bar">
                            <div class="widget">
                                <h6 class="widget-title style-1">@lang('messages.global.search')</h6>
                                <div class="search-bx style-1">
                                    <form action="{{url(session('lang').'/search')}}" enctype="multipart/form-data"
                                          role="search" method="post">
                                        @csrf
                                        <input type="hidden" value="{{$content_type}}" name="search_in">
                                        <div class="input-group">
                                            <input name="search_query" class="form-control"
                                                   placeholder="@lang('messages.global.search') ..."
                                                   type="text">
                                            <span class="input-group-btn">
												<button type="submit" class="fa fa-search text-primary"></button>
                                            </span>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="widget recent-posts-entry">
                                <h6 class="widget-title style-1">@lang('messages.global.recent-posts')</h6>
                                <div class="widget-post-bx">
                                    @if(isset($recent_posts) && count($recent_posts) >0)
                                        @foreach($recent_posts as $post)
                                            <div class="widget-post clearfix">
                                                <div class="dlab-post-media">
                                                    <img src="{{$post['logo']}}" alt="{{$post['title']}}"
                                                         width="200" height="143">
                                                </div>
                                                <div class="dlab-post-info">
                                                    <div class="dlab-post-header">
                                                        <h6 class="post-title">
                                                            <a title="{{$post['title']}}"
                                                               href="{{url(session('lang').'/'.$post['type']. '/'.$post['id'].'/'.str_replace(' ','-',$post['title']))}}">{{$post['title']}}</a>
                                                        </h6>
                                                    </div>
                                                    <div class="dlab-post-meta">
                                                        <ul class="d-flex align-items-center">
                                                            <li class="post-date">{{$post['published_at']}}</li>
                                                            <li class="post-comment"><a
                                                                        href="#">{{$post['show_count']}}</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>

                            @if(isset($gallery))
                                <div class="widget widget_gallery gallery-grid-3">
                                    <h6 class="widget-title style-1">Our services</h6>
                                    <ul>
                                        <li>
                                            <div class="dlab-post-thum"><a href="#"
                                                                           class="dlab-img-overlay1 dlab-img-effect zoom-slow"><img
                                                            src="http://triper.dexignlab.com/xhtml/images/gallery/pic2.jpg"
                                                            alt=""></a></div>
                                        </li>
                                        <li>
                                            <div class="dlab-post-thum"><a href="#"
                                                                           class="dlab-img-overlay1 dlab-img-effect zoom-slow"><img
                                                            src="http://triper.dexignlab.com/xhtml/images/gallery/pic1.jpg"
                                                            alt=""></a></div>
                                        </li>
                                        <li>
                                            <div class="dlab-post-thum"><a href="#"
                                                                           class="dlab-img-overlay1 dlab-img-effect zoom-slow"><img
                                                            src="http://triper.dexignlab.com/xhtml/images/gallery/pic5.jpg"
                                                            alt=""></a></div>
                                        </li>
                                        <li>
                                            <div class="dlab-post-thum"><a href="#"
                                                                           class="dlab-img-overlay1 dlab-img-effect zoom-slow"><img
                                                            src="http://triper.dexignlab.com/xhtml/images/gallery/pic7.jpg"
                                                            alt=""></a></div>
                                        </li>
                                        <li>
                                            <div class="dlab-post-thum"><a href="#"
                                                                           class="dlab-img-overlay1 dlab-img-effect zoom-slow"><img
                                                            src="http://triper.dexignlab.com/xhtml/images/gallery/pic8.jpg"
                                                            alt=""></a></div>
                                        </li>
                                        <li>
                                            <div class="dlab-post-thum"><a href="#"
                                                                           class="dlab-img-overlay1 dlab-img-effect zoom-slow"><img
                                                            src="http://triper.dexignlab.com/xhtml/images/gallery/pic9.jpg"
                                                            alt=""></a></div>
                                        </li>
                                    </ul>
                                </div>
                            @endif

                            @if(isset($archive))
                                <div class="widget widget_archive">
                                    <h6 class="widget-title style-1">Categories List</h6>
                                    <ul>
                                        <li><a href="#">aciform</a></li>
                                        <li><a href="#">championship</a></li>
                                        <li><a href="#">chastening</a></li>
                                        <li><a href="#">clerkship</a></li>
                                        <li><a href="#">disinclination</a></li>
                                    </ul>
                                </div>
                            @endif

                            @if(isset($newsletter))
                                <div class="widget widget-newslatter">
                                    <h6 class="widget-title style-1">Newsletter</h6>
                                    <div class="news-box">
                                        <p>Enter your e-mail and subscribe to our newsletter.</p>
                                        <form class="dzSubscribe" enctype="multipart/form-data"
                                              action="{{url(session('lang').'/newsletter')}}" method="post">
                                            <div class="input-group">
                                                <input name="email" required="required" type="email"
                                                       class="form-control"
                                                       placeholder="Your Email">
                                                <button name="submit" value="Submit" type="submit"
                                                        class="site-button btn-block radius-no">Subscribe Now
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @endif

                        </aside>
                    </div>
                    <!-- Side bar END -->
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')

@endpush