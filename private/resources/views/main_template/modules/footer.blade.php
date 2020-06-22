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
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 footer-col-4">
                    <div class="widget widget_getintuch">
                        <h6 class="m-b15 h6 text-uppercase">@lang('messages.global.links')</h6>
                        <div class="dlab-separator bg-white"></div>
                        <div class="search-bx">
                            <ul class="mb-5 mb-lg-0">
                                @if(isset($footer_menus))
                                    @foreach($footer_menus as $item)
                                        <li class="mb-2">
                                            <a class="text-white" title="{{$item['name']}}"
                                               href="{{$item['link']}}">
                                                {{$item['name']}}
                                            </a>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
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
            <div class="row text-center">
                <ul class="list-inline mb-5 mb-lg-0" style="margin: 0 auto">
                    <li class="mb-2"><a title="@lang('messages.social.whatsapp')"
                                        href="{{config('system.about_us.whatsapp')}}"
                                        class="site-button whatsapp sharp"><i
                                    class="fab fa-whatsapp"></i></a></li>
                    <li class="mb-2"><a title="@lang('messages.social.linked_in')"
                                        href="{{config('system.about_us.linked_in')}}"
                                        class="site-button linkedin sharp"><i
                                    class="fab fa-linkedin-in"></i></a></li>
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