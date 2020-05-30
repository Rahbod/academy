@extends('main_template.master_page.master')

@push('styles')

@endpush

@section('content')
    <section class="aboutUs mb-5">
{{--        <div class="dlab-bnr-inr overlay-black-middle">--}}
{{--            <div class="container">--}}
{{--                <div class="dlab-bnr-inr-entry">--}}
{{--                    <h1 class="text-white">@lang('messages.global.about-us')</h1>--}}
{{--                    <!-- Breadcrumb row -->--}}
{{--                @include('main_template.modules.breadcrumb')--}}
{{--                <!-- Breadcrumb row END -->--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
        <div class="content-block">
            <div class="section-full content-inner overlay-white-middle">
                <div class="container">
                    <div class="row align-items-center m-b20">
                        <div class="col-md-12 col-lg-6">
                            <h2>Hello. Our complex has been present for over 20 years. We make the best for all our
                                customers and students.</h2>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                                has been the industry's standard dummy text ever since the 1500s, when an unknown
                                printer took a galley of type and.</p>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <p>It is a long established fact that a reader will be distracted by the readable content of
                                a page when looking at its layout. The point of using Lorem Ipsum is that it has a
                                more-or-less.</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 m-b30"><img
                                    src="{{asset('assets/site/media/images/about_us/p1.jpg')}}" alt=""></div>
                        <div class="col-lg-6 col-md-6 m-b30"><img
                                    src="{{asset('assets/site/media/images/about_us/p2.jpg')}}" alt=""></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-6 col-sm-6 m-b30">
                            <div class="counter-style-1 counter--container">
                                <div class="">
                                    <i class="far fa-chart-line text-primary"></i>
                                    {{--<i class="icon ti-bar-chart text-primary"></i>--}}
                                    <span class="counter">46</span>
                                </div>
                                <span class="counter-text">@lang('messages.global.completed-courses')</span>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-6 col-sm-6 m-b30">
                            <div class="counter-style-1 counter--container">
                                <div class="">
                                    <i class="far fa-users text-primary"></i>
                                    {{--<i class="icon ti-user text-primary"></i>--}}
                                    <span class="counter">29</span>
                                </div>
                                <span class="counter-text">@lang('messages.global.happy-clients')</span>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-3 col-6 col-sm-6 m-b30">
                            <div class="counter-style-1 counter--container">
                                <div class="">
                                    <i class="fas fa-headphones-alt text-primary"></i>
                                    {{--<i class="icon ti-headphone-alt text-primary"></i>--}}
                                    <span class="counter">21</span>
                                </div>
                                <span class="counter-text">@lang('messages.global.all-articles')</span>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-6 col-sm-6 m-b30">
                            <div class="counter-style-1 counter--container">
                                <div class="">
                                    <i class="far fa-trophy text-primary"></i>
                                    {{--<i class="icon ti-cup text-primary"></i>--}}
                                    <span class="counter">12</span>
                                </div>
                                <span class="counter-text">@lang('messages.global.awards')</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Why Chose Us -->
            <!-- Stats -->
            <div class="translation"
                 style="background-image:url('{{asset('/assets/site/media/images/translation/translation_2000x767.jpg')}}')">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-md-12">
                            <div class="add-area">
                                <h3>translate your documents with us</h3>
                                <h2>Discount <span style="color:#21ab64;">10-30%</span> Off</h2>
                                <p>If you’re looking for a truly precise translator with cool history,here you will see
                                    what
                                    you are searching for
                                </p>
                                <a href="{{route('translations',['lang'=>session('lang')])}}" class="site-button white">
                                    @lang('messages.global.see-more-details')
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6"></div>
                    </div>
                </div>
            </div>
            <!-- Stats END -->
        </div>
    </section>

@endsection

@push('scripts')

    <script>
        jQuery(window).scroll(startCounter);

        function startCounter() {
            var hT = jQuery('.counter--container').offset().top,
                hH = jQuery('.counter--container').outerHeight(),
                wH = jQuery(window).height();
            if (jQuery(window).scrollTop() > hT + hH - wH) {
                jQuery(window).off("scroll", startCounter);
                jQuery('.counter').each(function () {
                    var $this = jQuery(this);
                    jQuery({Counter: 0}).animate({Counter: $this.text()}, {
                        duration: 2000,
                        easing: 'swing',
                        step: function () {
                            $this.text(Math.ceil(this.Counter));
                        }
                    });
                });
            }
        }

    </script>
@endpush