<!-- HTMLコード -->
<!DOCTYPE html>
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
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
</head>

<body class="@yield('body_class')">

<div id="primary" class="primary">
    <aside>
        <h1 class="logo">
            <a href="{{ route('top') }}">
                <img src="{{ asset('/images/logo.svg') }}" alt="" />
            </a>
        </h1>

        <div class="mv-ttl">
            <h2 class="mv-ttl-main">{{ trans('login.main_title_pre') }}<br>{{ trans('login.main_title_sur') }}</h2>
            <h3 class="mv-ttl-sub">
                {{ trans('login.main_desc') }}
            </h3>
        </div>

        <div class="mv-lead cta-block">
            <div class="mv-lead-icon cta-block-icon">
                <a href="#">
                    <img src="{{ asset('/images/icon.svg') }}" alt="" />
                </a>
            </div>
            <div class="mv-lead-infos cta-block-infos">
                <p class="mv-lead-txt cta-block-txt has-img">
                    <span class="txt-img"><img src="{{ asset('/images/logo-txt.svg') }}" alt="" /></span>
                    <span class="for-space"></span>アプリを今すぐダウンロード
                </p>
                <div class="mv-lead-links cta-block-links">
                    <a href="#"><img src="{{ asset('/images/link-app-store.png') }}" alt="" /></a>
                    <a href="#"><img src="{{ asset('/images/link-google-play.png') }}" alt="" /></a>
                </div>
            </div>
        </div>

        <a class="back-to-top" href="{{ route('top') }}">
            <i class="ti-arrow-circle-left"></i>{{ trans('common.to_top') }}
        </a>
    </aside>

    <main>
        @yield('content')
    </main>
</div>

<script src="{{ asset('/js/script.js') }}"></script>
</body>
</html>