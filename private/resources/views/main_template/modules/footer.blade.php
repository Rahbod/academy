<footer class="site-footer">
    <div class="footer-top overlay-black-dark">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 footer-col-4">
                    <div class="widget widget_getintuch">
                        <h6 class="m-b15 h6 text-uppercase">@lang('messages.global.address')</h6>
                        <div class="dlab-separator bg-white"></div>
                        <ul class="info-contact">
                            <li>
									<span>
										<i class="fa fa-map-marker	"></i>{{config('system.about_us.address')}}
									</span>
                            </li>

                            <li>
									<span>
										<i class="fa fa-phone"></i> @lang('messages.global.mobile')
                                        : {{config('system.about_us.phone')}}
									</span>
                            </li>

                            <li>
									<span>
										<i class="fa fa-envelope"></i> @lang('messages.global.email')
                                        : {{config('system.about_us.email')}}
									</span>
                            </li>
                            <li>
									<span>
										<i class="fa fa-fax"></i> @lang('messages.global.fax')
                                        : {{config('system.about_us.fax')}}
									</span>
                            </li>
                        </ul>
                    </div>
                    <ul class="list-inline mb-5 mb-lg-0">
                        <li class="mb-2"><a title="@lang('messages.social.facebook')"
                                            href="{{config('system.about_us.facebook')}}"
                                            class="site-button facebook sharp"><i
                                        class="fab fa-facebook-f"></i></a></li>
                        <li class="mb-2"><a title="@lang('messages.social.google-plus')"
                                            href="{{config('system.about_us.google_plus')}}"
                                            class="site-button google-plus sharp"><i
                                        class="fab fa-google-plus-g"></i></a></li>
                        <li class="mb-2"><a title="@lang('messages.social.telegram')"
                                            href="{{config('system.about_us.telegram')}}"
                                            class="site-button telegram sharp"><i class="fab fa-telegram-plane"></i></a>
                        </li>
                        <li class="mb-2"><a title="@lang('messages.social.twitter')"
                                            href="{{config('system.about_us.twitter')}}"
                                            class="site-button twitter sharp"><i
                                        class="fab fa-twitter"></i></a></li>
                        <li class="mb-2"><a title="@lang('messages.social.instagram')"
                                            href="{{config('system.about_us.instagram')}}"
                                            class="site-button instagram sharp"><i
                                        class="fab fa-instagram"></i></a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 footer-col-4">
                    <div class="widget widget_getintuch">
                        <h6 class="m-b15 h6 text-uppercase">@lang('messages.global.links')</h6>
                        <div class="dlab-separator bg-white"></div>
                        <div class="search-bx">
                            <ul class="mb-5 mb-lg-0">
                                <li class="mb-2">
                                    <a class="text-white" title="@lang('messages.global.contact-us')"
                                       href="{{url(session('lang'). '/contact-us')}}">
                                        @lang('messages.global.contact-us')
                                    </a>
                                </li>
                                <li class="mb-2">
                                    <a class="text-white" title="@lang('messages.global.about-us')"
                                       href="{{url(session('lang'). '/about-us')}}">
                                        @lang('messages.global.about-us')
                                    </a>
                                </li>
                                <li class="mb-2">
                                    <a class="text-white" title="@lang('messages.global.news')"
                                       href="{{url(session('lang'). '/news')}}">
                                        @lang('messages.global.news')
                                    </a>
                                </li>
                                <li class="mb-2">
                                    <a class="text-white" title="@lang('messages.global.article')"
                                       href="{{url(session('lang'). '/article')}}">
                                        @lang('messages.global.article')
                                    </a>
                                </li>
                                <li class="mb-2">
                                    <a class="text-white" title="@lang('messages.global.courses')"
                                       href="{{url(session('lang'). '/courses')}}">
                                        @lang('messages.global.courses')
                                    </a>
                                </li>
                                <li class="mb-2">
                                    <a class="text-white" title="@lang('messages.global.translation-request')"
                                       href="{{url(session('lang'). '/translation-requests/create')}}">
                                        @lang('messages.global.translation-request')
                                    </a>
                                </li>
                            </ul>

                            {{--<form enctype="multipart/form-data" method="post" class="contactUsForm"--}}
                            {{--action="{{url(session('lang').'/contact-us')}}">--}}
                            {{--<div class="input-group">--}}
                            {{--<input name="name" type="text" required="" class="form-control"--}}
                            {{--placeholder="Your Name">--}}
                            {{--</div>--}}
                            {{--<div class="input-group">--}}
                            {{--<input name="email" type="email" class="form-control" required=""--}}
                            {{--placeholder="Your Email Address">--}}
                            {{--</div>--}}
                            {{--<div class="input-group">--}}
                            {{--<textarea name="description" rows="4" class="form-control" required=""--}}
                            {{--placeholder="Your Message..."></textarea>--}}
                            {{--</div>--}}
                            {{--<div class="input-group">--}}
                            {{--<button type="submit" class="site-button ">--}}
                            {{--<span>Submit</span></button>--}}
                            {{--</div>--}}
                            {{--</form>--}}
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 footer-col-4">
                    <div class="widget  widget_tag_cloud">
                        <h6 class="m-b15 h6 text-uppercase">@lang('messages.global.tag')</h6>
                        <div class="dlab-separator bg-white"></div>
                        <div class="tagcloud">
                            @foreach(explode(',',config('system.main.footer_tags')) as $footer_tag)
                                <a title="{{$footer_tag}}"
                                   href="{{url(session('lang').'/tags/show/'.$footer_tag)}}">{{$footer_tag}}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 footer-col-4">
                    <div class="widget widget_gallery">
                        <h6 class="m-b15 h6 text-uppercase">@lang('messages.global.gallery')</h6>
                        <div class="dlab-separator bg-white"></div>
                        <ul class="clearfix mfp-gallery">
                            <li class="img-effect2">
                                <a class="mfp-link html5lightbox" data-group="mygroup"
                                   href="{{asset('/assets/site/media/images/promotion/img3.jpg')}}"
                                   title="Title Come Here"><img
                                            src="{{asset('/assets/site/media/images/promotion/img3.jpg')}}" alt=""></a>
                            </li>

                            <li class="img-effect2">
                                <a class="mfp-link html5lightbox" data-group="mygroup"
                                   href="{{asset('/assets/site/media/images/promotion/img3.jpg')}}"
                                   title="Title Come Here"><img
                                            src="{{asset('/assets/site/media/images/promotion/img3.jpg')}}" alt=""></a>
                            </li>

                            <li class="img-effect2">
                                <a class="mfp-link html5lightbox" data-group="mygroup"
                                   href="{{asset('/assets/site/media/images/promotion/img3.jpg')}}"
                                   title="Title Come Here"><img
                                            src="{{asset('/assets/site/media/images/promotion/img3.jpg')}}" alt=""></a>
                            </li>

                            <li class="img-effect2">
                                <a class="mfp-link html5lightbox" data-group="mygroup"
                                   href="{{asset('/assets/site/media/images/promotion/img4.jpg')}}"
                                   title="Title Come Here"><img
                                            src="{{asset('/assets/site/media/images/promotion/img4.jpg')}}" alt=""></a>
                            </li>
                            <li class="img-effect2">
                                <a class="mfp-link html5lightbox" data-group="mygroup"
                                   href="{{asset('/assets/site/media/images/promotion/img5.jpg')}}"
                                   title="Title Come Here"><img
                                            src="{{asset('/assets/site/media/images/promotion/img5.jpg')}}" alt=""></a>
                            </li>
                            <li class="img-effect2">
                                <a class="mfp-link html5lightbox" data-group="mygroup"
                                   href="{{asset('/assets/site/media/images/promotion/img3.jpg')}}"
                                   title="Title Come Here"><img
                                            src="{{asset('/assets/site/media/images/promotion/img3.jpg')}}" alt=""></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- footer bottom part -->
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 -textLeft">
                    <span>@lang('messages.global.copyright') <span dir="ltr" class="">© <?php echo date("Y"); ?></span></span>
                </div>
                <div class="col-lg-6 col-md-6 -textRight "><span>@lang('messages.global.design-by') <i
                                class="fa fa-heart text-primary heart mx-2"></i>@lang('messages.global.with') {{config('system.main.developer_name')}} </span>
                </div>
            </div>
        </div>
    </div>
</footer>
<button class="scrollUp"><i class="fas fa-chevron-double-up"></i></button>
{{--<button class="scrollUp"><i class="fas fa-chevron-up"></i></button>--}}