<div class="step1">
    <h1 class="text-center mb-4 border-bottom p-3">
        Course Information
    </h1>
    <div class="d-flex justify-content-between mb-4">
        <img style="height: 200px!important;" src="{{$course['image']}}" alt="{{$course['image']}}">
        <div class="ml-3">
            <h4 class="m-t0 m-b10">{{$course['title_'.session('lang')]}}</h4>
            <p class="m-t0 m-b10">{{$course['description_'.session('lang')]}}</p>
            <h2 class="m-t10 m-b20">{{$course['duration']}} month</h2>
        </div>
    </div>
</div>

<div class="step2">
    <h3 class="text-center mb-4 border-bottom p-3">
        Term Information
    </h3>
    <div class="d-flex justify-content-between mb-4">
        {{--<img style="height: 200px!important;" src="{{$course['image']}}" alt="{{$course['image']}}">--}}
        <div class="ml-3">
            <h4 class="m-t0 m-b10">{{$term['title_'.session('lang')]}}</h4>
            <p class="m-t0 m-b10">{{$term['description_'.session('lang')]}}</p>
        </div>
    </div>
</div>

<div class="step3">
    <h4 class="text-center mb-4 border-bottom p-3">Select Your Class</h4>
    <table class="table table-hover">
        <thead class="thead-light">
        <tr>
            <th scope="col" colspan="1">#</th>
            <th scope="col" colspan="3">class image</th>
            <th scope="col" colspan="8">class descriptions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($class_rooms as $key => $class_room)
            <tr class="my-3">
                <td colspan="1">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="term"
                               id=""
                               value="{{$class_room['id']}}" {{$loop->first ? 'checked' : ''}}>
                    </div>
                </td>
                <td colspan="3">
                    <img class="img-fluid" src="{{$class_room['image']}}"
                         alt="{{$class_room['title_'.session('lang')]}}">
                </td>
                <td colspan="8">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Title : {{$class_room['title_'.session('lang')]}}</li>
                        <li class="list-group-item">Capacity : {{$class_room['capacity']}}</li>
                        <li class="list-group-item">Price : {{$class_room['price']}}</li>
                        <li class="list-group-item">Master : {{$class_room['teacher']['name']}}</li>
                        <li class="list-group-item">Registration Start : {{$class_room['registration_start_date']}}</li>
                        <li class="list-group-item">Registration End : {{$class_room['registration_end_date']}}</li>
                        <li class="list-group-item">Course Start Date : {{$class_room['course_start_date']}}</li>
                        <li class="list-group-item">Course End Date : {{$class_room['course_end_date']}}</li>

                    </ul>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>