<footer class="site-footer">
    <div class="footer-top overlay-black-dark">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 footer-col-4">
                    <div class="widget widget_getintuch">
                        <h6 class="m-b15 h6 text-uppercase">@lang('messages.global.contact_us')</h6>
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
                        </ul>
                    </div>
                    <div class="row">
                        <ul class="list-inline mb-5 mb-lg-0" style="margin: 0 auto">
                            <li class="mb-2"><a target="_blank" title="@lang('messages.social.whatsapp')"
                                                href="whatsapp://send?abid={{config('system.about_us.whatsapp')}}"
                                                class="site-button whatsapp sharp rounded-circle"><i
                                            class="fab fa-whatsapp"></i></a></li>
                            <li class="mb-2"><a target="_blank" title="@lang('messages.social.linked_in')"
                                                href="{{config('system.about_us.linked_in')}}"
                                                class="site-button linkedin sharp rounded-circle"><i
                                            class="fab fa-linkedin-in"></i></a></li>
                            <li class="mb-2"><a target="_blank" title="@lang('messages.social.telegram')"
                                                href="{{config('system.about_us.telegram')}}"
                                                class="site-button telegram sharp rounded-circle"><i class="fab fa-telegram-plane"></i></a>
                            </li>
                            <li class="mb-2"><a target="_blank" title="@lang('messages.social.twitter')"
                                                href="{{config('system.about_us.twitter')}}"
                                                class="site-button twitter sharp rounded-circle"><i
                                            class="fab fa-twitter"></i></a></li>
                            <li class="mb-2"><a target="_blank" title="@lang('messages.social.instagram')"
                                                href="{{config('system.about_us.instagram')}}"
                                                class="site-button instagram sharp rounded-circle"><i
                                            class="fab fa-instagram"></i></a></li>
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
                                            <a target="_blank" class="text-white" title="{{$item['name']}}"
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
                    <div class="widget widget_gallery">
{{--                        <h6 class="m-b15 h6 text-uppercase">@lang('messages.global.gallery')</h6>--}}
{{--                        <div class="dlab-separator bg-white"></div>--}}

                    </div>

{{--                    <div class="widget  widget_tag_cloud">--}}
{{--                        <h6 class="m-b15 h6 text-uppercase">@lang('messages.global.tag')</h6>--}}
{{--                        <div class="dlab-separator bg-white"></div>--}}
{{--                        <div class="tagcloud">--}}
{{--                            @foreach(explode(',',config('system.main.footer_tags')) as $footer_tag)--}}
{{--                                <a title="{{$footer_tag}}"--}}
{{--                                   href="{{url(session('lang').'/tags/show/'.$footer_tag)}}">{{$footer_tag}}</a>--}}
{{--                            @endforeach--}}
{{--                        </div>--}}
{{--                    </div>--}}

                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 footer-col-4">
                    <div class="widget comments">
                        <h6 class="m-b15 h6 text-uppercase">@lang('messages.global.comments')</h6>
                        <div class="dlab-separator bg-white"></div>
                        <div class="clearfix">
                            <form id="comment_form" method="post"
                                  action="{{url(session('lang').'/contact-us')}}">
                                <input type="hidden" name="relevant_section" value="courses">
                                <div class="form-group">
                                    {{--                                    <label for="email">ایمیل:</label>--}}
                                    <input required class="form-control" type="email" id="email" name="email"
                                           placeholder="@lang('messages.global.fill_email')">
                                </div>
                                <div class="form-group">
                                    {{--                                    <label for="email">ایمیل:</label>--}}
                                    <input required class="form-control" type="text" id="name" name="name"
                                           placeholder="@lang('messages.global.fill_name')">
                                </div>
                                <div class="form-group">
                                    {{--                                    <label for="description">توضیحات:</label>--}}
                                    <textarea required class="form-control" name="content"
                                              id="content" cols="30" rows="4"
                                              placeholder="@lang('messages.global.fill_text')"></textarea>
                                </div>
                                <div class="form-group">
                                    <div class="d-flex justify-content-between" id="captcha_image">
                                        <div class="captchaImageContainer">
                                            {!! captcha_img('flat'); !!}
                                        </div>

                                        <input type="text"
                                               class="form-control ml-2"
                                               autocomplete="captcha"
                                               spellcheck="false"
                                               tabindex="7"
                                               placeholder="@lang('messages.global.fill_verify_code')"
                                               name="captcha" required
                                               id="captcha">

                                        <a style="padding: 9px 11px 0px;" data-lang="{{session('lang')}}"
                                           href="void:;"
                                           class="renewCaptchaImage btn border">
                                            <i class="far fa-redo"></i>
                                        </a>
                                    </div>
                                </div>

                                <div class="form-group text-left">
                                    <button type="submit" class="site-button radius-no">
                                        @lang('messages.global.save_comment')
                                    </button>
                                </div>
                            </form>
                        </div>
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
                <div class="col-lg-6 col-md-6 -textRight "><span>@lang('messages.global.design-by') {{config('system.main.developer_name')}} </span>
                </div>
            </div>
        </div>
    </div>
</footer>
<button class="scrollUp"><i class="fas fa-chevron-double-up"></i></button>
{{--<button class="scrollUp"><i class="fas fa-chevron-up"></i></button>--}}
@push('scripts')
    <script>
        $('.renewCaptchaImage').on('click', function () {
            var lang = $(this).attr('data-lang');
            $.ajax({
                type: 'get',
                url: '/' + lang + '/renew-captcha-image',
                success: function (response) {
                    $('.captchaImageContainer').html(response);
                },
                fail: function (error) {
                }
            });
        });
    </script>
@endpush
