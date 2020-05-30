@extends('main_template.master_page.master')

@push('styles')

@endpush

@section('content')
    <section class="newsIndex mb-5">
{{--        <div class="dlab-bnr-inr overlay-black-middle">--}}
{{--            <div class="container">--}}
{{--                <div class="dlab-bnr-inr-entry">--}}
{{--                    <h1 class="text-white">--}}
{{--                        @lang('messages.global.'.$content_type)--}}
{{--                    </h1>--}}
{{--                    <!-- Breadcrumb row -->--}}
{{--                @include('main_template.modules.breadcrumb')--}}
{{--                <!-- Breadcrumb row END -->--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

        <div class="content-area">
            <div class="container">
                <div class="row">
                    <!-- Left part start -->
                    <div class="col-lg-8 col-md-7 m-b10">
                        <!-- blog start -->
                        <div class="blog-post blog-single blog-style-1">
                            <div class="dlab-post-meta">
                                <ul class="d-flex align-items-center">
                                    <li class="post-date">{{$content['created_at']}}</li>
                                    <li class="post-author">@lang('messages.global.by')
                                        <a href="{{url(session('lang') .'/users/show/'.$content['author']['id'] .'/'.str_replace(' ','-',$content['author']['name']))}}">{{isset($content['author']) ? $content['author']['name'] :'admin'}}</a>
                                    </li>
                                    <li class="post-comment"><a href="#">{{$content['show_count']}}</a></li>
                                </ul>

                            </div>
                            <div class="dlab-post-title">
                                <h4 class="post-title m-t0">
                                    {{$content['title']}}
                                    {{--                                    <a href="#">{{$content['title']}}</a>--}}
                                </h4>
                            </div>
                            <div class="dlab-post-media dlab-img-effect zoom-slow m-t20">
                                {{--<a href="#">--}}
                                <img src="{{$content['image']}}" alt="{{$content['title']}}">
                                {{--</a>--}}
                            </div>

                            <div class="dlab-post-text">
                                {!! $content['text'] !!}
                            </div>

                            <div class="dlab-post-tags clear">
                                <div class="post-tags">
                                    @foreach($content->tags as $tag)
                                        <a title="{{$tag['name']}}"
                                           href="{{url(session('lang').'content/tags/show/'.$tag['id'].'/'.str_replace(' ','-',$tag['name']))}}">{{$tag['name']}}</a>
                                    @endforeach
                                </div>
                            </div>
                            <div class="dlab-divider bg-gray-dark op4"><i class="icon-dot c-square"></i></div>

                            <div class="share-details-btn">
                                <ul>
                                    <li><h5 class="m-a0">@lang('social.share-post')</h5></li>
                                    <li>
                                        <a href="https://www.facebook.com/sharer/sharer.php?u={{request()->fullUrl()}}"
                                           target="_blank" class="site-button facebook button-sm"
                                           title="@lang('social.facebook')">
                                            @lang('social.facebook')
                                        </a>
                                    </li>
                                    <li>
                                        <a target="_blank"
                                           href="https://plus.google.com/share?url={{request()->fullUrl()}}"
                                           title="@lang('social.google-plus')"
                                           class="site-button google-plus button-sm"> @lang('social.google-plus')</a>
                                    </li>
                                    <li>
                                        <a href="https://www.linkedin.com/cws/share?url={{request()->fullUrl()}}"
                                           class="site-button linkedin button-sm" @lang('social.linkedin')> @lang('social.linkedin')</a>
                                    </li>
                                    <li>
                                        <a target="_blank"
                                           href="https://telegram.me/share/url?url={{request()->fullUrl()}}"
                                           class="site-button instagram button-sm" title="@lang('social.twitter')"> @lang('social.instagram')</a></li>
                                    <li>
                                        <a target="_blank"
                                           href="https://twitter.com/home?status={{request()->fullUrl()}}"
                                           class="site-button twitter button-sm" title="@lang('social.twitter')">
                                            @lang('social.twitter')</a></li>
                                    <li>
                                    {{--<a href="https://telegram.me/share/url?url={{request()->fullUrl()}}"--}}
                                    {{--class="site-button whatsapp button-sm"><i--}}
                                    {{--class="fa fa-whatsapp"></i> Whatsapp</a></li>--}}
                                </ul>
                            </div>
                        </div>
                        @if(isset($content['comments']) && count($content['comments'])>0)
                            <div class="clear" id="comment-list">
                                <div class="comments-area" id="comments">
                                    <h2 class="comments-title">{{count($content->comments)}} Comments</h2>
                                    <div class="clearfix m-b20">
                                        <!-- comment list END -->
                                        <ol class="comment-list">
                                            @foreach($content->comments as $comment)
                                                <li class="comment">
                                                    <div class="comment-body">
                                                        <div class="comment-author vcard">
                                                            <img class="avatar photo"
                                                                 src="{{$comment['author']['avatar']}}"
                                                                 alt="{{$comment['author']['name']}}"> <cite class="fn">
                                                                {{$comment['author']['name']}}
                                                            </cite> <span class="says">says:</span></div>
                                                        <div class="comment-meta">
                                                            <a href="#">{{$comment['created_at']}}</a>
                                                        </div>
                                                        <p>{{$comment['content']}}</p>
                                                        <div class="reply"><a href="#"
                                                                              class="comment-reply-link">Reply</a>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach
                                            {{--<li class="comment">--}}
                                            {{--<div class="comment-body">--}}
                                            {{--<div class="comment-author vcard"><img class="avatar photo"--}}
                                            {{--src="http://triper.dexignlab.com/xhtml/images/testimonials/pic1.jpg"--}}
                                            {{--alt=""> <cite class="fn">Stacy--}}
                                            {{--poe</cite> <span class="says">says:</span></div>--}}
                                            {{--<div class="comment-meta"><a href="#">October 6, 2015 at 7:15 am</a>--}}
                                            {{--</div>--}}
                                            {{--<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam--}}
                                            {{--vitae--}}
                                            {{--neqnsectetur adipiscing elit. Nam viae neqnsectetur adipiscing--}}
                                            {{--elit.--}}
                                            {{--Nam vitae neque vitae sapien malesuada aliquet. </p>--}}
                                            {{--<div class="reply"><a href="#" class="comment-reply-link">Reply</a>--}}
                                            {{--</div>--}}
                                            {{--</div>--}}
                                            {{--<ol class="children">--}}
                                            {{--<li class="comment odd parent">--}}
                                            {{--<div class="comment-body">--}}
                                            {{--<div class="comment-author vcard"><img class="avatar photo"--}}
                                            {{--src="http://triper.dexignlab.com/xhtml/images/testimonials/pic2.jpg"--}}
                                            {{--alt=""> <cite--}}
                                            {{--class="fn">Stacy--}}
                                            {{--poe</cite> <span class="says">says:</span></div>--}}
                                            {{--<div class="comment-meta"><a href="#">October 6, 2015 at--}}
                                            {{--7:15--}}
                                            {{--am</a></div>--}}
                                            {{--<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.--}}
                                            {{--Nam--}}
                                            {{--vitae neque vitae sapien malesuada aliquet.--}}
                                            {{--In viverra dictum justo in vehicula. Fusce et massa eu--}}
                                            {{--ante--}}
                                            {{--ornare molestie. Sed vestibulum sem felis,--}}
                                            {{--ac elementum ligula blandit ac.</p>--}}
                                            {{--<div class="reply"><a href="#"--}}
                                            {{--class="comment-reply-link">Reply</a>--}}
                                            {{--</div>--}}
                                            {{--</div>--}}
                                            {{--<ol class="children">--}}
                                            {{--<li class="comment odd parent">--}}
                                            {{--<div class="comment-body">--}}
                                            {{--<div class="comment-author vcard"><img--}}
                                            {{--class="avatar photo"--}}
                                            {{--src="http://triper.dexignlab.com/xhtml/images/testimonials/pic3.jpg"--}}
                                            {{--alt=""> <cite class="fn">Stacy--}}
                                            {{--poe</cite>--}}
                                            {{--<span class="says">says:</span></div>--}}
                                            {{--<div class="comment-meta"><a href="#">October 6,--}}
                                            {{--2015 at--}}
                                            {{--7:15 am</a></div>--}}
                                            {{--<p>Lorem ipsum dolor sit amet, consectetur--}}
                                            {{--adipiscing--}}
                                            {{--elit. Nam vitae neque vitae sapien malesuada--}}
                                            {{--aliquet.--}}
                                            {{--In viverra dictum justo in vehicula. Fusce et--}}
                                            {{--massa--}}
                                            {{--eu ante ornare molestie. Sed vestibulum sem--}}
                                            {{--felis,--}}
                                            {{--ac elementum ligula blandit ac.</p>--}}
                                            {{--<div class="reply"><a href="#"--}}
                                            {{--class="comment-reply-link">Reply</a>--}}
                                            {{--</div>--}}
                                            {{--</div>--}}
                                            {{--</li>--}}
                                            {{--</ol>--}}
                                            {{--<!-- list END -->--}}
                                            {{--</li>--}}
                                            {{--</ol>--}}
                                            {{--<!-- list END -->--}}
                                            {{--</li>--}}
                                            {{--<li class="comment">--}}
                                            {{--<div class="comment-body">--}}
                                            {{--<div class="comment-author vcard"><img class="avatar photo"--}}
                                            {{--src="http://triper.dexignlab.com/xhtml/images/testimonials/pic1.jpg"--}}
                                            {{--alt=""> <cite class="fn">Stacy--}}
                                            {{--poe</cite> <span class="says">says:</span></div>--}}
                                            {{--<div class="comment-meta"><a href="#">October 6, 2015 at 7:15 am</a>--}}
                                            {{--</div>--}}
                                            {{--<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam--}}
                                            {{--vitae--}}
                                            {{--neque vitae sapien malesuada aliquet.--}}
                                            {{--In viverra dictum justo in vehicula. Fusce et massa eu ante--}}
                                            {{--ornare--}}
                                            {{--molestie. Sed vestibulum sem felis,--}}
                                            {{--ac elementum ligula blandit ac.</p>--}}
                                            {{--<div class="reply"><a href="#" class="comment-reply-link">Reply</a>--}}
                                            {{--</div>--}}
                                            {{--</div>--}}
                                            {{--</li>--}}
                                            {{--<li class="comment">--}}
                                            {{--<div class="comment-body">--}}
                                            {{--<div class="comment-author vcard"><img class="avatar photo"--}}
                                            {{--src="http://triper.dexignlab.com/xhtml/images/testimonials/pic2.jpg"--}}
                                            {{--alt=""> <cite class="fn">Stacy--}}
                                            {{--poe</cite> <span class="says">says:</span></div>--}}
                                            {{--<div class="comment-meta"><a href="#">October 6, 2015 at 7:15 am</a>--}}
                                            {{--</div>--}}
                                            {{--<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam--}}
                                            {{--vitae--}}
                                            {{--neque vitae sapien malesuada aliquet.--}}
                                            {{--In viverra dictum justo in vehicula. Fusce et massa eu ante--}}
                                            {{--ornare--}}
                                            {{--molestie. Sed vestibulum sem felis,--}}
                                            {{--ac elementum ligula blandit ac.</p>--}}
                                            {{--<div class="reply"><a href="#" class="comment-reply-link">Reply</a>--}}
                                            {{--</div>--}}
                                            {{--</div>--}}
                                            {{--</li>--}}
                                        </ol>
                                        <!-- comment list END -->
                                        <!-- Form -->
                                        <div class="comment-respond" id="respond">
                                            <h4 class="comment-reply-title" id="reply-title">Leave a Reply
                                                <small><a style="display:none;" href="#" id="cancel-comment-reply-link"
                                                          rel="nofollow">Cancel reply</a></small>
                                            </h4>
                                            <form class="comment-form" id="commentform" method="post"
                                                  action="http://sedatelab.com/developer/donate/wp-comments-post.php">
                                                <p class="comment-form-author">
                                                    <label for="author">Name <span class="required">*</span></label>
                                                    <input type="text" value="Author" name="Author" placeholder="Author"
                                                           id="author">
                                                </p>
                                                <p class="comment-form-email">
                                                    <label for="email">Email <span class="required">*</span></label>
                                                    <input type="text" value="email" placeholder="Email" name="email"
                                                           id="email">
                                                </p>
                                                <p class="comment-form-url">
                                                    <label for="url">Website</label>
                                                    <input type="text" value="url" placeholder="Website" name="url"
                                                           id="url">
                                                </p>
                                                <p class="comment-form-comment">
                                                    <label for="comment">Comment</label>
                                                    <textarea rows="8" name="comment" placeholder="Comment"
                                                              id="comment"></textarea>
                                                </p>
                                                <p class="form-submit">
                                                    <input type="submit" value="Post Comment" class="submit" id="submit"
                                                           name="submit">
                                                </p>
                                            </form>
                                        </div>
                                        <!-- Form -->
                                    </div>
                                </div>
                            </div>
                    @endif
                    <!-- blog END -->
                    </div>
                    <!-- Left part END -->
                    <!-- Side bar start -->
                    <div class="col-lg-4 col-md-5 sticky-top">
                        <aside class="side-bar">
                            <div class="widget">
                                <h6 class="widget-title style-1">@lang('messages.global.search')</h6>
                                <div class="search-bx style-1">
                                    <form action="{{url(session('lang').'/search')}}" enctype="multipart/form-data"
                                          role="search" method="post">
                                        @csrf
                                        <input type="hidden" value="{{$content_type}}" name="search_in">
                                        <div class="input-group">
                                            <input name="text" class="form-control"
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
                                <h6 class="widget-title style-1">@lang('messages.global.related-posts')</h6>
                                <div class="widget-post-bx">
                                    {{--                                    @foreach($related_contents as $related_content)--}}
                                    @if(isset($related_content->contents))
                                        @foreach($related_content->contents as $post)
                                            <div class="widget-post clearfix">
                                                <div class="dlab-post-media">
                                                    <img src="{{$post['logo']}}"
                                                         width="200" height="143"
                                                         alt="{{$post['title']}}">
                                                </div>
                                                <div class="dlab-post-info">
                                                    <div class="dlab-post-header">
                                                        <h6 class="post-title">
                                                            <a href="{{url(session('lang').'/'.$post['type'].'/'.$post['id']
                                                        .'/'.str_replace(' ','-',$post['title']))}}">{{$post['title']}}</a>
                                                        </h6>
                                                    </div>
                                                    <div class="dlab-post-meta">
                                                        <ul class="d-flex align-items-center">
                                                            <li class="post-date">{{$post['created_at']}}</li>
                                                            <li class="post-comment"><a
                                                                        href="#">{{$post['show_count']}}</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        {{--@endif--}}
                                    @else
                                        <div class="col-12">
                                            <div class="alert alert-info text-center rounded" role="alert">
                                                <b>@lang('messages.global.no-result')</b>
                                            </div>
                                        </div>
                                    @endif
                                    {{--@endforeach--}}
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
                                        <form class="dzSubscribe" action="script/mailchamp.php" method="post">
                                            <input type="hidden" value="{{$content_type}}" name="search_in">
                                            <div class="input-group">
                                                <input name="dzEmail" required="required" type="email"
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