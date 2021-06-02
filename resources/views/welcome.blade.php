<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="Content-Script-Type" content="text/javascript" />
        <meta http-equiv="Content-Style-Type" content="text/css" />
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title></title>

        <!-- css -->
        <link rel="stylesheet" href="{{ asset('/css/app.css') }}">

        <!-- javascript -->
        <script src="{{ asset('/js/app.js') }}"></script>
    </head>

    <body class="home">
        <section id="main-visual" class="main-visual">
            <div class="mv-r">
                <div class="mv-r-figure">
                    <div class="mv-r-figure-wrapper">
                    </div>

                    <div class="mv-r-regist-login">
                        <div class="mv-r-regist-login-wrapper">
                            <div class="mv-r-rl-item mv-r-regist">
                                <a href="register.html"><span>新規登録</span></a>
                            </div>
                            <div class="mv-r-rl-item mv-r-login">
                                <a href="login.html"><span>ログイン</span></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mv-r-search-row search-row">
                    <a href="jobs.html" class="mv-r-search-link search-link">
                        <i class="fa fa-search"></i>
                        <span>案件を探す</span>
                        <i class="ti-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <div class="mv-l">
                <h2 class="mv-logo">
                    <a href="#">
                        <img src="{{ asset('/images/logo.svg') }}" alt="" />
                    </a>
                </h2>

                <div class="mv-ttl">
                    <h2 class="mv-ttl-main">あなたにピッタリな<br>ヘルパーと出会う</h2>
                    <h3 class="mv-ttl-sub">
                        「人出が足りない介護施設」と「働き手であるヘルパー」との<br>マッチングプラットフォーム
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
                            <span class="for-space"></span>アプリを今すぐ<br>
                            ダウンロード
                        </p>
                        <div class="mv-lead-links cta-block-links">
                            <a href="#"><img src="{{ asset('/images/link-app-store.png') }}" alt="" /></a>
                            <a href="#"><img src="{{ asset('/images/link-google-play.png') }}" alt="" /></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <header id="header">
            <div class="site-header">
                <h1 class="logo">
                    <a href="#">
                        <img src="{{ asset('/images/logo.svg') }}" alt="" />
                    </a>
                </h1>
                <div id="global-nav" class="global-nav">
                    <nav>
                        <ul class="nav-list">
                            <li class="nav-item news"><a href="#"><span>NEWS</span></a></li>
                            <li class="nav-item search"><a href="jobs.html"><i class="fa fa-search"></i><span>案件を探す</span></a></li>
                            <li class="nav-item regist"><a href="register.html"><span>新規登録</span></a></li>
                            <li class="nav-item login"><a href="login.html"><span>ログイン</span></a></li>
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

        <section id="search" class="search">
            <div class="search-inner">
                <div class="search-box">
                    <form>
                        <p class="search-ttl">カンタン検索</p>

                        <div class="search-field-item">
                            <p class="search-field-ttl">職種</p>
                            <select>
                                <option value="" selected="">生活相談員</option>
                            </select>
                        </div>

                        <div class="search-field-item">
                            <p class="search-field-ttl">地域</p>
                            <select>
                                <option value="" selected="">東京都</option>
                            </select>
                        </div>

                        <div class="search-field-item">
                            <p class="search-field-ttl">日時</p>
                            <select>
                                <option value="" selected="">日付を選択</option>
                            </select>
                        </div>
                        <a href="jobs.html" class="btn-search"><span>検索</span><i class="ti-arrow-circle-right"></i></a>
                        <!--                    <button type="submit" class="btn-search"><span>検索</span><i class="ti-arrow-circle-right"></i></button>-->
                    </form>
                </div>
            </div>
        </section>

        <section id="job" class="job">
            <div class="job-tr"></div>
            <div class="job-bl"></div>
            <div class="job-inner">
                <h3 class="job-ttl sec-ttl"><span><i></i>新着案件一覧</span></h3>

                <div class="job-list">
                    @for ($i = 0; $i < 6; $i++)
                    <div class="job-item">
                        <div class="job-item-customer">
                            <div class="job-item-customer-photo">
                                <img src="{{ asset('/images/common/photo-01.jpg') }}" alt="" />
                            </div>
                            <div class="job-item-customer-infos">
                                <p class="job-item-customer-ttl">発注者名</p>
                                <p class="job-item-customer-place">場所</p>
                            </div>
                        </div>

                        <h4 class="job-item-ttl">案件タイトル</h4>
                        <div class="job-item-meta">
                            <p class="job-item-meta-head">日時</p>
                            <p class="job-item-meta-data">12/15(金) 14:00~18:00</p>
                        </div>
                        <div class="job-item-meta">
                            <p class="job-item-meta-head">時給</p>
                            <p class="job-item-meta-data">¥3,000~ / 1h</p>
                        </div>
                        <div class="job-item-figure" style="background: url({{ asset('/images/common/job-figure.jpg') }});"></div>
                        <div class="job-item-share">
                            <i class="fa fa-share-alt"></i>
                            <div class="job-item-share-r">
                                <a onclick="loginPopup()">
                                    <span>応募する</span>
                                    <i class="ti-comment "></i>
                                </a>
                                <a onclick="loginPopup()">
                                    <span>お気に入り</span>
                                    <i class="ti-heart"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endfor
                </div>

                <div class="search-row">
                    <a href="jobs.html" class="search-link">
                        <i class="fa fa-search"></i>
                        <span>案件を探す</span>
                        <i class="ti-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <a class="btn-contact job-contact" onclick="loginPopup()">
                <div class="job-contact-inner">
                    <span>新規案件申し込みはコチラ</span>
                    <i class="ti-arrow-circle-right"></i>
                </div>
            </a>
        </section>

        <section id="worker" class="worker">
            <div class="worker-inner">
                <h3 class="worker-ttl sec-ttl sec-ttl-r"><span><i></i>人気ヘルパー</span></h3>

                <div class="worker-list">
                    @for ($i = 0; $i < 9; $i++)
                    <div class="worker-item">
                        <div class="worker-item-head">
                            <div class="worker-item-photo">
                                <img src="{{ asset('/images/common/photo-02.jpg') }}" alt="" />
                            </div>
                            <div class="worker-item-infos">
                                <div class="worker-item-ttl">
                                    <span>ニックネーム</span>
                                    <div class="worker-item-review">
                                        <p class="worker-item-txt">レビュー　4</p>
                                        <i class="fa fa-star st-act"></i>
                                        <i class="fa fa-star st-act"></i>
                                        <i class="fa fa-star st-act"></i>
                                        <i class="fa fa-star st-act"></i>
                                        <i class="fa fa-star"></i>
                                        <p class="worker-item-txt">(26件)</p>
                                    </div>
                                </div>
                                <p class="worker-item-address">居住地</p>
                            </div>
                        </div>

                        <div class="worker-item-attr-list">
                            <div class="worker-item-attr-item">
                                <div class="worker-item-attr-item-inner">
                                    <div class="worker-item-attr-item-icon">
                                        <img src="{{ asset('/images/common/ico-female.png') }}" alt="" />
                                    </div>
                                    <p class="worker-item-attr-item-txt-small">女性</p>
                                </div>
                            </div>

                            <div class="worker-item-attr-item">
                                <div class="worker-item-attr-item-inner">
                                    <p class="worker-item-attr-item-txt-large">25~30</p>
                                    <p class="worker-item-attr-item-txt-small">年齢</p>
                                </div>
                            </div>

                            <div class="worker-item-attr-item">
                                <div class="worker-item-attr-item-inner">
                                    <p class="worker-item-attr-item-txt-large">生活相談員資格</p>
                                    <p class="worker-item-attr-item-txt-small">資格・スキル</p>
                                </div>
                            </div>

                            <div class="worker-item-attr-item">
                                <div class="worker-item-attr-item-inner">
                                    <p class="worker-item-attr-item-txt-large">¥3,000〜</p>
                                    <p class="worker-item-attr-item-txt-small">希望時給</p>
                                </div>
                            </div>
                        </div>

                        <div class="worker-item-cta">
                            <div class="worker-item-cta-inner">
                                <a onclick="loginPopup()">
                                    <span>メッセージ</span>
                                    <i class="ti-comment"></i>
                                </a>
                                <a onclick="loginPopup()">
                                    <span>お気に入り</span>
                                    <i class="ti-heart"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endfor
                </div>

                <div class="search-row search-row-l">
                    <a href="workers.html" class="search-link">
                        <i class="fa fa-search"></i>
                        <span>ヘルパーを探す</span>
                        <i class="ti-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <a class="btn-contact worker-contact" href="register.html">
                <div class="job-contact-inner">
                    <span>ヘルパー登録はコチラ</span>
                    <i class="ti-arrow-circle-right"></i>
                </div>
            </a>
        </section>

        <section id="news" class="news">
            <div class="news-tl"></div>
            <div class="news-inner">
                <h3 class="news-ttl sec-ttl"><span><i></i>NEWS</span></h3>

                <div class="news-row">
                    <div class="news-col">
                        <a href="#">
                            <div class="news-head">
                                <p class="news-category cat-blue">アップデート</p>
                                <p class="news-head-mark">N</p>
                            </div>
                            <h4 class="news-item-ttl">プロフィール項目(ひと言コメント)承認のお知らせ。</h4>
                            <p class="news-date">2020/02/04 20:20</p>
                        </a>

                        <i class="fa fa-chevron-right"></i>
                    </div>

                    <div class="news-col">
                        <a href="#">
                            <div class="news-head">
                                <p class="news-category cat-blue">アップデート</p>
                                <p class="news-head-mark">N</p>
                            </div>
                            <h4 class="news-item-ttl">プロフィール項目(ひと言コメント)承認のお知らせ。</h4>
                            <p class="news-date">2020/02/04 20:20</p>
                        </a>

                        <i class="fa fa-chevron-right"></i>
                    </div>
                </div>

                <div class="news-row">
                    <div class="news-col">
                        <a href="#">
                            <div class="news-head">
                                <p class="news-category cat-red">お知らせ</p>
                                <p class="news-head-mark">N</p>
                            </div>
                            <h4 class="news-item-ttl">【キャンペーン開始】 2月イベント</h4>
                            <p class="news-date">2020/02/04 20:20</p>
                        </a>

                        <i class="fa fa-chevron-right"></i>
                    </div>

                    <div class="news-col">
                        <a href="#">
                            <div class="news-head">
                                <p class="news-category cat-red">お知らせ</p>
                                <p class="news-head-mark">N</p>
                            </div>
                            <h4 class="news-item-ttl">【キャンペーン開始】 2月イベント</h4>
                            <p class="news-date">2020/02/04 20:20</p>
                        </a>

                        <i class="fa fa-chevron-right"></i>
                    </div>
                </div>

                <div class="news-pagination">
                    <div class="news-pagination-inner">
                        <a href="#">
                            <i class="ti-arrow-circle-left"></i>
                        </a>
                        <a href="#">
                            <i class="ti-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </section>
        <!--
            <section id="banner" class="banner">
                <div class="banner-inner">
                    <div id="slider" class="slider">
                        <div class="slide-item">
                            <a href="#">
                                <img src="{{ asset('/images/home/banner-01.jpg') }}" alt="">
                            </a>
                        </div>
                        <div class="slide-item">
                            <a href="#">
                                <img src="{{ asset('/images/home/banner-02.jpg') }}" alt="">
                            </a>
                        </div>
                        <div class="slide-item">
                            <a href="#">
                                <img src="{{ asset('/images/home/banner-03.jpg') }}" alt="">
                            </a>
                        </div>
                        <div class="slide-item">
                            <a href="#">
                                <img src="{{ asset('/images/home/banner-04.jpg') }}" alt="">
                            </a>
                        </div>
                    </div>
                </div>
            </section>
        -->
        <footer>
            <div class="footer-cta">
                <div class="footer-cta-inner">
                    <div class="cta-block">
                        <div class="footer-cta-icon cta-block-icon">
                            <a href="#">
                                <img src="{{ asset('/images/icon.svg') }}" alt="" />
                            </a>
                        </div>
                        <div class="footer-cta-infos cta-block-infos">
                            <p class="footer-cta-txt has-img cta-block-txt">
                                <span class="txt-img"><img src="{{ asset('/images/logo-txt.svg') }}" alt="" /></span>
                                <span class="for-space"></span>アプリを今すぐ<br>
                                ダウンロード
                            </p>
                            <div class="footer-cta-links cta-block-links">
                                <a href="#"><img src="{{ asset('/images/link-app-store.png') }}" alt="" /></a>
                                <a href="#"><img src="{{ asset('/images/link-google-play.png') }}" alt="" /></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="footer-bottom">
                <div class="footer-contact">
                    <div class="footer-contact-inner">
                        <p class="footer-contact-ttl">サービスへのご相談はこちらから</p>
                        <a class="footer-contact-link" onclick="loginPopup()"><span>新規申し込み</span></a>
                        <a class="footer-contact-link" href="register.html"><span>ヘルパー登録</span></a>
                    </div>

                    <a class="scroll-to-top" href="#">
                        <div class="scroll-to-top-inner">
                            <i class="fa fa-arrow-up"></i>
                            <span>PAGE TOP</span>
                        </div>
                    </a>
                </div>

                <div class="footer-menu">
                    <div class="footer-menu-top">
                        <div class="footer-logo">
                            <img src="{{ asset('/images/footer-logo.svg') }}" alt="" />
                        </div>
                        <div id="footer-nav" class="footer-nav">
                            <nav>
                                <ul class="footer-nav-list">
                                    <li class="foonter-nav-item"><a href="#"><span>TOP</span></a></li>
                                    <li class="foonter-nav-item"><a href="#"><span>NEWS</span></a></li>
                                    <li class="foonter-nav-item"><a href="jobs.html"><span>案件を探す</span></a></li>
                                    <li class="foonter-nav-item"><a href="contactus.html"><span>お問い合わせ</span></a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>

                    <div class="footer-menu-bottom">
                        <div class="fmb-right">
                            <a href="#"><span>利用規約</span></a>
                            <span class="sep">/</span>
                            <a href="#"><span>PRIVACY POLICY</span></a>
                        </div>
                        <p class="copyright">COPYRIGHT(C) 〇〇 INC. ALL RIGHT RESERVED.</p>
                    </div>
                </div>
            </div>
        </footer>

        <div id="dialog-overlay"></div>
        <div id="dialog-box" class="dialog-box">
            <div id="close" class="close-btn"><a><i class="fa fa-close"></i></a></div>
            <h2 class="dialog-title">ログイン後操作可能です</h2>
            <img src="{{ asset('/images/dialog-icon.svg') }}">
            <h2 class="dialog-subtitle">あなたにピッタリな ヘルパーと出会う</h2>
            <a href="login.html" class="btn primary-btn">ログイン</a>
            <p class="sub-desc">アカウントをお持ちでない場合<a href="register.html">新規登録</a></p>
        </div>
    </body>
</html>