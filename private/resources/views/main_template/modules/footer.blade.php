<footer class="site-footer" style="height: 526.656px;">
    <div class="footer-top overlay-black-dark">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-5 footer-col-4">
                    <div class="widget widget_getintuch">
                        <h6 class="m-b15 h6 text-uppercase">Address</h6>
                        <div class="dlab-separator bg-white"></div>
                        <ul class="info-contact">
                            <li>
									<span>
										<i class="fa fa-map-marker	"></i>{{config('system.about_us.address')}}
									</span>
                            </li>

                            <li>
									<span>
										<i class="fa fa-phone"></i> Mobile: {{config('system.about_us.phone')}}
                                        <br>{{config('system.about_us.phone')}}
									</span>
                            </li>

                            <li>
									<span>
										<i class="fa fa-envelope"></i> Mail: {{config('system.about_us.email')}}
									</span>
                            </li>
                            <li>
									<span>
										<i class="fa fa-fax"></i> Fax: {{config('system.about_us.fax')}}
									</span>
                            </li>
                        </ul>
                    </div>
                    <ul class="list-inline mb-5 mb-lg-0">
                        <li><a title="facebook account" href="{{config('system.about_us.facebook')}}"
                               class="site-button facebook sharp"><i
                                        class="fab fa-facebook-f"></i></a></li>
                        <li><a title="google_plus account" href="{{config('system.about_us.google_plus')}}"
                               class="site-button google-plus sharp"><i
                                        class="fab fa-google-plus-g"></i></a></li>
                        <li><a title="telegram account" href="{{config('system.about_us.telegram')}}"
                               class="site-button telegram sharp"><i class="fab fa-telegram-plane"></i></a></li>
                        <li><a title="twitter account" href="{{config('system.about_us.twitter')}}"
                               class="site-button twitter sharp"><i
                                        class="fab fa-twitter"></i></a></li>
                        <li><a title="instagram account" href="{{config('system.about_us.instagram')}}"
                               class="site-button instagram sharp"><i
                                        class="fab fa-instagram"></i></a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-7 footer-col-4">
                    <div class="widget  widget_tag_cloud">
                        <h6 class="m-b15 h6 text-uppercase">Tag</h6>
                        <div class="dlab-separator bg-white"></div>
                        <div class="tagcloud">
                            @foreach(config('system.main.footer_tags') as $footer_tag)
                                <a title="{{$footer_tag}}"
                                   href="{{url(session('lang').'/tags/show/'.$footer_tag)}}">{{$footer_tag}}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 footer-col-4">
                    <div class="widget widget_getintuch">
                        <h6 class="m-b15 h6 text-uppercase">Contact us</h6>
                        <div class="dlab-separator bg-white"></div>
                        <div class="search-bx">
                            <form enctype="multipart/form-data" method="post" class="contactUsForm"
                                  action="{{url(session('lang').'/contact-us')}}">
                                <div class="input-group">
                                    <input name="name" type="text" required="" class="form-control"
                                           placeholder="Your Name">
                                </div>
                                <div class="input-group">
                                    <input name="email" type="email" class="form-control" required=""
                                           placeholder="Your Email Address">
                                </div>
                                <div class="input-group">
                                    <textarea name="description" rows="4" class="form-control" required=""
                                              placeholder="Your Message..."></textarea>
                                </div>
                                <div class="input-group">
                                    <button type="submit" class="site-button ">
                                        <span>Submit</span></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 footer-col-4">
                    <div class="widget widget_gallery">
                        <h6 class="m-b15 h6 text-uppercase">GALLERY</h6>
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
                <div class="col-lg-6 col-md-6 text-left">
                    <span>Copyright © 2019 {{config('system.main.developer_name')}}</span></div>
                <div class="col-lg-6 col-md-6 text-right "><span> Design With <i
                                class="fa fa-heart text-primary heart"></i> By {{config('system.main.developer_name')}} </span>
                </div>
            </div>
        </div>
    </div>
</footer>