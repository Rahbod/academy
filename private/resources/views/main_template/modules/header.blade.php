<?php
if (session('lang') === 'fa') {
    $siteName =config('system.main.fa_title');
} else {
    $siteName =config('system.main.title');
}
?><header class="header">
    <div class="topBar">
        <div class="container">
            <div class="row d-flex justify-content-between" dir="rtl">
                <ul class="rightMenu">
                    <div class="extra-nav">
                        <div class="extra-cell">
                            <button onclick="$('#showSearchForm').show().find('input').focus();" id=""
                                    type="button"
                                    class="site-button-link"><i
                                        class="fa fa-search"></i></button>
                        </div>
                    </div>
                    <li><a title="@lang('messages.global.contact-us')"
                           href="{{url( session('lang') .'/contact-us')}}"
                           class="topbar__buttonLink">@lang('messages.global.contact-us')</a></li>
                    |
                    @guest
                        <li><a title="@lang('messages.global.login')"
                               href="{{route('login',['lang'=>session('lang')])}}"
                               class="topbar__buttonLink">@lang('messages.global.login')</a></li>
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle p-0" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{--                                    @if ((Auth::user()->profile) && Auth::user()->avatar)--}}
                                {{--                                        <img src="{{ Auth::user()->avatar }}" alt="{{ Auth::user()->name }}"--}}
                                {{--                                             class="user-avatar-nav">--}}
                                {{--                                    @else--}}
                                {{--                                        <div class="user-avatar-nav"></div>--}}
                                {{--                                    @endif--}}
                                {{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                {{--<a class="dropdown-item {{ Request::is('profile/'.Auth::user()->name, 'profile/'.Auth::user()->name . '/edit') ? 'active' : null }}"--}}
                                {{--href="{{ url('/profile/'.Auth::user()->name) }}">--}}
                                {{--{!! trans('titles.profile') !!}--}}
                                {{--</a>--}}
                                <a class="dropdown-item active" href="{{url( session('lang') .'/profile')}}"
                                   title="@lang('messages.global.profile')">@lang('messages.global.profile')</a>
                                {{--<a class="dropdown-item" href="void:;" title="My Articles">My Articles</a>--}}
                                {{--<a class="dropdown-item" href="void:;" title="My Requests">My--}}
                                {{--Translations</a>--}}
                                <div class="dropdown-divider"></div>
                                <a title="@lang('messages.global.logout')" class="dropdown-item" href="{{ route('logout',['lang'=>session('lang')]) }}"
                                   onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    @lang('messages.global.logout')
                                </a>
                                <form id="logout-form" action="{{ route('logout',['lang'=>session('lang')]) }}"
                                      method="POST"
                                      style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
                <ul class="leftMenu">
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle p-0" href="#" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <svg class="ml-2" height="15" viewBox="0 0 480 480" width="15"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="m240 0c-132.546875 0-240 107.453125-240 240s107.453125 240 240 240 240-107.453125 240-240c-.148438-132.484375-107.515625-239.851562-240-240zm207.566406 324.078125-68.253906 11.777344c7.8125-28.652344 12.03125-58.164063 12.558594-87.855469h71.929687c-.902343 26.117188-6.398437 51.871094-16.234375 76.078125zm-431.367187-76.078125h71.929687c.527344 29.691406 4.746094 59.203125 12.558594 87.855469l-68.253906-11.777344c-9.835938-24.207031-15.332032-49.960937-16.234375-76.078125zm16.234375-92.078125 68.253906-11.777344c-7.8125 28.652344-12.03125 58.164063-12.558594 87.855469h-71.929687c.902343-26.117188 6.398437-51.871094 16.234375-76.078125zm215.566406-27.472656c28.746094.367187 57.421875 2.984375 85.761719 7.832031l28.238281 4.871094c8.675781 29.523437 13.34375 60.078125 13.878906 90.847656h-127.878906zm88.488281-7.9375c-29.238281-4.996094-58.828125-7.695313-88.488281-8.0625v-96c45.863281 4.40625 85.703125 46.398437 108.28125 107.511719zm-104.488281-8.0625c-29.660156.367187-59.242188 3.066406-88.480469 8.0625l-19.800781 3.425781c22.578125-61.128906 62.417969-103.136719 108.28125-107.523438zm-85.753906 23.832031c28.335937-4.847656 57.007812-7.464844 85.753906-7.832031v103.550781h-127.878906c.535156-30.769531 5.203125-61.324219 13.878906-90.847656zm-42.125 111.71875h127.878906v103.550781c-28.746094-.367187-57.421875-2.984375-85.761719-7.832031l-28.238281-4.871094c-8.675781-29.523437-13.34375-60.078125-13.878906-90.847656zm39.390625 111.488281c29.238281 5.003907 58.824219 7.714844 88.488281 8.105469v96c-45.863281-4.410156-85.703125-46.402344-108.28125-107.515625zm104.488281 8.105469c29.660156-.390625 59.242188-3.101562 88.480469-8.105469l19.800781-3.425781c-22.578125 61.128906-62.417969 103.136719-108.28125 107.523438zm85.753906-23.875c-28.335937 4.847656-57.007812 7.464844-85.753906 7.832031v-103.550781h127.878906c-.535156 30.769531-5.203125 61.324219-13.878906 90.847656zm58.117188-111.71875c-.527344-29.691406-4.746094-59.203125-12.558594-87.855469l68.253906 11.777344c9.835938 24.207031 15.332032 49.960937 16.234375 76.078125zm47.601562-93.710938-65.425781-11.289062c-11.761719-38.371094-33.765625-72.808594-63.648437-99.601562 55.878906 18.648437 102.21875 58.457031 129.074218 110.890624zm-269.871094-110.890624c-29.882812 26.792968-51.886718 61.230468-63.648437 99.601562l-65.425781 11.289062c26.855468-52.433593 73.195312-92.242187 129.074218-110.890624zm-129.074218 314.3125 65.425781 11.289062c11.761719 38.371094 33.765625 72.808594 63.648437 99.601562-55.878906-18.648437-102.21875-58.457031-129.074218-110.890624zm269.871094 110.890624c29.882812-26.792968 51.886718-61.230468 63.648437-99.601562l65.425781-11.289062c-26.855468 52.433593-73.195312 92.242187-129.074218 110.890624zm0 0"/>
                            </svg>
                            @lang('messages.global.'.session('lang'))
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <button onclick="event.preventDefault();window.location.href = '/fa'"
                                    class="dropdown-item {{session('lang') == 'fa' ? 'active' :'' }}"
                                    title="@lang('messages.global.fa')">
                                @lang('messages.global.fa')
                            </button>
                            <button title="@lang('messages.global.en')" class="dropdown-item {{session('lang') == 'en' ? 'active' :'' }}"
                                    onclick="event.preventDefault();window.location.href='/en'">
                                @lang('messages.global.en')
                            </button>
                        </div>
                    </li>
                    {{--                    <li>--}}
                    {{--                        <a title="@lang('messages.global.contact-us')" class="topbar__buttonLink"--}}
                    {{--                           href="{{route('contact-us',['lang'=>session('lang')])}}">@lang('messages.global.contact-us')</a>--}}
                    {{--                    </li>--}}
                    {{--                    <li>--}}
                    {{--                        <a title="@lang('messages.global.about-us')" class="topbar__buttonLink"--}}
                    {{--                           href="{{route('about-us',['lang'=>session('lang')])}}">@lang('messages.global.about-us')</a>--}}
                    {{--                    </li>--}}
                    {{--                    <li>--}}
                    {{--                    <a title="translation" class="topbar__buttonLink" href="{{route('translations',['lang'=>session('lang')])}}">translation</a>--}}
                    {{--                    </li>--}}
                </ul>
            </div>
        </div>
    </div>
    <div class="sticky-header navbar-expand-lg">
        <div class="main-bar clearfix onepage">
            <div class="container">
                <nav class="header-nav navbar p-0">
                    @if(session('lang') !='fa')
                        <a class="navbar-brand" href="{{route('home',['lang'=>session('lang')])}}">
                            <img src="{{ config('system.main.site_logo') }}"
                                 class="siteLogo__image img-fluid" alt="{{ $siteName }}">
                            <h1 class="d-none"
                                style="font-size: inherit;color: inherit;font-weight: inherit;">{{ $siteName }}</h1>
                        </a>
                    @endif
                    <div>
                        <div class="extra-nav d-lg-none">
                            <div class="extra-cell">
                                <button onclick="$('#showSearchForm').show().find('input').focus();" type="button"
                                        class="site-button-link"><i
                                            class="fa fa-search"></i></button>
                            </div>
                        </div>
                        <button id="sidebarCollapse" class="navbar-toggler" type="button">
                            <span class="navbar-toggler-lines"></span>
                            <span class="navbar-toggler-lines"></span>
                            <span class="navbar-toggler-lines"></span>
                        </button>
                    </div>
                    <div id="showSearchForm" class="dlab-quik-search bg-primary search-style-1 On">
                        <form action="{{url(session('lang').'/search' )}}" enctype="multipart/form-data" method="post">
                            @csrf
                            <div class="input-group">
                                <input autofocus type="text" class="form-control"
                                       placeholder="@lang('messages.global.search') ..."
                                       name="search_query"
                                       aria-label="Recipient's username" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="site-button-link mr-3" type="submit"><i class="fa fa-search"></i>
                                    </button>
                                    <button onclick="$('#showSearchForm').hide();" id="quik-search-remove"
                                            class="site-button-link" type="button">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto">
                            {{--<li class="active">--}}
                            {{--<a title="home" href="{{route('home',['lang'=>session('lang')])}}">Home</a>--}}
                            {{--</li>--}}
                            @if(isset($main_menus))
                                @foreach($main_menus as $item)
                                    @if(isset($item['children']) && count($item['children']) >0)
                                        <li class="">
                                            <a title="{{$item['name']}}" href="void:;">{{$item['name']}}</a>
                                            <ul class="sub-menu">
                                                @foreach($item['children'] as $child)
                                                    <li>
                                                        {{--                                                        @if($child['type'] === 'action' || $child['type'] === 'link')--}}
                                                        <a href="{{$child['link']}}" title="{{$child['name']}}"
                                                           class="dez-page">{{$child['name']}}</a>
                                                        {{--@else--}}
                                                        {{--<a href="{{url(session('lang') .'/pages/show/'.$child['id'].'/'.str_replace(' ','-',$child['name']) )}}"--}}
                                                        {{--class="dez-page">{{$child['name']}}</a>--}}
                                                        {{--@endif--}}

                                                    </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    @else
                                        <li>
                                            {{--@if($item['type'] === 'action' || $item['type'] === 'link')--}}
                                            <a href="{{$item['link']}}" title="{{$item['name']}}"
                                               class="dez-page">{{$item['name']}}</a>
                                            {{--@else--}}
                                            {{--<a href="{{url(session('lang') .'/pages/show/'.$item['id'].'/'.str_replace(' ','-',$item['name']) )}}"--}}
                                            {{--class="dez-page">{{$item['name']}}</a>--}}
                                            {{--@endif--}}
                                        </li>
                                    @endif
                                @endforeach
                                {{--                                @if(session('lang') !='fa')--}}
                                {{--                                    <li class="d-none d-lg-block mx-3">--}}
                                {{--                                        <div class="extra-nav">--}}
                                {{--                                            <div class="extra-cell">--}}
                                {{--                                                <button onclick="$('#showSearchForm').show().find('input').focus();"--}}
                                {{--                                                        id=""--}}
                                {{--                                                        type="button"--}}
                                {{--                                                        class="site-button-link"><i--}}
                                {{--                                                            class="fa fa-search"></i></button>--}}
                                {{--                                            </div>--}}
                                {{--                                        </div>--}}
                                {{--                                    </li>--}}
                                {{--                                @endif--}}
                            @endif
                        </ul>
                        @if(session('lang') =='fa')
                            <a class="navbar-brand" href="{{route('home',['lang'=>session('lang')])}}">
                                <img src="{{ config('system.main.site_logo') }}"
                                     class="siteLogo__image img-fluid" alt="{{ $siteName }}">
                                <h1 class="d-none"
                                    style="font-size: inherit;color: inherit;font-weight: inherit;">{{ $siteName }}</h1>
                            </a>
                        @endif

                    </div>
                </nav>
            </div>
        </div>
    </div>
    <nav id="sidebar">
        <div class="sidebar-header">
            {{--<h4 class="text-white">language</h4>--}}
            <h4 class="text-left">
                <a class="text-white" href="{{url(session('lang').'/')}}"
                   title="@lang('messages.global.home')">
                    <img src="{{ config('system.main.site_logo') }}"
                         class="siteLogo__image img-fluid" alt="{{$siteName}}">
                </a>
            </h4>
        </div>

        <div id="dismiss">
            <i class="fas fa-arrow-left"></i>
        </div>

        <ul class="list-unstyled">
            @if(isset($main_menus))
                @foreach($main_menus as $item)
                    @if(isset($item['children']) && count($item['children']) >0)
                        @foreach($item['children'] as $child)
                            <li>
                                <a title="{{$child['name']}}"
                                   class="menu-item submenu"
                                   href="#homeSubmenu{{$child['id']}}"
                                   data-toggle="collapse" aria-expanded="false">
                                    {{$item['name']}}
                                </a>
                                <ul class="collapse list-unstyled" id="homeSubmenu{{$child['id']}}">
                                    <li>
                                        <a title="{{$child['name']}}" class="menu-item"
                                           href="{{$child['link']}}">{{$child['name']}}</a>
                                    </li>
                                </ul>
                            </li>
                        @endforeach
                    @else
                        <li>
                            <a title="{{$item['name']}}" class="menu-item"
                               href="{{$item['link']}}">{{$item['name']}}</a>
                        </li>
                    @endif
                @endforeach
            @endif
            @guest
                <li><a title="@lang('messages.global.login')"
                       href="{{route('login',['lang'=>session('lang')])}}"
                       class="menu-item">@lang('messages.global.login')</a></li>
            @else
                <li>
                    <a title=""
                       class="menu-item submenu"
                       href="#log"
                       data-toggle="collapse" aria-expanded="false">
                        @if ((Auth::user()->profile) && Auth::user()->avatar)
                            <img src="{{ Auth::user()->avatar }}" alt="{{ Auth::user()->name }}"
                                 class="user-avatar-nav">
                        @else
                            <div class="user-avatar-nav"></div>
                        @endif
                        {{ Auth::user()->name }}
                    </a>
                    <ul class="collapse list-unstyled" id="log">
                        <li>
                            <a class="dropdown-item" title="@lang('messages.global.profile')"
                               href="{{url( session('lang') .'/profile')}}">
                                @lang('messages.global.profile')</a>
                            <a class="dropdown-item" href="{{ route('logout',['lang'=>session('lang')]) }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                @lang('messages.global.logout')
                            </a>
                            <form id="logout-form" action="{{ route('logout',['lang'=>session('lang')]) }}"
                                  method="POST"
                                  style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>
            @endguest
        </ul>

    </nav>
</header>
