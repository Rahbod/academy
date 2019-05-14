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
        @foreach($terms as $key => $term)
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
<div class="d-flex justify-content-center mt-3">
    <a class="site-button mr-2" title="back to courses"
       href="{{url(session('lang').'/courses')}}">back to courses</a>

    <button data-lang="{{session('lang')}}" value="step2" class="site-button ml-2">Next</button>
</div>