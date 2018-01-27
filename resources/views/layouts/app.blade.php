<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
    <!--JQuery-->
    <script src="/js/jquery-3.2.1.min.js"></script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        <li><a href="/events">{{__('pagination.Pevents')}}</a></li>
                        <li><a href="/discussions">{{__('pagination.Pdiscussions')}}</a></li>
                        @if (!Auth::guest())
                        <li><a href="/search">{{__('pagination.Usearch')}}</a></li>
                        @endif
                        @if ( !Auth::guest() && Auth::user()->hasChoir() and !Auth::user()->isAdmin())
                                    
                           <li><a href="{{ url('choir') }}">{{__('pagination.Ychoir')}}</a></li>
                        @endif
                        @if ( !Auth::guest() && !Auth::user()->hasChoir() && Auth::user()->isConductor() )
                            <li><a href="{{ url('/choir/create') }}">{{__('pagination.Cchoir')}}</a></li>
                        @endif
                        @if ( !Auth::guest() && Auth::user()->isAdmin() )
                            <li><a href="/admin">Admin</a></li>
                        @endif
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">

<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        {{ Config::get('languages')[App::getLocale()] }}
    </a>
    <ul class="dropdown-menu">
        @foreach (Config::get('languages') as $lang => $language)
            @if ($lang != App::getLocale())
                <li>
                    <a href="{{ route('lang.switch', $lang) }}">{{$language}}</a>
                </li>
            @endif
        @endforeach
    </ul>
</li>

                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}">{{__('pagination.Login')}}</a></li>
                            <li><a href="{{ route('register') }}">{{__('pagination.Register')}}</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                          @if ( !Auth::guest() )
                             <li><a href="{{ url('profile',  auth()->id()) }}">{{__('pagination.Mprofile')}}</a></li>
                         @endif
                                          @if ( !Auth::guest() )
                             <li><a href="{{ url('inbox') }}">{{__('pagination.Inbox')}}</a></li>
                         @endif
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            {{__('pagination.Logout')}}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
