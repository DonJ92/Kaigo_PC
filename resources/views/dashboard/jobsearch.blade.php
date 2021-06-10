@extends('layouts.dashboard')

@section('header')
    <link href="//cdn.syncfusion.com/ej2/ej2-base/styles/material.css" rel="stylesheet">
    <link href="//cdn.syncfusion.com/ej2/ej2-buttons/styles/material.css" rel="stylesheet">
    <link href="//cdn.syncfusion.com/ej2/ej2-calendars/styles/material.css" rel="stylesheet">

    <script src="{{ asset('js/ej2/ej2.min.js') }}" type="text/javascript"></script>
@endsection

@section('content')
    <div class="main block-3">
        <div class="main-l main-block main-block-white">
            <div class="main-1-title">
                <h3>案件検索</h3>
            </div>
            <form class="search-block">
                <div>
                    <input class="form" type="text" placeholder="東京都　保育">
                </div>
                <div id="container">
                    <div id="element"></div>
                </div>
                <div class="info-list-block">
                    <div class="title-block">
                        <h2><i class="fa fa-search"></i>&nbsp;検索条件を設定</h2>
                    </div>
                    <div class="con-block">
                        <div class="con-title">
                            <h3>詳細項目</h3>
                        </div>
                        <div class="con-detail">
                            <span>場所</span>
                            <div class="con-column"><span>東京都、神奈川</span></div>
                        </div>
                        <div class="con-detail">
                            <span>時間帯</span>
                            <div class="con-column"><span>10:00〜20:00</span></div>
                        </div>
                        <div class="con-detail">
                            <span>職種</span>
                            <div class="con-column"><span>生活相談員 ></span></div>
                        </div>
                        <div class="con-detail">
                            <span>募集中の仕事のみ</span>
                            <div class="con-column"><span>生活相談員 ></span></div>
                        </div>
                        <div class="con-detail">
                            <span>年齢</span>
                            <div class="con-column"><span>〇〇歳</span></div>
                        </div>
                    </div>
                </div>
                <div class="btn-block">
                    <a class="btn reset-btn" href="#">リセット</a>
                    <a class="btn secondary-btn" href="#">この条件で検索</a>
                </div>
                <div class="btn-map">
                    <a href="#">マップで探す&nbsp<i class="ti-location-pin"></i></a>
                </div>
            </form>
        </div>
        <div class="main-m main-block main-block-gray">
            <div class="main-m-title">
                <h3>案件一覧</h3>
            </div>
            <div class="job-list">
                @for($i = 0; $i < 6; $i++)
                <div class="job-block">
                    <a href="{{ route('dashboard.job.detail') }}">
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
                                    <a href="#">
                                        <span>応募する</span>
                                        <i class="ti-comment "></i>
                                    </a>
                                    <a href="#">
                                        <span>お気に入り</span>
                                        <i class="ti-heart"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @endfor
            </div>
        </div>
    </div>

    <script src="{{ asset('/js/calendar.js') }}"></script>
@endsection
