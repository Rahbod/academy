@extends('main_template.master_page.master')

@push('styles')

@endpush

@section('content')
    <section class="courseIndex mb-5">
        <div class="dlab-bnr-inr overlay-black-middle">
            <div class="container">
                <div class="dlab-bnr-inr-entry">
                    <h1 class="text-white">@lang('messages.home.course-title')</h1>
                    <!-- Breadcrumb row -->
                @include('main_template.modules.breadcrumb')
                <!-- Breadcrumb row END -->
                </div>
            </div>
        </div>

        <div class="section-full bg-white content-inner dlab-about-1">
            <div class="container">
                <div class="section-head text-black text-center">
                    <h2 class="m-b0 text-uppercase">@lang('messages.home.course-title')</h2>
                    <p class="font-18">
                        @lang('messages.home.course-description')
                    </p>
                </div>
                <div class="row">
                    @if(isset($courses) && count($courses) > 0)
                        @foreach($courses as $course)
                            <div class="col-md-6 col-lg-4 col-sm-6 m-b30">
                                <div class="dlab-box hotal-box" data-tilt="" data-tilt-max="10" data-tilt-speed="1">
                                    <div class="dlab-media dlab-img-effect dlab-img-overlay2">
                                        <img src="{{$course['image']}}" alt="{{$course['image']}}">
                                        <div class="dlab-info-has p-a20 text-white no-hover">
                                            <h4 class="m-t0 m-b10">english</h4>
                                            {{--<span>{{$course['terms']['']}}</span>--}}
                                            <h2 class="m-t10 m-b20">{{$course['duration']}} month</h2>
                                            <a href="{{ url(session('lang') .'/courses/'.$course['id'].'/'.str_replace(' ','-',$course['title_'.session('lang')]))}}"
                                               class="site-button outline outline-2 radius-xl"
                                               title="{{$course['title_'.session('lang')]}}">
                                                @lang('messages.global.details')
                                            </a>
                                            <a href="{{ url(session('lang') .'/courses/register/'.$course['id'].'/'.str_replace(' ','-',$course['title_'.session('lang')]))}}"
                                               class="site-button outline outline-2 radius-xl" title="register">
                                                @lang('messages.global.register')
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <div class="col-12">
                            <div class="text-left my-5">
                                {{$courses->links()}}
                            </div>
                        </div>

                    @else
                        <div class="col-12 text-center">
                            <div class="alert alert-info text-center rounded" role="alert">
                                <b>no result !</b>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')

@endpush