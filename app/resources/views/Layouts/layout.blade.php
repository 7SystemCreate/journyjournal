<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'JournyJournal') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('stylesheet')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand"
                    @if (Auth::check() && Auth::user()->role == 1)
                        href="{{ route('inn.home') }}"
                    @elseif (Auth::check() && Auth::user()->role == 2)
                        href="{{ route('admin.mypage') }}"
                    @else
                        href="{{ route('home') }}"
                    @endif
                    >JournyJournal
                </a>
            </div>
            <div class="my-navbar-control">
                @if(Auth::check())
                    @if(Auth::user()->role == 2) <!-- 管理者 -->
                        <a href="{{ route('admin.mypage') }}" class="my-navbar-item">
                            <img src="{{ asset('storage/' . Auth::user()->icon) }}" alt="アイコン" style="width: 30px; height: 30px; object-fit: cover; border-radius: 50%; margin-right: 8px;">
                            {{ Auth::user()->name }}
                        </a>
                    @elseif(Auth::user()->role == 1) <!-- 旅館運営 -->
                        <a href="{{ route('inn.mypage') }}" class="my-navbar-item">
                            <img src="{{ asset('storage/' . Auth::user()->icon) }}" alt="アイコン" style="width: 30px; height: 30px; object-fit: cover; border-radius: 50%; margin-right: 8px;">
                            {{ Auth::user()->name }}
                        </a>
                    @elseif(Auth::user()->role == 0) <!-- 一般 -->
                        <a href="{{ route('general.mypage') }}" class="my-navbar-item">
                            <img src="{{ asset('storage/' . Auth::user()->icon) }}" alt="アイコン" style="width: 30px; height: 30px; object-fit: cover; border-radius: 50%; margin-right: 8px;">
                            {{ Auth::user()->name }}
                        </a>
                    @endif
                    /
                    <a href="#" id="logout" class="my-navbar-item">ログアウト</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <script>
                        document.getElementById('logout').addEventListener('click', function(event) {
                            event.preventDefault();
                            document.getElementById('logout-form').submit();
                        });
                    </script>
                @else
                    <a class="my-navbar-item" href="{{ route('login') }}">ログイン</a>
                    /
                    <a class="my-navbar-item" href="{{ route('register') }}">会員登録</a>
                @endif
            </div>
        </nav>

        <main>
            @yield('content')
        </main>
    </div>
</body>
</html>
