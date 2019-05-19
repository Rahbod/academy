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
                            <h4>course information</h4>
                        </div>
                        <div class="col-md-4 text-left"><label>course title</label></div>
                        <div class="col-md-8">{{$term['course']['title_'.session('lang')]}}</div>

                        <div class="col-md-4 text-left"><label>course description :</label></div>
                        <div class="col-md-8">{{$term['course']['description_'.session('lang')]}}</div>

                        <div class="col-md-4 text-left"><label>course description :</label></div>
                        <div class="col-md-8">{{$term['course']['duration']}}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="row">
                <div class="container-fluid border-bottom mb-5 py-3">
                    <div class="row">
                        <div class="col-12">
                            <h4>term information</h4>
                        </div>
                        <div class="col-md-4 text-left"><label>term title</label></div>
                        <div class="col-md-8">{{$term['title_'.session('lang')]}}</div>

                        <div class="col-md-4 text-left"><label>term description :</label></div>
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
                            <h4>class information</h4>
                        </div>
                        <div class="col-md-4 text-left"><label>class title</label></div>
                        <div class="col-md-8">{{$class_room['title_'.session('lang')]}}</div>

                        <div class="col-md-4 text-left"><label>class capacity:</label></div>
                        <div class="col-md-8">{{$class_room['capacity']}}</div>

                        <div class="col-md-4 text-left"><label>class price:</label></div>
                        <div class="col-md-8">{{$class_room['price']}}</div>

                        <div class="col-md-4 text-left"><label>class master:</label></div>
                        <div class="col-md-8">{{$class_room['teacher']['name']}}</div>

                        <div class="col-md-4 text-left"><label>class registration start day:</label></div>
                        <div class="col-md-8">{{$class_room['registration_start_date']}}</div>

                        <div class="col-md-4 text-left"><label>class registration end day:</label></div>
                        <div class="col-md-8">{{$class_room['registration_end_date']}}</div>

                        <div class="col-md-4 text-left"><label>course start day:</label></div>
                        <div class="col-md-8">{{$class_room['course_start_date']}}</div>

                        <div class="col-md-4 text-left"><label>course end day:</label></div>
                        <div class="col-md-8">{{$class_room['course_end_date']}}</div>

                        <div class="col-md-4 text-left"><label>class times :</label></div>
                        <div class="col-md-8">
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
            </div>
        </div>

        <div class="col-12">
            <div class="container-fluid border-bottom mb-5 py-3">
                <div class="row">
                    <div class="col-12">
                        <h4>user information</h4>
                    </div>
                    @auth
                        <div class="col-md-4 text-left"><label>user name :</label></div>
                        <div class="col-md-8">{{auth()->user()->name}}</div>

                        <div class="col-md-4 text-left"><label>email :</label></div>
                        <div class="col-md-8">{{auth()->user()->email}}</div>

                        @if(isset(auth()->user()->mobile_number))
                            <div class="col-md-4 text-left"><label>mobile_number :</label></div>
                            <div class="col-md-8">{{auth()->user()->mobile_number }}</div>
                        @endif
                    @endauth
                    @guest
                        <div class="col-12">
                            <div class="alert alert-info text-center rounded" role="alert">
                                <b>user dit not logged in</b>
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

                <div class="form-group row">
                    <label for="gateway" class="col-sm-4 col-form-label">Gateway</label>
                    <div class="col-sm-8">
                        <select id="gateway" name="gateway_id" class="custom-select my-1 mr-sm-2">
                            <option value="1">Zarin Pal</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12 text-center">
                        <a title="go to home page" href="{{url(session('lang').'/')}}" class="btn btn-danger">Cancel</a>
                        <button type="submit" class="btn btn-primary px-3">Pay</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
