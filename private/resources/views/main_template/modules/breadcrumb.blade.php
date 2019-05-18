<div class="breadcrumb-row">
    <ul class="list-inline">
        @if(isset($breadcrumbs))
            @foreach($breadcrumbs as $breadcrumb)
                <li>
                    <a title="{{$breadcrumb['title']}}" class="text-white"
                       href="{{ url(session('lang'). '/'. $breadcrumb['link'])}}">{{$breadcrumb['title']}}</a>
                </li>
            @endforeach
        @endif
    </ul>
</div>