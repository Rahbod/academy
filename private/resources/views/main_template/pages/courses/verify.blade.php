{{--<div class="">--}}
{{--<h3 class="text-center mb-4 border-bottom p-3">--}}
{{----}}
{{--</h3>--}}
{{--<div class="d-flex justify-content-between mb-4">--}}
{{--<img style="height: 200px!important;" src="{{$course['image']}}" alt="{{$course['image']}}">--}}
{{--<div class="ml-3">--}}
{{--<h4 class="m-t0 m-b10">{{$term['title_'.session('lang')]}}</h4>--}}
{{--<p class="m-t0 m-b10">{{$term['description_'.session('lang')]}}</p>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}

<div class="container my-5">
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="container-fluid border-bottom mb-5 py-3">
                    <div class="row">
                        <div class="col-12">
                            <h4>
                                @lang('messages.global.course-information')
                            </h4>
                        </div>
                        <div class="col-md-4 text-lg-left"><label>@lang('messages.global.course-title')</label></div>
                        <div class="col-md-8">{{$term['course']['title_'.session('lang')]}}</div>

                        <div class="col-md-4 text-lg-left"><label>
                                @lang('messages.global.course-description') :</label></div>
                        <div class="col-md-8">{{$term['course']['description_'.session('lang')]}}</div>

                        <div class="col-md-4 text-lg-left"><label>@lang('messages.global.course-duration') :</label>
                        </div>
                        <div class="col-md-8">{{ session('lang') == 'en' ? $term['course']['duration'] : numberConvertor($term['course']['duration'])}}  @lang('messages.global.month')</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="row">
                <div class="container-fluid border-bottom mb-5 py-3">
                    <div class="row">
                        <div class="col-12">
                            <h4>
                                @lang('messages.global.term-information')
                            </h4>
                        </div>
                        <div class="col-md-4 text-lg-left"><label>
                                @lang('messages.global.term-title') :
                            </label>
                        </div>
                        <div class="col-md-8">{{$term['title_'.session('lang')]}}</div>

                        <div class="col-md-4 text-lg-left"><label>@lang('messages.global.term-description') :</label>
                        </div>
                        <div class="col-md-8">{{$term['description_'.session('lang')]}}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="row">
                <div class="container-fluid border-bottom mb-5 py-3">
                    <div class="row">
                        <div class="col-12">
                            <h4>@lang('messages.global.class-information')</h4>
                        </div>
                        <div class="col-md-4 text-lg-left"><label>@lang('messages.global.class-title') :</label></div>
                        <div class="col-md-8">{{$class_room['title_'.session('lang')]}}</div>

                        <div class="col-md-4 text-lg-left"><label>@lang('messages.global.class-capacity') :</label>
                        </div>
                        <div class="col-md-8">{{session('lang') == 'en' ? $class_room['capacity'] :  numberConvertor($class_room['capacity'])}} @lang('messages.global.person')</div>

                        <div class="col-md-4 text-lg-left"><label>@lang('messages.global.class-price') :</label></div>
                        <div class="col-md-8">{{session('lang') == 'en' ? $class_room['price'] :  numberConvertor(number_format($class_room['price']))}}</div>

                        <div class="col-md-4 text-lg-left"><label>@lang('messages.global.class-master') :</label></div>
                        <div class="col-md-8">{{$class_room['teacher']['name']}}</div>

                        <div class="col-md-4 text-lg-left"><label>@lang('messages.global.class-registration-start-day')
                                :</label></div>
                        <div class="col-md-8">{{ session('lang') == 'en' ?  $class_room['registration_start_date']  :  numberConvertor($class_room['registration_start_date'] )}}</div>

                        <div class="col-md-4 text-lg-left"><label>@lang('messages.global.class-registration-end-day')
                                :</label></div>
                        <div class="col-md-8">{{ session('lang') == 'en' ?  $class_room['registration_end_date']  :  numberConvertor($class_room['registration_end_date'] )}}</div>

                        <div class="col-md-4 text-lg-left"><label>@lang('messages.global.class-start-day') :</label>
                        </div>
                        <div class="col-md-8">{{ session('lang') == 'en' ?  $class_room['course_start_date']  :  numberConvertor($class_room['course_start_date'])}}</div>

                        <div class="col-md-4 text-lg-left"><label>@lang('messages.global.class-end-day') :</label></div>
                        <div class="col-md-8">{{ session('lang') == 'en' ?  $class_room['course_end_date']  :  numberConvertor($class_room['course_end_date'])}}</div>

                        <div class="col-md-4 text-lg-left"><label>@lang('messages.global.class-times') :</label></div>
                        <div class="col-md-8">
                            <div class="container-fluid">
                                <div class="row">
                                    @foreach($class_room['class_room_times'] as $class_room_time)
                                        <div class="col-4">
                                            {{$class_room_time['week_day']}}
                                        </div>
                                        <div class="col-8">
                                            {{session('lang') == 'en' ? $class_room_time['start_time'] : numberConvertor($class_room_time['start_time']) }}
                                            --
                                            {{session('lang') == 'en' ? $class_room_time['end_time'] : numberConvertor($class_room_time['end_time']) }}
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="container-fluid border-bottom mb-5 py-3">
                <div class="row">
                    <div class="col-12">
                        <h4>@lang('messages.global.user-information')</h4>
                    </div>
                    @auth
                        <?php
                        $user = auth()->user();
                        $user_profile = null;
                        if ($user->profile) {
                            $user_profile = $user->profile;
                        }
                        ?>

                        <div class="col-md-4 text-lg-left"><label>@lang('messages.global.name') :</label></div>
                        <div class="col-md-8">{{$user->name ?? $user->username}}</div>

                        <div class="col-md-4 text-lg-left"><label>@lang('messages.global.email') :</label></div>
                        <div class="col-md-8">{{$user->email}}</div>


                        @if(isset($user_profile))
                            <div class="col-md-4 text-lg-left"><label>@lang('messages.global.mobile') :</label></div>
                            <div class="col-md-8">{{ session('lang') == 'en'  ? $user_profile->mobile_number : numberConvertor($user_profile->mobile_number) }}</div>
                        @endif
                    @endauth
                    @guest
                        <div class="col-12">
                            <div class="alert alert-info text-center rounded" role="alert">
                                <b>@lang('messages.global.login')</b>
                            </div>
                        </div>
                    @endguest
                </div>
            </div>
        </div>

        <div class="col-12">
            <form action="{{url(session('lang') .'/payment')}}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="class_id" value="{{$class_room['id']}}">
                <input type="hidden" name="term_id" value="{{$term['id']}}">

                <div class="form-group row">
                    <label for="gateway" class="col-sm-4 col-form-label">@lang('messages.global.pay')</label>
                    <div class="col-sm-8">
                        <select id="gateway" name="gateway_id" class="custom-select my-1 mr-sm-2">
                            <option value="zarinpal">Zarin Pal</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12 text-center">
                        <a title="go to home page" href="{{url(session('lang').'/')}}"
                           class="btn btn-danger">@lang('messages.global.cancel')</a>
                        <button type="submit" class="btn btn-primary px-3">@lang('messages.global.pay')</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
