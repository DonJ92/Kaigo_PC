<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Script-Type" content="text/javascript" />
    <meta http-equiv="Content-Style-Type" content="text/css" />
    <meta name="description" content="{{ config('app.name', 'Kaigo') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - {{ config('app.name', 'Helper')}}</title>

    <!-- css -->
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">

    <!-- javascript -->
    <script src="{{ asset('/js/app.js') }}"></script>

    @yield('header')
</head>
<body class="no-auth">
    <header id="header" class="active">
        <div class="site-header">
            <h1 class="logo">
                <a href="{{ route('top') }}">
                    <img src="{{ asset('/images/logo.svg') }}" alt="" />
                </a>
            </h1>
            <div id="global-nav" class="global-nav">
                <nav>
                    <ul class="nav-list">
                        <li class="nav-item news"><a href="#"><span>{{ trans('common.top_menu.news') }}</span></a></li>
                        <li class="nav-item search"><a href="{{ route('job.search') }}"><i class="fa fa-search"></i><span>{{ trans('common.top_menu.search_job') }}</span></a></li>
                        <li class="nav-item regist"><a href="register.html"><span>{{ trans('common.top_menu.register') }}</span></a></li>
                        <li class="nav-item login"><a href="login.html"><span>{{ trans('common.top_menu.login') }}</span></a></li>
                    </ul>
                </nav>
            </div>
            <div class="hamburger">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </header>

    <div id="primary" class="primary">
        <aside>
            <div class="cta-div">
                <img class="cta-div-icon" src="{{ asset('/images/icon.svg') }}">
                <div class="cta-div-info">
                    <p class="mv-lead-txt cta-block-txt has-img">
                        <span class="txt-img"><img src="{{ asset('/images/logo-txt.svg') }}" alt="" /></span>
                        <span class="for-space"></span>{{ trans('common.download_desc') }}
                    </p>
                    <div class="mv-lead-links cta-block-links">
                        <a href="#"><img src="{{ asset('/images/link-app-store.png') }}" alt="" /></a>
                        <a href="#"><img src="{{ asset('/images/link-google-play.png') }}" alt="" /></a>
                    </div>
                </div>
            </div>

            <a class="cta-register" href="register.html">{{ trans('button.register_link') }}</a>
        </aside>

        <main>
            @yield('content')

            <div class="main-r main-block main-block-white">
                <a class="back-btn" href="{{ url()->previous() }}">
                    <div>
                        <p>{{ trans('button.back_page') }}</p>
                        <p class="arrow">←</p>
                    </div>
                </a>
            </div>
        </main>

        <script src="{{ asset('/js/script.js') }}"></script>
    </div>
</body>
</html>
