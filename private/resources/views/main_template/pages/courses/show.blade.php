{{--@extends('main_template.master_page.master')--}}

{{--@push('styles')--}}
    {{--<link type="text/css" rel="stylesheet" href="{{asset('/assets/site/js/vendors/dropzone/basic.css')}}">--}}
    {{--<link type="text/css" rel="stylesheet" href="{{asset('/assets/site/js/vendors/dropzone/dropzone.css')}}">--}}


    {{--<style>--}}
        {{--.dropzone {--}}
            {{--border: 2px dashed #999999;--}}
            {{--border-radius: 10px;--}}
            {{--background-image: url('{{asset('/assets/site/media/images/public/uploading-archive.svg')}}');--}}
            {{--background-repeat: no-repeat;--}}
            {{--background-position: center center;--}}
            {{--margin-bottom: 1rem;--}}
        {{--}--}}

        {{--.dropzone .dz-default.dz-message {--}}
            {{--height: 171px;--}}
            {{--background-size: 132px 132px;--}}
            {{--margin-top: -101.5px;--}}
            {{--background-position-x: center;--}}

        {{--}--}}

        {{--.dropzone .dz-default.dz-message span {--}}
            {{--display: block;--}}
            {{--margin-top: 145px;--}}
            {{--font-size: 20px;--}}
            {{--text-align: center;--}}
        {{--}--}}
    {{--</style>--}}
{{--@endpush--}}

{{--@section('content')--}}
    {{--<section class="courseShow m-b30">--}}
        {{--<div class="dlab-bnr-inr overlay-black-middle">--}}
            {{--<div class="container">--}}
                {{--<div class="dlab-bnr-inr-entry">--}}
                    {{--<h1 class="text-white">Courses</h1>--}}
                    {{--<!-- Breadcrumb row -->--}}
                {{--@include('main_template.modules.breadcrumb')--}}
                {{--<!-- Breadcrumb row END -->--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="section-full content-inner">--}}
            {{--<div class="container">--}}
                {{--<div class="row m-b30">--}}
                    {{--<div class="col-lg-8">--}}
                        {{--<div class="d-flex info-bx m-b30">--}}
                            {{--<div class="tour-title">--}}
                                {{--<h2>{{$course['title']}}</h2>--}}
                                {{--                                <p>{{$course['description']}}</p>--}}
                                {{--<p>--}}
                                    {{--<span class="site-button button-sm button-gray">course</span>--}}
                                    {{--<span class="site-button button-sm">rezae</span>--}}
                                {{--</p>--}}
                            {{--</div>--}}
                            {{--<div class="tour-price ml-auto">--}}
                            {{--<span>fee of the course</span>--}}
                            {{--<h2 class="price">{{$course['class_rooms'][0]['price']}} T</h2>--}}
                            {{--<del class="actual-price">{{$course['class_rooms'][0]['price'] + 200000}} T</del>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="product-gallery m-b30">--}}
                            {{--<img src="{{$course['image']}}" class="img-fluid" alt="">--}}
                        {{--</div>--}}
                        {{--<div class="tour-days">--}}
                            {{--<h2 class="m-b10">About Course</h2>--}}
                            {{--<p>{!! $course['description']!!}</p>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="col-lg-4">--}}
                        {{--<div class="sticky-top">--}}
                            {{--<form class="hotel-booking">--}}
                                {{--<div class="row">--}}
                                    {{--<div class="col-12 border-bottom mb-3">--}}
                                        {{--<div class="form-check">--}}
                                            {{--<label class="form-check-label">--}}
                                                {{--<input type="radio" class="form-check-input" name="optradio">Option 1--}}
                                            {{--</label>--}}
                                        {{--</div>--}}
                                        {{--<div class="form-check">--}}
                                            {{--<label class="form-check-label">--}}
                                                {{--<input type="radio" class="form-check-input" name="optradio">Option 2--}}
                                            {{--</label>--}}
                                        {{--</div>--}}
                                        {{--<div class="form-check disabled">--}}
                                            {{--<label class="form-check-label">--}}
                                                {{--<input type="radio" class="form-check-input" name="optradio" disabled>Option 3--}}
                                            {{--</label>--}}
                                        {{--</div>--}}
                                        {{----}}
                                        {{--<div class="form-group">--}}
                                            {{--<label for="classes">choose your class</label>--}}
                                            {{--<select class="form-control" name="classes" id="classes">--}}
                                                {{--@foreach($course['class_rooms'] as $class_room)--}}
                                                    {{--<option value="{{$class_room['id']}}">{{$class_room['title_'.session('lang').'']}}</option>--}}
                                                {{--@endforeach--}}
                                            {{--</select>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<div class="col-12 border-bottom mb-3">--}}
                                        {{--<div class="form-group">--}}
                                            {{--<div class="d-sm-flex justify-content-between">--}}
                                                {{--<label>master :</label>--}}
                                                {{--<span>{{$course['class_rooms']['teacher']['name']}}</span>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                        {{--<div class="form-group">--}}
                                            {{--<div class="d-sm-flex justify-content-between">--}}
                                                {{--<label>start day :</label>--}}
                                                {{--<span>{{$course['class_rooms']['course_start_date']}}</span>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                        {{--<div class="form-group">--}}
                                            {{--<div class="d-sm-flex justify-content-between">--}}
                                                {{--<label>end day :</label>--}}
                                                {{--<span>{{$course['class_rooms']['course_end_date']}}</span>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                        {{--<div class="form-group">--}}
                                            {{--<div class="d-sm-flex justify-content-between">--}}
                                                {{--<label>fee :</label>--}}
                                                {{--<span>{{number_format($course['class_rooms']['price'])}} T</span>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                        {{--<div class="form-group">--}}
                                            {{--<div class="d-sm-flex justify-content-between">--}}
                                                {{--<label>remaining capacity :</label>--}}
                                                {{--<span>{{number_format($course['class_rooms']['capacity'])}}</span>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                        {{--<div class="form-group">--}}
                                            {{--<label for="">week days :</label>--}}
                                            {{--<ul>--}}
                                                {{--@foreach($course['class_rooms']['class_room_times'] as $value)--}}
                                                    {{--<li>--}}
                                                        {{--<div class="d-sm-flex justify-content-between">--}}
                                                            {{--<label for="">{{$value['week_day']}} :</label>--}}
                                                            {{--<span>{{$value['start_time']}}--}}
                                                                {{--- {{$value['end_time']}}</span>--}}
                                                        {{--</div>--}}
                                                    {{--</li>--}}
                                                {{--@endforeach--}}
                                            {{--</ul>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}

                                    {{--<div class="col-md-12 col-lg-12 col-xl-12 col-sm-12 col-12">--}}
                                        {{--<button type="submit" class="site-button btn-block">join now</button>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</form>--}}
                            {{--<div class="m-t30">--}}
                                {{--<img src="{{asset('assets/site/media/images/top_courses/pic4.jpg')}}" class="img-fluid"--}}
                                     {{--alt="">--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</section>--}}
{{--@endsection--}}

{{--@push('scripts')--}}

    {{--<script type="text/javascript" src="{{asset('assets/site/js/vendors/dropzone/dropzone.js')}}"></script>--}}

    {{--<script>--}}
        {{--//    Dropzone.autoDiscover = false;--}}
        {{--Dropzone.options.myAwesomeDropzone = {--}}
            {{--url: '/upload',--}}
            {{--autoProcessQueue: false,--}}
            {{--autoDiscover: false,--}}
            {{--uploadMultiple: true,--}}
            {{--parallelUploads: 5,--}}
            {{--maxFiles: 5,--}}
            {{--maxFilesize: 1,--}}
            {{--acceptedFiles: 'image/*',--}}
            {{--addRemoveLinks: true,--}}
            {{--init: function () {--}}
                {{--dzClosure = this; // Makes sure that 'this' is understood inside the functions below.--}}

                {{--// for Dropzone to process the queue (instead of default form behavior):--}}
                {{--document.getElementById("submitBtn").addEventListener("click", function (e) {--}}
                    {{--// Make sure that the form isn't actually being sent.--}}
                    {{--e.preventDefault();--}}
                    {{--e.stopPropagation();--}}
                    {{--dzClosure.processQueue();--}}
                {{--});--}}

                {{--//send all the form data along with the files:--}}
                {{--this.on("sendingmultiple", function (data, xhr, formData) {--}}
                    {{--console.log(formData);--}}
{{--//                formData.append("firstname", jQuery("#firstname").val());--}}
{{--//                formData.append("lastname", jQuery("#lastname").val());--}}
                {{--});--}}
            {{--}--}}
        {{--};--}}

    {{--</script>--}}
{{--@endpush--}}