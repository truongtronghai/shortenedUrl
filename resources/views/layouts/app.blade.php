<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Open Graph general (Facebook, Pinterest & Google+) -->
    <meta name="og:image" content="https://chep.xyz/images/chep-xyz-logo.png">
    <meta name="og:url" content="https://chep.xyz">
    <meta name="og:site_name" content="{{ config('app.name') }}">
    <meta name="fb:admins" content="2558726334244460">
    <meta name="fb:app_id" content="768932120543780">
    <meta name="og:type" content="website">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://chep.xyz/">
    <meta property="twitter:title" content="Shortened URL | Rút gọn URL">
    <meta property="twitter:description" content="">
    <meta property="twitter:image" content="https://chep.xyz/images/chepxyz-fb-preview.jpg">

    <title>{{ config('app.name') }}</title>
    <meta name="description" content="Ứng dụng web dùng để rút gọn một đường dẫn dài thành ngắn và dễ đọc hơn | Use this web app to shorten your URL for easily reading and remember">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    {{--
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    --}}
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/misc.css') }}" rel="stylesheet">
</head>
<body onload="getBanners('{{ url('/utils/banners') }}');toggleStickyBanner('dropupBox');">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark shadow-sm" style="background-color: #6e0278;">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="/images/chep-xyz-logo.png" class="" alt='logo chep.xyz' title='Chep.xyz' />
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
                        @include('lang-dropdown') {{-- chen 1 doan code ben ngoai vao --}}
                        
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link text-white" href="{{ route('login') }}">{{ __('messages.textLogin') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="{{ route('register') }}">{{ __('messages.textRegister') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ url('/admin/home') }}">
                                        {{ __('messages.dashboard') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                        {{ __('messages.textLogout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-0">
            @yield('content')
        </main>

        <footer id="footer" class="py-4">
            <div class="container text-center">
                <div>
                    <a href="/info/privacy">{!! __('messages.privacyPolicy') !!}</a>
                    &middot;
                    <a href="/info/tos">{!! __('messages.termCondition') !!}</a>
                </div>
                <div>
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-envelope-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555zM0 4.697v7.104l5.803-3.558L0 4.697zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757zm3.436-.586L16 11.801V4.697l-5.803 3.546z"/>
                    </svg>
                    chep.xyz@gmail.com
                </div>
                <small>{!! __('messages.copyright') !!}</small>
            </div>
        </footer>
        @yield('sticky_banner')
        <!-- scroll to top button -->
        <button onclick="scrollToTop()" id="scrollToTop" title="Go to top"><strong>&#8593;</strong></button>
    </div> 
    <!-- Scripts -->
    <script src="{{ asset('js/misc.js') }}"></script>
</body>
</html>