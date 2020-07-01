<?php
if (session('lang') === 'fa') {
    $siteName =config('system.main.fa_title');
} else {
    $siteName =config('system.main.title');
}
?><header class="header">
    <div class="topBar">
        <div class="container">
            <div class="row d-flex justify-content-between">
                <ul class="rightMenu">
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
                <ul class="leftMenu">
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
                                {{ Auth::user()->name }} <span class="caret"></span>
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
                   title="@lang('messages.global.home')">{{ $siteName }}</a>
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
