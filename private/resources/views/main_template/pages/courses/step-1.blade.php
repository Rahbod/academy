<div class="step1">
    <h1 class="text-center mb-4 border-bottom p-3">
        Course Information
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
        Select Your Term
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

        @if(isset($course['terms']))
            @foreach($course['terms'] as $key => $term)
                @if($term['class_rooms_count'] <=0)
                    <tr>
                        <td colspan="1">
                            <div class="form-check">
                                <input class="form-check-input " type="radio" name="term"
                                       {{$term['class_rooms_count'] > 0 ? '' : 'disabled'}}
                                       id=""
                                       value="{{$term['id']}}" {{$loop->first ? 'checked' : ''}}>

                            </div>
                        </td>
                        <td colspan="4">
                            <label class="form-check-label" for="term_{{$key}}">
                                {{$term['title_'.session('lang')]}}
                            </label>
                        </td>
                        <td colspan="7">
                            <label class="form-check-label" for="term_{{$key}}">
                                {{$term['description_'.session('lang')]}}
                            </label>
                        </td>
                    </tr>
                @endif
                <tr>
                    <td colspan="1">
                        <div class="form-check">
                            <input class="form-check-input " type="radio" name="term"
                                   {{$term['class_rooms_count'] > 0 ? '' : 'disabled'}}
                                   id=""
                                   value="{{$term['id']}}" {{$loop->first ? 'checked' : ''}}>

                        </div>
                    </td>
                    <td colspan="4">
                        <label class="form-check-label" for="term_{{$key}}">
                            {{$term['title_'.session('lang')]}}
                        </label>
                    </td>
                    <td colspan="7">
                        <label class="form-check-label" for="term_{{$key}}">
                            {{$term['description_'.session('lang')]}}
                        </label>
                    </td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
</div>
