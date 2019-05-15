<div class="container">
    <div class="row">
        <div class="col-md-5 text-left"><label>course title</label></div>
        <div class="col-md-7">{{$term['course']['title_'.session('lang')]}}</div>

        <div class="col-md-5 text-left"><label>course description :</label></div>
        <div class="col-md-7">{{$term['course']['description_'.session('lang')]}}</div>

        <div class="col-md-5 text-left"><label>course description :</label></div>
        <div class="col-md-7">{{$term['course']['duration']}}</div>

        {{--term description--}}
        <div class="col-md-5 text-left"><label>term title</label></div>
        <div class="col-md-7">{{$term['title_'.session('lang')]}}</div>

        <div class="col-md-5 text-left"><label>term description :</label></div>
        <div class="col-md-7">{{$term['description_'.session('lang')]}}</div>

        {{--class description--}}
        <div class="col-md-5 text-left"><label>class title</label></div>
        <div class="col-md-7">{{$class_room['title_'.session('lang')]}}</div>

        <div class="col-md-5 text-left"><label>class capacity:</label></div>
        <div class="col-md-7">{{$class_room['capacity']}}</div>

        <div class="col-md-5 text-left"><label>class price:</label></div>
        <div class="col-md-7">{{$class_room['price']}}</div>

        <div class="col-md-5 text-left"><label>class master:</label></div>
        <div class="col-md-7">{{$class_room['teacher']['name']}}</div>

        <div class="col-md-5 text-left"><label>class registration start day:</label></div>
        <div class="col-md-7">{{$class_room['registration_start_date']}}</div>

        <div class="col-md-5 text-left"><label>class registration end day:</label></div>
        <div class="col-md-7">{{$class_room['registration_end_date']}}</div>

        <div class="col-md-5 text-left"><label>course start day:</label></div>
        <div class="col-md-7">{{$class_room['course_start_date']}}</div>

        <div class="col-md-5 text-left"><label>course end day:</label></div>
        <div class="col-md-7">{{$class_room['course_end_date']}}</div>

        <div class="col-md-5 text-left"><label>class times :</label></div>
        <div class="col-md-7">
            <div class="container-fluid">
                <div class="row">
                    @foreach($class_room['class_room_times'] as $class_room_time)
                        <div class="col-4">
                            {{$class_room_time['week_day']}}
                        </div>
                        <div class="col-8">
                            {{$class_room_time['start_time']}} -- {{$class_room_time['end_time']}}
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
</div>
