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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    @yield('header')
</head>
<body class="dashboard">
<header id="dashboard-header" class="dashboard-header">
    <h1 class="logo">
        <a href="{{ route('top') }}">
            <img src="{{ asset('/images/dashboard-logo.svg') }}">
        </a>
    </h1>

    <div id="global-nav" class="global-nav">
        <div class="user-block">
            <div class="dropdown">
                <a class="user-menu" id="user-popup-menu">
                    <img class="img-circle" src="{{ $data['photo'] }}">
                    <span class="user-name">{{ auth()->user()->last_name . auth()->user()->first_name }}&nbsp;&nbsp;<i class="ti-angle-down"></i></span>
                </a>
                <div class="dropdown-content" id="user-popup">
                    <a class="border-bottom" href="{{ route('dashboard.setting.changepwd') }}">{{ trans('common.dropdown_menu.account_setting') }}</a>
                    <a class="secondary-color" onclick="logoutPopup()">{{ trans('common.dropdown_menu.logout') }}</a>
                </div>
            </div>
        </div>
        <div class="icon-block">
            <div class="icon-menu">
                <div class="dropdown">
                    <a class="news-menu" id="news-popup-menu"><i class="ti-bell"></i><span class="pin nav">10</span></a>
                    <div class="dropdown-content" id="news-popup">
                        <h2 class="list-title border-bottom popup">お知らせ</h2>
                        <a href="news.html" class="border-bottom">
                            <div class="news-col">
                                <div class="news-info">
                                    <div class="news-head">
                                        <p class="news-category cat-red">お知らせ</p>
                                        <p class="news-head-mark">N</p>
                                    </div>
                                    <h4 class="news-item-ttl">【キャンペーン開始】 2月イベント</h4>
                                    <p class="news-date">2020/02/04 20:20</p>
                                </div>
                                <i class="fa fa-chevron-right"></i>
                            </div>
                        </a>
                        <a href="news.html" class="border-bottom">
                            <div class="news-col">
                                <div class="news-info">
                                    <div class="news-head">
                                        <p class="news-category cat-red">お知らせ</p>
                                        <p class="news-head-mark">N</p>
                                    </div>
                                    <h4 class="news-item-ttl">【キャンペーン開始】 2月イベント</h4>
                                    <p class="news-date">2020/02/04 20:20</p>
                                </div>
                                <i class="fa fa-chevron-right"></i>
                            </div>
                        </a>
                        <a href="news.html" class="border-bottom">
                            <div class="news-col">
                                <div class="news-info">
                                    <div class="news-head">
                                        <p class="news-category cat-red">お知らせ</p>
                                        <p class="news-head-mark">N</p>
                                    </div>
                                    <h4 class="news-item-ttl">【キャンペーン開始】 2月イベント</h4>
                                    <p class="news-date">2020/02/04 20:20</p>
                                </div>
                                <i class="fa fa-chevron-right"></i>
                            </div>
                        </a>
                        <a href="news.html" class="border-bottom">
                            <div class="news-col">
                                <div class="news-info">
                                    <div class="news-head">
                                        <p class="news-category cat-blue">アップデート</p>
                                        <p class="news-head-mark">N</p>
                                    </div>
                                    <h4 class="news-item-ttl">プロフィール項目(ひと言コメント)承認のお知らせ。</h4>
                                    <p class="news-date">2020/02/04 20:20</p>
                                </div>
                                <i class="fa fa-chevron-right"></i>
                            </div>
                        </a>
                        <a href="news.html">
                            全て見る
                        </a>
                    </div>
                </div>
            </div>
            <div class="icon-menu">
                <div class="dropdown">
                    <a class="notify-menu" id="notify-popup-menu"><i class="ti-email"></i><span class="pin nav">210</span></a>
                    <div class="dropdown-content notification" id="notify-popup">
                        <h2 class="list-title border-bottom popup">Notifacation</h2>
                        <a href="message.html" class="border-bottom">
                            <div class="row-item flex popup">
                                <div class="div item-block col-4-3">
                                    <img src="{{ asset('/images/common/photo-01.jpg') }}">
                                    <div class="item-info">
                                        <h3 class="title">ニックネーム（年齢）</h3>
                                        <p class="sub-info">メッセージ内容が入ります。</p>
                                    </div>
                                </div>
                                <div class="div item-block col-4-1">
                                    <div class="item-info">
                                        <p class="sub-info">3/4 15:08</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a href="message.html" class="border-bottom">
                            <div class="row-item flex popup">
                                <div class="div item-block col-4-3">
                                    <img src="{{ asset('/images/common/photo-01.jpg') }}">
                                    <div class="item-info">
                                        <h3 class="title">ニックネーム（年齢）</h3>
                                        <p class="sub-info">メッセージ内容が入ります。</p>
                                    </div>
                                </div>
                                <div class="div item-block col-4-1">
                                    <div class="item-info">
                                        <p class="sub-info">3/4 15:08</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a href="message.html" class="border-bottom">
                            <div class="row-item flex popup">
                                <div class="div item-block col-4-3">
                                    <img src="{{ asset('/images/common/photo-01.jpg') }}">
                                    <div class="item-info">
                                        <h3 class="title">ニックネーム（年齢）</h3>
                                        <p class="sub-info">メッセージ内容が入ります。</p>
                                    </div>
                                </div>
                                <div class="div item-block col-4-1">
                                    <div class="item-info">
                                        <p class="sub-info">3/4 15:08</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a href="message.html" class="border-bottom">
                            <div class="row-item flex popup">
                                <div class="div item-block col-4-3">
                                    <img src="{{ asset('/images/common/photo-01.jpg') }}">
                                    <div class="item-info">
                                        <h3 class="title">ニックネーム（年齢）</h3>
                                        <p class="sub-info">メッセージ内容が入ります。</p>
                                    </div>
                                </div>
                                <div class="div item-block col-4-1">
                                    <div class="item-info">
                                        <p class="sub-info">3/4 15:08</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a href="message.html" class="border-bottom">
                            <div class="row-item flex popup">
                                <div class="div item-block col-4-3">
                                    <img src="{{ asset('/images/common/photo-01.jpg') }}">
                                    <div class="item-info">
                                        <h3 class="title">ニックネーム（年齢）</h3>
                                        <p class="sub-info">メッセージ内容が入ります。</p>
                                    </div>
                                </div>
                                <div class="div item-block col-4-1">
                                    <div class="item-info">
                                        <p class="sub-info">3/4 15:08</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a href="message.html">
                            全て見る
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<div id="primary" class="primary">
    <aside>
        <div class="aside-menu-list">
            <a class="aside-menu-item" id="side_menu_home" href="{{ route('dashboard.home') }}">
                <span class="icon"><img src="{{ asset('/images/icon/home.svg') }}"></span>
                <span class="txt">{{ trans('common.dashboard_side_menu.home') }}</span>
            </a>

            <a class="aside-menu-item" id="side_menu_job_list" href="@if(auth()->user()->type == CLIENT) {{ route('dashboard.helper.search') }} @else {{ route('dashboard.job.search') }} @endif">
                <span class="icon"><img src="{{ asset('/images/icon/list.svg') }}"></span>
                <span class="txt">{{ trans('common.dashboard_side_menu.job_list') }}</span>
            </a>

            <a class="aside-menu-item" id="side_menu_job_register" href="{{ route('dashboard.job.register') }}">
                <span class="icon"><img src="{{ asset('/images/icon/reservation.svg') }}"></span>
                <span class="txt">{{ trans('common.dashboard_side_menu.job_register') }}</span>
            </a>

            <a class="aside-menu-item" id="side_menu_favourite" href="@if(auth()->user()->type == CLIENT) {{ route('dashboard.favourite.helper') }} @else {{ route('dashboard.favourite.job') }} @endif">
                <span class="icon"><img src="{{ asset('/images/icon/favourite.svg') }}"></span>
                <span class="txt">{{ trans('common.dashboard_side_menu.favourite') }}</span>
            </a>

            <a class="aside-menu-item" id="side_menu_deposit" href="{{ route('dashboard.deposit') }}">
                <span class="icon"><img src="{{ asset('/images/icon/remittance.svg') }}"></span>
                <span class="txt">{{ trans('common.dashboard_side_menu.deposit') }}</span>
            </a>

            <a class="aside-menu-item" id="side_menu_history" href="{{ route('dashboard.txhistory') }}">
                <span class="icon"><img src="{{ asset('/images/icon/history.svg') }}"></span>
                <span class="txt">{{ trans('common.dashboard_side_menu.history') }}</span>
            </a>

            <a class="aside-menu-item" id="side_menu_identification" href="{{ route('dashboard.identification') }}">
                <span class="icon"><img src="{{ asset('/images/icon/identify.svg') }}"></span>
                <span class="txt">{{ trans('common.dashboard_side_menu.identification') }}</span>
            </a>

            @if(auth()->user()->type == HELPER)
            <a class="aside-menu-item" id="side_menu_skill" href="{{ route('dashboard.skill') }}">
                <span class="icon"><img src="{{ asset('/images/icon/skill.svg') }}"></span>
                <span class="txt">{{ trans('common.dashboard_side_menu.skill') }}</span>
            </a>
            @endif

            <a class="aside-menu-item" id="side_menu_setting" href="{{ route('dashboard.setting.changepwd') }}">
                <span class="icon"><img src="{{ asset('/images/icon/setting.svg') }}"></span>
                <span class="txt">{{ trans('common.dashboard_side_menu.setting') }}</span>
            </a>

            <a class="aside-menu-item" id="side_menu_help" href="#">
                <span class="icon"><img src="{{ asset('/images/icon/help.svg') }}"></span>
                <span class="txt">{{ trans('common.dashboard_side_menu.help') }}</span>
            </a>
        </div>

        <div class="aside-bottom">
            <a href="{{ route('dashboard.job.search') }}">
                <span class="icon"><i class="fa fa-search"></i></span>
                <span class="txt">{{ trans('button.search_job') }}</span>
            </a>

            <a href="{{ route('top') }}">
                <span class="icon"><i class="ti-arrow-circle-left"></i></span>
                <span class="txt">{{ trans('button.to_top') }}</span>
            </a>
        </div>
    </aside>

    <main class="dashboard-main-home">
        <div class="main block-3">
            <div class="main-l main-block main-block-white border-right">
                <div class="main-1-title setting-board border-bottom grey-color">
                    <h3>{{ trans('common.setting') }}</h3>
                </div>
                <div class="setting-list">
                    <a class="border-bottom" id="setting_changepwd" href="{{ route('dashboard.setting.changepwd') }}">
                        <div class="setting-col">
                            <div class="setting-info">
                                <h4 class="">{{ trans('common.dashboard_setting_menu.setting') }}</h4>
                            </div>
                            <i class="fa fa-chevron-right"></i>
                        </div>
                    </a>
                    <a class="border-bottom">
                        <div class="setting-col">
                            <div class="setting-info">
                                <h4 class="">{{ trans('common.dashboard_setting_menu.point') }}</h4>
                            </div>
                            <i class="fa fa-chevron-right"></i>
                        </div>
                    </a>
                    <a class="border-bottom" id="setting_bank_account" href="{{ route('dashboard.setting.bankaccount') }}">
                        <div class="setting-col">
                            <div class="setting-info">
                                <h4 class="">{{ trans('common.dashboard_setting_menu.payment') }}</h4>
                            </div>
                            <i class="fa fa-chevron-right"></i>
                        </div>
                    </a>
                    <a class="border-bottom" id="setting_notification" href="{{ route('dashboard.setting.notification') }}">
                        <div class="setting-col">
                            <div class="setting-info">
                                <h4 class="">{{ trans('common.dashboard_setting_menu.notification') }}</h4>
                            </div>
                            <i class="fa fa-chevron-right"></i>
                        </div>
                    </a>
                    <a class="border-bottom">
                        <div class="setting-col">
                            <div class="setting-info">
                                <h4 class="">{{ trans('common.dashboard_setting_menu.privacy') }}</h4>
                            </div>
                            <i class="fa fa-chevron-right"></i>
                        </div>
                    </a>
                    <a class="border-bottom">
                        <div class="setting-col">
                            <div class="setting-info">
                                <h4 class="">{{ trans('common.dashboard_setting_menu.faq') }}</h4>
                            </div>
                            <i class="fa fa-chevron-right"></i>
                        </div>
                    </a>
                    <a class="border-bottom" id="setting_contactus" href="{{ route('dashboard.setting.contactus') }}">
                        <div class="setting-col">
                            <div class="setting-info">
                                <h4 class="">{{ trans('common.dashboard_setting_menu.contactus') }}</h4>
                            </div>
                            <i class="fa fa-chevron-right"></i>
                        </div>
                    </a>
                    <a class="border-bottom" id="setting_service" href="{{ route('dashboard.setting.service') }}">
                        <div class="setting-col">
                            <div class="setting-info">
                                <h4 class="">{{ trans('common.dashboard_setting_menu.service') }}</h4>
                            </div>
                            <i class="fa fa-chevron-right"></i>
                        </div>
                    </a>
                    <a class="border-bottom" onclick="logoutPopup()">
                        <div class="setting-col">
                            <div class="setting-info">
                                <h4 class="">{{ trans('common.dashboard_setting_menu.logout') }}</h4>
                            </div>
                            <i class="fa fa-chevron-right"></i>
                        </div>
                    </a>
                </div>
            </div>
            @yield('content')
        </div>

        <div class="main-r">
            <a class="back-btn" href="{{ url()->previous() }}">
                <div>
                    <p>{{ trans('button.back_page') }}</p>
                    <p class="arrow">←</p>
                </div>
            </a>
        </div>
    </main>
</div>

<div id="dialog-overlay"></div>
<div id="dialog-box" class="dialog-box logout">
    <button class="btn default-btn logout-btn cursor-pointer" onclick="logout()">{{ trans('button.logout') }}</button>
    <a id="close" class="btn default-btn logout-btn">{{ trans('button.cancel') }}</a>
</div>
<form method="POST" action="{{ route('logout') }}" id="logout_form">
    @csrf
</form>

<script>
    function logout() {
        $('#logout_form').submit();
    }
</script>
<script src="{{ asset('/js/script.js') }}"></script>
</body>
</html>