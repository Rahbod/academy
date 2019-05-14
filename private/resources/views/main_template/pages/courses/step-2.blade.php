<div class="p-a30 border-1 m-auto">
    <table class="table table-hover">
        <thead class="thead-light">
        <tr>
            <th scope="col" colspan="1">choose</th>
            <th scope="col" colspan="4">name</th>
            <th scope="col" colspan="7">descriptions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($class_rooms as $key => $class_room)
            <tr>
                <td colspan="1">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="term"
                               id=""
                               value="{{$class_room['id']}}" {{$loop->first ? 'checked' : ''}}>
                    </div>
                </td>
                <td colspan="4"><img class="img-fluid" src="{{$class_room['image']}}"
                                     alt="{{$class_room['title_'.session('lang')]}}"></td>
                <td colspan="7">
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
<div class="d-flex justify-content-center m3-5">
    <a data-prev-step="step1" class="site-button mr-2" title="back to courses"
       href="void:;">Prev Step</a>

    <button value="step3" class="site-button ml-2">Next Step</button>
</div>