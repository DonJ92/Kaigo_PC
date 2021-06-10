@extends('layouts.app')

@section('title', trans('job.search.title'))

@section('header')
    <link href="//cdn.syncfusion.com/ej2/ej2-base/styles/material.css" rel="stylesheet">
    <link href="//cdn.syncfusion.com/ej2/ej2-buttons/styles/material.css" rel="stylesheet">
    <link href="//cdn.syncfusion.com/ej2/ej2-calendars/styles/material.css" rel="stylesheet">

    <script src="{{ asset('js/ej2/ej2.min.js') }}" type="text/javascript"></script>
@endsection

@section('content')
    <div class="main-l main-block main-block-white">
        <div class="main-1-title">
            <h3>案件検索</h3>
        </div>
        <form class="search-block">
            <div>
                <input class="form" type="text" placeholder="東京都　保育">
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
            <h3>ヘルパー一覧</h3>
        </div>
        <div class="worker-list">
            @for($i = 0; $i < 8; $i++)
            <div class="worker-block">
                <a href="{{ route('helper.detail') }}">
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
                                <a href="#">
                                    <span>メッセージ</span>
                                    <i class="ti-comment"></i>
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

    <script src="{{ asset('/js/calendar.js') }}"></script>
@endsection