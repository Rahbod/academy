<div class="step1">
    <h1 class="text-center mb-4 border-bottom p-3">
        Selected Course
    </h1>
    <div class="d-flex justify-content-between mb-4">
        <img style="height: 300px!important;" src="{{$course['image']}}" alt="{{$course['image']}}">
        <div class="ml-3">
            <h4 class="m-t0 m-b10">{{$course['title_'.session('lang')]}}</h4>
            <p class="m-t0 m-b10">{{$course['description_'.session('lang')]}}</p>
            <h2 class="m-t10 m-b20">{{$course['duration']}} month</h2>
        </div>
    </div>
</div>

<div class="step2">
    <h3 class="text-center mb-4 border-bottom p-3">
        Select Term
    </h3>
    <table class="table table-hover">
        <thead class="thead-light">
        <tr>
            <th scope="col" colspan="1">choose</th>
            <th scope="col" colspan="4">name</th>
            <th scope="col" colspan="7">descriptions</th>
        </tr>
        </thead>
        <tbody>

        @foreach($course['terms'] as $key => $term)
            <tr>
                <td colspan="1">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="term"
                               id=""
                               value="{{$term['id']}}" {{$loop->first ? 'checked' : ''}}>
                        {{--<label class="form-check-label" for="term_{{$key}}">--}}
                        {{--Default radio--}}
                        {{--</label>--}}
                    </div>
                </td>
                <td colspan="4">{{$term['title_'.session('lang')]}}</td>
                <td colspan="7">{{$term['description_'.session('lang')]}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
