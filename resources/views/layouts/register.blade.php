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

    <title>{{ trans('register.title') }} - {{ config('app.name', 'Helper')}}</title>

    <!-- css -->
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">

    <!-- javascript -->
    <script src="{{ asset('/js/app.js') }}"></script>
</head>

<body class="register">

<div id="primary" class="primary">
    <aside>
        <h1 class="logo">
            <a href="{{ route('top') }}">
                <img src="{{ asset('images/logo.svg') }}" alt="" />
            </a>
        </h1>

        <div class="flow">
            <ul class="flow-ul">
                <li class="flow-ttl"><a class="active"><i class="@if ($step > 1) after @else now @endif"></i>{{ trans('register.main_info') }}</a></li>
                <li class="flow-ttl"><a class="@if ($step > 1) active @endif"><i class="@if ($step > 2) after @elseif($step == 2) now @endif"></i>{{ trans('register.password_setting') }}</a></li>
                <li class="flow-ttl"><a class="@if ($step > 2) active @endif"><i class="@if ($step > 3) after @elseif($step == 3) now @endif"></i>{{ trans('register.sms_verify') }}</a></li>
                <li class="flow-ttl"><a class="@if ($step > 3) active @endif"><i class="@if($step == 4) now @endif"></i>{{ trans('register.confirm') }}</a></li>
            </ul>
        </div>

        <a class="back-to-top" href="{{ route('top') }}">
            <i class="ti-arrow-circle-left"></i>{{ trans('register.to_top') }}
        </a>
    </aside>

    <main>
        @yield('content')
    </main>
</div>

<script src="{{ asset('/js/script.js') }}"></script>
</body>
</html>