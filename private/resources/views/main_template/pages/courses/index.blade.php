@extends('main_template.master_page.master')

@push('styles')

@endpush

@section('content')
    <section class="courseIndex">
        @include('main_template.modules.inner_pages_header')

        <div class="section-full bg-white content-inner dlab-about-1">
            <div class="container">
                <div class="section-head text-black text-center">
                    <h2 class="m-b0 text-uppercase">All Courses</h2>
                    <p class="font-18">
                        List of courses started and will be started in the Acadmy
                    </p>
                </div>
                <div class="row">
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
                                            more
                                        </a>
                                        <a href="{{ url(session('lang') .'/courses/register/'.$course['id'].'/'.str_replace(' ','-',$course['title_'.session('lang')]))}}"
                                           class="site-button outline outline-2 radius-xl" title="register">
                                            register
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
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')

@endpush