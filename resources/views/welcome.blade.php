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

        <title>{{ trans('top.title') }} - {{ config('app.name', 'Helper')}}</title>

        <!-- css -->
        <link rel="stylesheet" href="{{ asset('/css/app.css') }}">

        <!-- javascript -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    </head>

    <body class="home">
        @csrf

        <section id="main-visual" class="main-visual">
            <div class="mv-r">
                <div class="mv-r-figure">
                    <div class="mv-r-figure-wrapper">
                    </div>

                    <div class="mv-r-regist-login">
                        <div class="mv-r-regist-login-wrapper">
                            <div class="mv-r-rl-item mv-r-regist">
                                <a href="{{ route('register') }}"><span>{{ trans('button.register') }}</span></a>
                            </div>
                            <div class="mv-r-rl-item mv-r-login">
                                <a href="{{ route('login') }}"><span>{{ trans('button.login') }}</span></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mv-r-search-row search-row">
                    <a href="@auth {{ route('dashboard.job.search') }} @else {{ route('job.search') }} @endauth" class="mv-r-search-link search-link">
                        <i class="fa fa-search"></i>
                        <span>{{ trans('button.search_job') }}</span>
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
                    <h2 class="mv-ttl-main">{{ trans('top.main_title_pre') }}<br>{{ trans('top.main_title_sur') }}</h2>
                    <h3 class="mv-ttl-sub">
                        {{ trans('top.main_desc_pre') }}<br>{{ trans('top.main_desc_sur') }}
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
                            <span class="for-space"></span>{{ trans('top.download_desc_pre') }}<br>
                            {{ trans('top.download_desc_sur') }}
                        </p>
                        <div class="mv-lead-links cta-block-links">
                            <a href="#"><img class="logo_img" src="{{ asset('/images/link-app-store.png') }}" alt="" /></a>
                            <a href="#"><img class="logo_img" src="{{ asset('/images/link-google-play.png') }}" alt="" /></a>
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
                            <li class="nav-item search"><a href="{{ route('job.search') }}"><i class="fa fa-search"></i><span>案件を探す</span></a></li>
                            <li class="nav-item regist"><a href="{{ route('register') }}"><span>新規登録</span></a></li>
                            <li class="nav-item login"><a href="{{ route('login') }}"><span>ログイン</span></a></li>
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
                        <p class="search-ttl">{{ trans('top.search_panel_title') }}</p>

                        <div class="search-field-item">
                            <p class="search-field-ttl">{{ trans('common.job_type') }}</p>
                            <select id="certificate" name="certiciate">
                                <option value="" disabled selected>{{ trans('top.job_type_placeholder') }}</option>
                                @foreach($job_list as $job_info)
                                    <option value="{{ $job_info['id'] }}">{{ $job_info['job_type'] }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="search-field-item">
                            <p class="search-field-ttl">{{ trans('common.area') }}</p>
                            <select id="province" name="province">
                                <option value="" disabled selected>{{ trans('top.area_placeholder') }}</option>
                                @foreach($province_list as $province_info)
                                    <option value="{{ $province_info['id'] }}">{{ $province_info['name'] }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="search-field-item">
                            <p class="search-field-ttl">{{ trans('common.datetime') }}</p>
                            <select>
                                <option value="" disabled selected>{{ trans('top.datetime_placeholder') }}</option>
                            </select>
                        </div>
                        <a href="{{ route('job.search') }}" class="btn-search"><span>{{ trans('button.search') }}</span><i class="ti-arrow-circle-right"></i></a>
                        <!--                    <button type="submit" class="btn-search"><span>検索</span><i class="ti-arrow-circle-right"></i></button>-->
                    </form>
                </div>
            </div>
        </section>

        <section id="job" class="job">
            <div class="job-tr"></div>
            <div class="job-bl"></div>
            <div class="job-inner">
                <h3 class="job-ttl sec-ttl"><span><i></i>{{ trans('top.job_list_title') }}</span></h3>

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
                            <p class="job-item-meta-head">{{ trans('common.datetime') }}</p>
                            <p class="job-item-meta-data">12/15(金) 14:00~18:00</p>
                        </div>
                        <div class="job-item-meta">
                            <p class="job-item-meta-head">{{ trans('common.cost') }}</p>
                            <p class="job-item-meta-data">¥3,000~ / 1h</p>
                        </div>
                        <div class="job-item-figure" style="background: url({{ asset('/images/common/job-figure.jpg') }});"></div>
                        <div class="job-item-share">
                            <i class="fa fa-share-alt"></i>
                            <div class="job-item-share-r">
                                <a @auth href="#" @else onclick="loginPopup()" @endauth>
                                    <span>{{ trans('button.bid') }}</span>
                                    <i class="ti-comment "></i>
                                </a>
                                <a onclick="@auth @else loginPopup() @endauth">
                                    <span>{{ trans('button.favourite') }}</span>
                                    <i class="ti-heart"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endfor
                </div>

                <div class="search-row">
                    <a href="@auth {{ route('dashboard.job.search') }} @else {{ route('job.search') }}  @endauth" class="search-link">
                        <i class="fa fa-search"></i>
                        <span>{{ trans('button.search_job') }}</span>
                        <i class="ti-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <a class="btn-contact job-contact" @auth href="{{ route('dashboard.job.register') }}" @else onclick="loginPopup()" @endauth>
                <div class="job-contact-inner">
                    <span>{{ trans('top.new_job') }}</span>
                    <i class="ti-arrow-circle-right"></i>
                </div>
            </a>
        </section>

        <section id="worker" class="worker">
            <div class="worker-inner">
                <h3 class="worker-ttl sec-ttl sec-ttl-r"><span><i></i>{{ trans('top.helper_list_title') }}</span></h3>

                <div class="worker-list">
                    @foreach( $helper_list as $helper_info)
                    <div class="worker-item">
                        <div class="worker-item-head">
                            <div class="worker-item-photo">
                                <a href="@auth {{ url('dashboard/helper/detail/').'/'.$helper_info['id'] }} @else {{ url('helper/detail/').'/'.$helper_info['id'] }} @endauth"><img src="{{ $helper_info['photo'] }}" alt="" /></a>
                            </div>
                            <div class="worker-item-infos">
                                <div class="worker-item-ttl">
                                    <span><a href="{{ url('dashboard/helper/detail/').'/'.$helper_info['id'] }}">{{ $helper_info['last_name'] . $helper_info['first_name'] }}</a></span>
                                    <div class="worker-item-review">
                                        <p class="worker-item-txt">{{ trans('common.review') }}　4</p>
                                        <i class="fa fa-star st-act"></i>
                                        <i class="fa fa-star st-act"></i>
                                        <i class="fa fa-star st-act"></i>
                                        <i class="fa fa-star st-act"></i>
                                        <i class="fa fa-star"></i>
                                        <p class="worker-item-txt">(26件)</p>
                                    </div>
                                </div>
                                <p class="worker-item-address">{{ $helper_info['province_name'] }}</p>
                            </div>
                        </div>

                        <div class="worker-item-attr-list">
                            <div class="worker-item-attr-item">
                                <div class="worker-item-attr-item-inner">
                                    <div class="worker-item-attr-item-icon">
                                        <img src="{{ asset('/images/common/ico-female.png') }}" alt="" />
                                    </div>
                                    <p class="worker-item-attr-item-txt-small">{{ $helper_info['gender'] }}</p>
                                </div>
                            </div>

                            <div class="worker-item-attr-item">
                                <div class="worker-item-attr-item-inner">
                                    <p class="worker-item-attr-item-txt-large">{{ $helper_info['age'] }}</p>
                                    <p class="worker-item-attr-item-txt-small">{{ trans('common.age') }}</p>
                                </div>
                            </div>

                            <div class="worker-item-attr-item cert">
                                <div class="worker-item-attr-item-inner">
                                    <p class="worker-item-attr-item-txt-large">{{ $helper_info['certificate'] }}</p>
                                    <p class="worker-item-attr-item-txt-small">{{ trans('common.skill') }}</p>
                                </div>
                            </div>

                            <div class="worker-item-attr-item">
                                <div class="worker-item-attr-item-inner">
                                    <p class="worker-item-attr-item-txt-large">{{ $helper_info['hourly_cost'] }}</p>
                                    <p class="worker-item-attr-item-txt-small">{{ trans('common.desired_cost') }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="worker-item-cta">
                            <div class="worker-item-cta-inner">
                                <a @auth @else onclick="loginPopup()" @endauth>
                                    <span>{{ trans('button.message') }}</span>
                                    <i class="ti-comment"></i>
                                </a>
                                @if( $helper_info['favourite_id'] == null)
                                    <a onclick="@auth onFavourite({{$helper_info['id']}}) @else loginPopup() @endauth">
                                        <span>{{ trans('button.favourite') }}</span>
                                        <i class="fa fa-heart-o" id="like_ico_{{$helper_info['id']}}"></i>
                                    </a>
                                @else
                                    <a onclick="@auth onUnFavourite({{$helper_info['id']}}) @else loginPopup() @endauth" id="like_{{$helper_info['id']}}">
                                        <span>{{ trans('button.favourite') }}</span>
                                        @auth <i class="fa fa-heart light-pink" id="like_ico_{{$helper_info['id']}}"></i> @else <i class="fa fa-heart-o" id="like_ico_{{$helper_info['id']}}"></i> @endauth
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="search-row search-row-l">
                    <a href="@auth {{ route('dashboard.helper.search') }} @else {{ route('helper.search') }} @endauth" class="search-link">
                        <i class="fa fa-search"></i>
                        <span>{{ trans('button.search_helper') }}</span>
                        <i class="ti-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <a class="btn-contact worker-contact" href="{{ route('register') }}">
                <div class="job-contact-inner">
                    <span>{{ trans('top.new_helper') }}</span>
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
                            <a>
                                <img src="{{ asset('/images/icon.svg') }}" alt="" />
                            </a>
                        </div>
                        <div class="footer-cta-infos cta-block-infos">
                            <p class="footer-cta-txt has-img cta-block-txt">
                                <span class="txt-img"><img src="{{ asset('/images/logo-txt.svg') }}" alt="" /></span>
                                <span class="for-space"></span>{{ trans('top.download_desc_pre') }}<br>
                                {{ trans('top.download_desc_sur') }}
                            </p>
                            <div class="footer-cta-links cta-block-links">
                                <a href="#"><img class="logo_img" src="{{ asset('/images/link-app-store.png') }}" alt="" /></a>
                                <a href="#"><img class="logo_img" src="{{ asset('/images/link-google-play.png') }}" alt="" /></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="footer-bottom">
                <div class="footer-contact">
                    <div class="footer-contact-inner">
                        <p class="footer-contact-ttl">{{ trans('top.footer_desc') }}</p>
                        <a class="footer-contact-link" onclick="loginPopup()"><span>{{ trans('button.register_job') }}</span></a>
                        <a class="footer-contact-link" href="{{ route('register') }}"><span>{{ trans('button.register_helper') }}</span></a>
                    </div>

                    <a class="scroll-to-top" href="#">
                        <div class="scroll-to-top-inner">
                            <i class="fa fa-arrow-up"></i>
                            <span>{{ trans('button.page_top') }}</span>
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
                                    <li class="foonter-nav-item"><a href="{{ route('top') }}"><span>{{ trans('common.footer_menu.top') }}</span></a></li>
                                    <li class="foonter-nav-item"><a href="#"><span>{{ trans('common.footer_menu.news') }}</span></a></li>
                                    <li class="foonter-nav-item"><a href="@auth {{ route('dashboard.job.search') }} @else {{ route('job.search') }} @endauth"><span>{{ trans('common.footer_menu.search_job') }}</span></a></li>
                                    <li class="foonter-nav-item"><a href="@auth {{ route('dashboard.setting.contactus') }} @else {{ route('contactus') }} @endauth"><span>{{ trans('common.footer_menu.contact_us') }}</span></a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>

                    <div class="footer-menu-bottom">
                        <div class="fmb-right">
                            <a href="#"><span>{{ trans('common.term') }}</span></a>
                            <span class="sep">/</span>
                            <a href="#"><span>{{ trans('common.privacy') }}</span></a>
                        </div>
                        <p class="copyright">{{ trans('common.copyright') }}</p>
                    </div>
                </div>
            </div>
        </footer>

        <div id="dialog-overlay"></div>
        <div id="dialog-box" class="dialog-box">
            <div id="close" class="close-btn"><a><i class="fa fa-close"></i></a></div>
            <h2 class="dialog-title">{{ trans('common.login_dialog.title') }}</h2>
            <img src="{{ asset('/images/dialog-icon.svg') }}">
            <h2 class="dialog-subtitle">{{ trans('common.login_dialog.desc') }}</h2>
            <a href="{{ route('login') }}" class="btn primary-btn">{{ trans('button.login') }}</a>
            <p class="sub-desc">{{ trans('common.login_dialog.register_desc') }}<a href="{{ route('register') }}">{{ trans('button.register') }}</a></p>
        </div>

        <script src="{{ asset('/js/script.js') }}"></script>
        <script>
            function onFavourite(helper_id) {
                var token = $("input[name=_token]").val();

                $.ajax({
                    url: '{{ route('dashboard.helper.favourite') }}',
                    type: 'POST',
                    data: {_token: token, helper_id: helper_id},
                    dataType: 'JSON',
                    success: function (response) {
                        if (response == true) {
                            toastr.success('{{ trans('favourite.register_success') }}', '', {"closeButton": true});
                            $("#like_ico_"+helper_id).removeClass();
                            $("#like_ico_"+helper_id).addClass('fa fa-heart light-pink');
                            $("#like_"+helper_id).attr('onclick', 'onUnFavourite(' + helper_id + ')');
                        } else
                            toastr.error('{{ trans('favourite.register_failed') }}', '', { "closeButton": true });
                    }
                });

            }

            function onUnFavourite(helper_id) {
                var token = $("input[name=_token]").val();

                $.ajax({
                    url: '{{ route('dashboard.helper.favourite.cancel') }}',
                    type: 'POST',
                    data: {_token: token, helper_id: helper_id},
                    dataType: 'JSON',
                    success: function (response) {
                        if (response == true) {
                            toastr.success('{{ trans('favourite.cancel_success') }}', '', {"closeButton": true});
                            $("#like_ico_"+helper_id).removeClass();
                            $("#like_ico_"+helper_id).addClass('fa fa-heart-o');
                            $("#like_"+helper_id).attr('onclick', 'onFavourite(' + helper_id + ')');
                        } else
                            toastr.error('{{ trans('favourite.cancel_failed') }}', '', { "closeButton": true });
                    }
                });

            }
        </script>
    </body>
</html>