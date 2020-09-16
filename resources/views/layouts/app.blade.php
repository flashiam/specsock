<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Specsock') }}</title>
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/gif" sizes="16x16">
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script type="text/javascript" src="{{ asset('ckeditor/ckeditor.js') }}" ></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dash.css') }}" rel="stylesheet">
    <link href="{{ asset('css/scroll.css') }}" rel="stylesheet">


</head>
<body style="background-color: #323840;">

    
    <div id="app">
        <nav class="navbar fixed-top navbar-expand-md navbar-dark shadow-lg" style="background-color: #15171a; border-bottom: 3px solid #e8a561;">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}" style="padding: 0px;">
                   
                    <img src = "{{ asset('images/specsock.png') }}" style="width: 140px; height: 40px;">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        @if(isset($window))
        <div class="sidebar" style="margin-top: 50px; background-color: #15171a; font-size: 1.2rem; text-align:center; padding:0px;">
        @if($window == 'home')
        <a class="active" style=" color: #f5f7fa; margin-top: 2px;" href="#">Home</a>
        @else
        <a style=" color: #f5f7fa; margin-top: 2px;" href="{{ route('home') }}">Home</a>
        @endif
        @if($window == 'articles')
        <a class="active" style=" color: #f5f7fa;" href="#">Articles</a>
        @else
        <a style=" color: #f5f7fa;" href="{{ route('articles') }}">Articles</a>
        @endif
        @if($window == 'assets')
        <a class="active" style=" color: #f5f7fa;" href="#">Assets</a>
        @else
        <a style=" color: #f5f7fa;" href="{{ route('assets') }}">Assets</a>
        @endif
        @if($window == 'pages')
        <a class="active" style=" color: #f5f7fa;" href="#">Pages</a>
        @else
        <a style=" color: #f5f7fa;" href="{{ route('pages') }}">Pages</a>
        @endif
        @if($window == 'campaigns')
        <a class="active" style=" color: #f5f7fa;" href="#">Campaigns</a>
        @else
        <a style=" color: #f5f7fa;" href="{{ route('campaigns') }}">Campaigns</a>
        @endif
        @if($window == 'live')
        <a class="active" style=" color: #f5f7fa;" href="#">Preview</a>
        @else
        <a style=" color: #f5f7fa;" href="{{ route('live') }}">Preview</a>
        @endif
        </div>
        @endif
        <div class="content" style="border-right: 3px solid #e8a561;">
        <main class="py-1 px-0" style="margin-top: 60px; margin-right: 0%;">
            @yield('content')
        </main>
        </div>
    </div>
    
</body>
</html>
