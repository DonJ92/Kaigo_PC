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
                    <span class="user-name">ユーザー名&nbsp;&nbsp;<i class="ti-angle-down"></i></span>
                </a>
                <div class="dropdown-content" id="user-popup">
                    <a class="border-bottom" href="#">アカウント設定</a>
                    <a class="secondary-color" onclick="logoutPopup()">ログアウト</a>
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
            <a class="aside-menu-item current" href="index.html">
                <span class="icon"><img src="{{ asset('/images/icon/home.svg') }}"></span>
                <span class="txt">ホーム画面</span>
            </a>

            <a class="aside-menu-item" href="jobs.html">
                <span class="icon"><img src="{{ asset('/images/icon/list.svg') }}"></span>
                <span class="txt">一覧</span>
            </a>

            <a class="aside-menu-item" href="registerjob.html">
                <span class="icon"><img src="{{ asset('/images/icon/reservation.svg') }}"></span>
                <span class="txt">定期予約</span>
            </a>

            <a class="aside-menu-item" href="favouritejobs.html">
                <span class="icon"><img src="{{ asset('/images/icon/favourite.svg') }}"></span>
                <span class="txt">お気に入り</span>
            </a>

            <a class="aside-menu-item" href="deposit.html">
                <span class="icon"><img src="{{ asset('/images/icon/remittance.svg') }}"></span>
                <span class="txt">振込申請</span>
            </a>

            <a class="aside-menu-item" href="history.html">
                <span class="icon"><img src="{{ asset('/images/icon/history.svg') }}"></span>
                <span class="txt">支払履歴（領収書発行）</span>
            </a>

            <a class="aside-menu-item" href="identification.html">
                <span class="icon"><img src="{{ asset('/images/icon/identify.svg') }}"></span>
                <span class="txt">本人認証</span>
            </a>

            <a class="aside-menu-item" href="skill.html">
                <span class="icon"><img src="{{ asset('/images/icon/skill.svg') }}"></span>
                <span class="txt">スキル申請</span>
            </a>

            <a class="aside-menu-item" href="setting/changepassword.html">
                <span class="icon"><img src="{{ asset('/images/icon/setting.svg') }}"></span>
                <span class="txt">設定</span>
            </a>

            <a class="aside-menu-item" href="#">
                <span class="icon"><img src="{{ asset('/images/icon/help.svg') }}"></span>
                <span class="txt">ヘルプ</span>
            </a>
        </div>

        <div class="aside-bottom">
            <a href="#">
                <span class="icon"><i class="fa fa-search"></i></span>
                <span class="txt">案件を探す</span>
            </a>

            <a href="#">
                <span class="icon"><i class="ti-arrow-circle-left"></i></span>
                <span class="txt">TOPに戻る</span>
            </a>
        </div>
    </aside>

    <main class="dashboard-main-home">
        <div class="main">
            @yield('content')
        </div>
        <div class="main-r">
            <a class="back-btn" href="register.html">
                <div>
                    <p>前画面へ戻る</p>
                    <p class="arrow">←</p>
                </div>
            </a>
        </div>
    </main>
</div>

<div id="dialog-overlay"></div>
<div id="dialog-box" class="dialog-box logout">
    <button class="btn default-btn logout-btn" onclick="logout()">ログアウト</button>
    <a id="close" class="btn default-btn logout-btn">キャンセル</a>
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