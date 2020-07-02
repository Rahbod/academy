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
                    <div class="col-lg-12 col-md-12 m-b10">
                        <!-- blog start -->
                        <div class="blog-post blog-single blog-style-1">
                            <div class="dlab-post-title">
                                <h4 class="post-title m-t0">
                                    @lang('messages.global.about-us')
                                </h4>
                            </div>
                            <div class="dlab-post-media dlab-img-effect zoom-slow m-t20">
                                {{--<a href="#">--}}
                                <img src="{{ config('system.about_us.image') }}" alt="@lang('messages.global.about-us')">
                                {{--</a>--}}
                            </div>

                            <div class="dlab-post-text">
                                {!! config('system.about_us.introduction') !!}
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
                    </div>
                    <!-- Left part END -->
                    <!-- Side bar start -->

                    <!-- Side bar END -->
                </div>
            </div>
        </div>

    </section>

@endsection

@push('scripts')

@endpush