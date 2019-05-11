<header class="header">
    <div class="topBar bg-dark">
        <div class="container">
            <div class="row d-flex justify-content-between">
                <ul class="rightMenu">
                    <li>
                        <a title="contact us" class="topbar__buttonLink"
                           href="{{route('contact-us',['lang'=>session('lang')])}}">contact-us</a>
                    </li>
                    <li>
                        <a title="about us" class="topbar__buttonLink"
                           href="{{route('about-us',['lang'=>session('lang')])}}">about us</a>
                    </li>
                    {{--<li>--}}
                    {{--<a title="translation" class="topbar__buttonLink" href="{{route('translations',['lang'=>session('lang')])}}">translation</a>--}}
                    {{--</li>--}}
                </ul>
                <ul class="leftMenu">
                    @guest
                        <li><a title="login" href="{{route('login',['lang'=>session('lang')])}}"
                               class="topbar__buttonLink">login</a>
                        </li>
                        <li><a title="regiser" href="{{route('register',['lang'=>session('lang')])}}"
                               class="topbar__buttonLink">register</a></li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    @if ((Auth::user()->profile) && Auth::user()->avatar)
                                        <img src="{{ Auth::user()->avatar }}" alt="{{ Auth::user()->name }}"
                                             class="user-avatar-nav">
                                    @else
                                        <div class="user-avatar-nav"></div>
                                    @endif
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    {{--<a class="dropdown-item {{ Request::is('profile/'.Auth::user()->name, 'profile/'.Auth::user()->name . '/edit') ? 'active' : null }}"--}}
                                    {{--href="{{ url('/profile/'.Auth::user()->name) }}">--}}
                                    {{--{!! trans('titles.profile') !!}--}}
                                    {{--</a>--}}
                                    <a class="dropdown-item active" href="void:;" title="profile">profile</a>
                                    <a class="dropdown-item" href="void:;" title="My Articles">My Articles</a>
                                    <a class="dropdown-item" href="void:;" title="My Requests">My
                                        Translations</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('logout',['lang'=>session('lang')]) }}"
                                       onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
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
                    <a class="navbar-brand" href="{{route('home',['lang'=>session('lang')])}}">
                        <!--<img src="./assets/media/images/public/site_logo.png"-->
                        <!--class="siteLogo__image img-fluid" alt="آکادمی زبان ">-->
                        <span class=""
                              style="font-size: inherit;color: inherit;font-weight: inherit;">Academy</span>
                    </a>
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
                        <form action="#">
                            <input autofocus name="search" value="" type="text" class="form-control"
                                   placeholder="Type to search">
                            <span onclick="$('#showSearchForm').hide();" id="quik-search-remove"><i
                                        class="fa fa-times"></i></span>
                        </form>
                    </div>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto">
                            <li class="active">
                                <a title="home" href="{{route('home',['lang'=>session('lang')])}}">Home</a></li>
                            @foreach($main_menus as $item)
                                @if(isset($item['children']) && count($item['children']) >0)
                                    <li class="">
                                        <a title="{{$item['name']}}" href="void:;">{{$item['name']}}<i
                                                    class="fa fa-chevron-down"></i></a>
                                        <ul class="sub-menu">
                                            @foreach($item['children'] as $child)
                                                <li>
                                                    @if($child['type'] === 'action' || $child['type'] === 'link')
                                                        <a href="{{$child['link']}}" title="{{$child['name']}}"
                                                           class="dez-page">{{$child['name']}}</a>
                                                    @else
                                                        <a href="{{url(session('lang') .'/pages/show/'.$child['id'].'/'.str_replace(' ','-',$child['name']) )}}"
                                                           class="dez-page">{{$child['name']}}</a>
                                                    @endif

                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @else
                                    <li>
                                        @if($item['type'] === 'action' || $item['type'] === 'link')
                                            <a href="{{$item['link']}}" title="{{$item['name']}}"
                                               class="dez-page">{{$item['name']}}</a>
                                        @else
                                            <a href="{{url(session('lang') .'/pages/show/'.$item['id'].'/'.str_replace(' ','-',$item['name']) )}}"
                                               class="dez-page">{{$item['name']}}</a>
                                        @endif
                                    </li>
                                @endif
                            @endforeach
                            <li class="d-none d-lg-block">
                                <div class="extra-nav">
                                    <div class="extra-cell">
                                        <button onclick="$('#showSearchForm').show().find('input').focus();" id=""
                                                type="button"
                                                class="site-button-link"><i
                                                    class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <nav id="sidebar">
        <div class="sidebar-header">
            <h4 class="text-white">language</h4>
            <h5 class="text-white">academy</h5>
        </div>

        <div id="dismiss">
            <i class="fas fa-arrow-left"></i>
        </div>

        <ul class="list-unstyled">
            <li>
                <a class="menu-item active" href="void:;">home</a>
            </li>
            <li>
                <a class="menu-item" href="void:;">news</a>
            </li>
            <li>
                <a class="menu-item" href="void:;">articles</a>
            </li>
            <li>
                <a class="menu-item" href="void:;">translation</a>
            </li>
            <li>
                <a class="menu-item submenu" href="#homeSubmenu2" data-toggle="collapse" aria-expanded="false">
                    menu
                </a>
                <ul class="collapse list-unstyled" id="homeSubmenu2">
                    <li>
                        <a class="menu-item" href="void:;">sub menu</a>
                    </li>
                    <li>
                        <a class="menu-item" href="void:;">اطلاعیه ها</a>
                    </li>
                    <li>
                        <a class="menu-item" href="void:;">لیست های من</a>
                    </li>
                    <li>
                        <a class="menu-item" href="void:;">لیست های ذخیره شده</a>
                    </li>
                    <li>
                        <a class="menu-item" href="void:;">لیست های پیشنهادی</a>
                    </li>
                    <li>
                        <a class="menu-item" href="void:;">خروج</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="void:;" class="menu-item">
                    login
                </a>
            </li>
            <li>
                <a href="void:;" class="menu-item">
                    register
                </a>
            </li>


        </ul>

    </nav>
</header>
