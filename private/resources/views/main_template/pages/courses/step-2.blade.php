<div class="step1">
    <h1 class="text-center mb-4 p-3">
        @lang('messages.global.course-information')
    </h1>
    <div class="d-md-flex justify-content-between mb-4">
        <img style="height: 200px!important;" src="{{$course['image']}}" alt="{{$course['image']}}">
        <div class="ml-3">
            <h4 class="m-t0 m-b10">{{$course['title_'.session('lang')]}}</h4>
            <p class="m-t0 m-b10">{{$course['description_'.session('lang')]}}</p>
            <h2 class="m-t10 m-b20">{{session("lang")=='en' ?  $course['duration'] : numberConvertor($course['duration'])}} @lang('messages.global.month')</h2>
        </div>
    </div>
</div>

<div class="step2">
    <h3 class="text-center mb-4 p-3">
        @lang('messages.global.term-information')
    </h3>
    <div class="d-md-flex justify-content-between mb-4">
        {{--<img style="height: 200px!important;" src="{{$course['image']}}" alt="{{$course['image']}}">--}}
        <div class="ml-3">
            <h4 class="m-t0 m-b10">{{$term['title_'.session('lang')]}}</h4>
            <p class="m-t0 m-b10">{{$term['description_'.session('lang')]}}</p>
        </div>
    </div>
</div>

<div class="step3">
    <h4 class="text-center mb-4 border-bottom p-3">
        @lang('messages.global.select-class')
    </h4>
    <div class="table-responsive">

        <table class="table table-hover">
            <thead class="thead-light">
            <tr>
                <th>@lang('messages.global.choose')</th>
                <th>@lang('messages.global.class-image')</th>
                <th>@lang('messages.global.descriptions')</th>
            </tr>
            </thead>
            <tbody>
            @if(isset($class_rooms) && count($class_rooms) > 0)
                @foreach($class_rooms as $key => $class_room)
                    <tr onclick="checkRadio(this)" class="my-3">
                        <td width="1%">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="term"
                                       id=""
                                       value="{{$class_room['id']}}" {{$loop->first ? 'checked' : ''}}>
                            </div>
                        </td>
                        <td width="1%">
                            <img style="max-width: 300px" class="img-fluid" src="{{$class_room['image']}}" onclick="checkRadio(this)"
                                 alt="{{$class_room['title_'.session('lang')]}}">
                        </td>
                        <td>
                            <ul class="list-unstyled ">
                                <li class=""><b>@lang('messages.global.class-title')</b>
                                    : {{$class_room['title_'.session('lang')]}}</li>
                                <li class=""><b>@lang('messages.global.class-capacity')</b>
                                    : {{ session('lang') == 'en' ? $class_room['capacity'] : numberConvertor($class_room['capacity'])  }}
                                </li>
                                <li class=""><b>@lang('messages.global.class-price')</b>
                                    : {{ session('lang') == 'en' ? $class_room['price'] : numberConvertor(number_format($class_room['price']))}}
                                </li>
                                <li class=""><b>@lang('messages.global.class-master')</b>
                                    : {{$class_room['teacher']['name']}}
                                </li>
                                <li class=""><b>@lang('messages.global.class-registration-start-day')</b>
                                    : {{ session('lang') == 'en' ? $class_room['registration_start_date'] : numberConvertor($class_room['registration_start_date'])}}
                                </li>
                                <li class=""><b>@lang('messages.global.class-registration-end-day')</b>
                                    : {{ session('lang') == 'en' ? $class_room['registration_end_date'] : numberConvertor($class_room['registration_end_date'])}}
                                </li>
                                <li class=""><b>@lang('messages.global.class-start-day')</b>
                                    : {{ session('lang') == 'en' ? $class_room['course_start_date'] : numberConvertor($class_room['course_start_date'])}}
                                </li>
                                <li class=""><b>@lang('messages.global.class-end-day')</b>
                                    : {{ session('lang') == 'en' ? $class_room['course_end_date'] : numberConvertor($class_room['course_end_date'])}}
                                </li>
                                @foreach($class_room['class_room_times'] as $class_room_time)
                                    <li class="">
                                        <b>{{ trans('main.values.'.$class_room_time['week_day']) }}</b>
                                        {{ session('lang') == 'en' ? $class_room_time['start_time'] : numberConvertor($class_room_time['start_time'])}}
                                        - {{ session('lang') == 'en' ? $class_room_time['end_time'] : numberConvertor($class_room_time['end_time'])}}
                                    </li>
                                @endforeach
                            </ul>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr class="my-3">
                    <td colspan="12">
                        <div class="alert alert-info text-center" role="alert">@lang('messages.global.no-result')</div>
                    </td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>
</div>