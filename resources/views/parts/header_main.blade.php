<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Вход в личный кабинет</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta property="og:title" content="">
    <meta property="og:description" content="">
    <link rel="canonical" href="">
    <meta property="og:locale" content="ru_RU">
    <meta property="og:url" content="">
    <meta property="og:image" content="">
    <meta property="og:type" content="website">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    {{--<link rel="apple-touch-icon" sizes="57x57" href="images/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="images/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="images/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="images/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="images/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="images/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="images/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="images/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="images/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="images/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="images/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon-16x16.png">
    <link rel="manifest" href="images/manifest.json">--}}
    <meta name="msapplication-TileColor" content="#ffffff">
{{--    <meta name="msapplication-TileImage" content="images/ms-icon-144x144.png">--}}
    <meta name="theme-color" content="#ffffff">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset('public/assets/site/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/assets/site/css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900&display=swap&subset=cyrillic">
    <link rel="stylesheet" href="{{asset('public/assets/site/css/style.css')}}">
</head>
<body>
<div class="wrapper">
    <header class="header_menu">
        <div class="container">
            <div class="row header">
                <a class="logo" href="{{ url('/') }}">
                    <img src="{{asset('public/assets/site/images/logo-test.svg')}}" alt="" class="img-fluid">
                    <span>{{ config('app.name', 'gurufor.com') }}</span>
                </a>
                <div class="form_search_new">
                    <form action="" method="get">
                        <input name="s" placeholder="Введите запрос..." type="search">
                        <button type="submit"><img src="{{asset('public/assets/site/images/icon_search.png')}}" alt="" class="img-fluid"></button>
                    </form>
                </div>
                <div class="nav">
                    <ul>
                        <li>
                            <a href="#">Популярное</a>
                            <div class="megamenu">
                                <ul class="menu__sub">
                                    <li class="menu__sub_title">
                                        <span>Страны</span>
                                    </li>
                                    <li>
                                        <a href="#">Мексика</a>
                                    </li>
                                    <li>
                                        <a href="#">Мексика</a>
                                    </li>
                                    <li>
                                        <a href="#">Мексика</a>
                                    </li>
                                    <li>
                                        <a href="#">Мексика</a>
                                    </li>
                                    <li>
                                        <a href="#">Мексика</a>
                                    </li>
                                    <li>
                                        <a href="#">Мексика</a>
                                    </li>
                                    <li>
                                        <a href="#">Мексика</a>
                                    </li>
                                </ul>
                                <ul class="menu__sub">
                                    <li class="menu__sub_title">
                                        <span>Категории</span>
                                    </li>
                                    <li>
                                        <a href="#">Ссылка</a>
                                    </li>
                                    <li>
                                        <a href="#">Ссылка</a>
                                    </li>
                                    <li>
                                        <a href="#">Ссылка</a>
                                    </li>
                                    <li>
                                        <a href="#">Ссылка</a>
                                    </li>
                                    <li>
                                        <a href="#">Ссылка</a>
                                    </li>
                                    <li>
                                        <a href="#">Ссылка</a>
                                    </li>
                                    <li>
                                        <a href="#">Ссылка</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li><a href="#">Добавить объявление</a></li>
{{--                        <li><a href="#">Вход</a> <span class="separator">/</span> <a href="#">Регистрация</a></li>--}}
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
                            <li>
                                <a href="#" style="margin-right: 10px">{{ explode(' ', Auth::user()->name)[0] }}</a>
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> Выйти
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        @endguest
                    </ul>
                </div>
                <div class="mobile_menu"></div>
            </div>
        </div>
    </header>
