<div class="step1">
    <h1 class="text-center p-3">
        @lang('messages.global.course-information')
    </h1>
    <hr class="w-75 mx-auto mb-5">

    <div class="d-flex justify-content-between mb-4 ">
        <img style="height: 300px!important;" src="{{$course['image']}}" alt="{{$course['image']}}">
        <div class="ml-3">
            <h4 class="m-t0 m-b10">{{$course['title_'.session('lang')]}}</h4>
            <p class="m-t0 m-b10">{{$course['description_'.session('lang')]}}</p>
            <h2 class="m-t10 m-b20">{{$course['duration']}} month</h2>
        </div>
    </div>
</div>

<div class="step2">
    <hr>
    <h3 class="text-center mb-4 p-3">
        @lang('messages.global.select-term')
    </h3>
    <table class="table table-hover">
        <thead class="thead-light">
        <tr>
            <th scope="col" colspan="1">@lang('messages.global.choose')</th>
            <th scope="col" colspan="4">@lang('messages.global.name')</th>
            <th scope="col" colspan="7">@lang('messages.global.descriptions')</th>
        </tr>
        </thead>
        <tbody>

        @if(isset($course['terms']))
            @foreach($course['terms'] as $key => $term)
                @if(isset($term['class_rooms']) && count($term['class_rooms']) > 0)
                    <tr>
                        <td colspan="1">
                            <div class="form-check">
                                <input class="form-check-input " type="radio" name="term" id=""
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
                @else
                    <tr>
                        <td colspan="1">
                            <div class="form-check">
                                <input class="form-check-input " type="radio" name="term"
                                       {{$term['class_rooms_count'] > 0 ? '' : 'disabled'}}
                                       id="" value="{{$term['id']}}">

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
            @endforeach
        @endif
        </tbody>
    </table>
</div>
