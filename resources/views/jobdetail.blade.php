@extends('layouts.app')

@section('title', trans('job.search.title'))

@section('header')
    <link href="//cdn.syncfusion.com/ej2/ej2-base/styles/material.css" rel="stylesheet">
    <link href="//cdn.syncfusion.com/ej2/ej2-buttons/styles/material.css" rel="stylesheet">
    <link href="//cdn.syncfusion.com/ej2/ej2-calendars/styles/material.css" rel="stylesheet">

    <script src="{{ asset('js/ej2/ej2.min.js') }}" type="text/javascript"></script>
@endsection

@section('content')
    <div class="main-l main-block main-block-gray">
        <div class="main-1-title">
            <h3>案件一覧</h3>
        </div>
        <div class="job-list">
            @for($i = 0; $i < 4; $i++)
            <div class="job-block one-list">
                <a href="{{ route('job.detail') }}">
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
    <div class="main-m main-block main-block-white">
        <div class="main-m-title">
            <h3>案件詳細</h3>
        </div>
        <div class="job-detail-block">
            <div class="detail-block margin">
                <h2 class="job-title">案件タイトル案件タイトル案件タイトル</h2>
                <div class="job-column-block">
                    <a href="{{ route('client.detail') }}">
                        <div class="job-item-customer">
                            <div class="job-item-customer-photo">
                                <img src="{{ asset('/images/common/photo-01.jpg') }}" alt="" />
                            </div>
                            <div class="job-item-customer-infos">
                                <p class="job-item-customer-ttl">発注者名</p>
                                <p class="job-item-customer-place">場所</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="job-column-block">
                    <div class="job-item-meta">
                        <p class="job-item-meta-head detail">日時</p>
                        <p class="job-item-meta-data detail">12/15(金) 14:00~18:00</p>
                    </div>
                    <div class="job-item-meta">
                        <p class="job-item-meta-head detail">時給</p>
                        <p class="job-item-meta-data detail">¥3,000~ / 1h</p>
                    </div>
                    <div class="job-item-meta">
                        <p class="job-item-meta-head detail">場所</p>
                        <p class="job-item-meta-data detail">東京都渋谷区〜〜</p>
                    </div>
                </div>
                <div class="job-column-block">
                    <p class="detail-content">
                        サンプル文章サンプル文章サンプル文章サンプル文章サンプル文章サンプル文章サンプル文章サンプル文章サンプル文章サンプル文章サンプル文章サンプル文章サンプル文章サンプル文章サンプル文章サンプル文章サンプル文章サンプル文章サンプル文章サンプル文章サンプル文章サンプル文章サンプル文章サンプル文章サンプル文章サンプル文章サンプル文章サンプル文章サンプル文章サンプル文章サンプル文章サンプル文章サンプル文章サンプル文章サンプル文章サンプル文章サンプル文章サンプル文章サンプル文章サンプル文章サンプル文章サンプル文章サンプル文章サンプル文章サンプル文章サンプル文章（はじめましての挨拶パート）
                    </p>
                </div>
                <div class="job-column-block">
                    <h3 class="sub-title">業務詳細</h3>
                    <p class="detail-content">
                        サンプル文章サンプル文章サンプル文章サンプル文章サンプル文章サンプル文章サンプル文章サンプル文章サンプル文章サンプル文章サンプル文章サンプル文章サンプル文章サンプル文章サンプル文章サンプル文章サンプル文章サンプル文章サンプル文章サンプル文章サンプル文章サンプル文章サンプル文章
                    </p>
                </div>
                <div class="job-column-block">
                    <h3 class="sub-title">注意事項</h3>
                    <p class="detail-content">
                        サンプル文章サンプル文章サンプル文章サンプル文章サンプル文章サンプル文章サンプル文章サンプル文章サンプル文章サンプル文章サンプル文章サンプル文章サンプル文章サンプル文章サンプル文章サンプル文章サンプル文章サンプル文章サンプル文章サンプル文章サンプル文章サンプル文章サンプル文章
                    </p>
                </div>
            </div>
            <div class="detail-block">
                <div class="job-slider">
                    <div id="h_slider" class="slider">
                        <div class="slider-item" style="background-image: url({{ asset('/images/common/job-figure.jpg') }})"></div>
                        <div class="slider-item" style="background-image: url({{ asset('/images/common/job-figure.jpg') }})"></div>
                        <div class="slider-item" style="background-image: url({{ asset('/images/common/job-figure.jpg') }})"></div>
                        <div class="slider-item" style="background-image: url({{ asset('/images/common/job-figure.jpg') }})"></div>
                    </div>
                </div>
                <div class="like-block">
                    <p>199&nbsp;<i class="fa fa-heart"></i></p>
                </div>

                <div class="info-list-block">
                    <div class="con-block">
                        <div class="con-title no-border">
                            <h3 class="pink">詳細項目</h3>
                        </div>
                        <div class="con-detail">
                            <span>会社名</span>
                            <div class="con-column"><span>株式会社〇〇</span></div>
                        </div>
                        <div class="con-detail">
                            <span>会社名</span>
                            <div class="con-column"><span>株式会社〇〇</span></div>
                        </div>
                        <div class="con-detail">
                            <span>会社名</span>
                            <div class="con-column"><span>株式会社〇〇</span></div>
                        </div>
                    </div>
                </div>
                <div class="btn-block">
                    <a class="btn secondary-btn" onclick="loginPopup()">応募する</a>
                    <a class="btn primary-btn" onclick="loginPopup()">お気に入り登録</a>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('/js/calendar.js') }}"></script>
@endsection