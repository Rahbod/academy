@extends('main_template.master_page.master')

@push('styles')

@endpush

@section('content')
    <section class="newsIndex mb-5">
{{--        <div class="dlab-bnr-inr overlay-black-middle">--}}
{{--            <div class="container">--}}
{{--                <div class="dlab-bnr-inr-entry">--}}
{{--                    <h1 class="text-white">--}}
{{--                        @lang('pages.breadcrumb-title')--}}
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
                            <div class="dlab-post-title">
                                <h4 class="post-title m-t0">
                                    @lang('pages.subject')
                                </h4>
                            </div>
                            <div class="dlab-post-media dlab-img-effect zoom-slow m-t20">
                                <img src="/storage/content/image/france.jpg"
                                     alt="Tempore sed sed quod nihil qui cupiditate enim.">
                            </div>
                            <div class="dlab-post-text">
                                @lang('pages.body')
                            </div>

                        </div>
                        <!-- blog END -->
                    </div>
                    <!-- Left part END -->
                </div>
            </div>
        </div>

    </section>

@endsection

@push('scripts')

@endpush