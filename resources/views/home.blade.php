@extends('layouts.dashboard')

@section('header')
    <link href="//cdn.syncfusion.com/ej2/ej2-base/styles/material.css" rel="stylesheet">
    <link href="//cdn.syncfusion.com/ej2/ej2-buttons/styles/material.css" rel="stylesheet">
    <link href="//cdn.syncfusion.com/ej2/ej2-calendars/styles/material.css" rel="stylesheet">

    <script src="{{ asset('js/ej2/ej2.min.js') }}" type="text/javascript"></script>
@endsection

@section('title', trans('dashboard.title'))

@section('content')
    <div class="main">
        <h3 class="dashboard-ttl">{{ trans('dashboard.title') }}</h3>
        <div class="dashbaord-home-row">
            <div class="dashbaord-home-col balance">
                <div class="div col-2-1 right-border center">
                    <h3 class="sub-title">{{ trans('dashboard.balance') }}</h3>
                    <p class="balance-txt">¥99,999,999</p>
                </div>
                <div class="div col-2-1 center">
                    <h3 class="sub-title">{{ trans('dashboard.status') }}</h3>
                    <p class="status dashboard no-identify">{{ $status }}</p>
                </div>
            </div>

            <div class="dashbaord-home-col banner">
                {{ trans('common.campaign_banner') }}
            </div>

            <div class="dashbaord-home-col banner">
                {{ trans('common.campaign_banner') }}
            </div>
        </div>

        <div class="dashbaord-home-row">
            <div class="dashbaord-home-col bottom">
                <h2 class="list-title border-bottom">{{ trans('dashboard.history') }}</h2>
                <div>
                    @for($i = 0; $i < 4; $i++)
                    <div class="row-item border-bottom">
                        <div class="item-block">
                            <img src="{{ asset('/images/common/photo-01.jpg') }}">
                            <div class="item-info">
                                <h3 class="title">案件名</h3>
                                <p class="sub-info"><span><i class="fa fa-calendar"></i>&nbsp;2020/7/31</span>&nbsp;&nbsp;&nbsp;<span><i class="ti-location-pin"></i>&nbsp;東京都</span></p>
                            </div>
                        </div>
                        <div class="payment-block">
                            <div class="div col-2-1">
                                <p class="balance-txt">¥99,999,999</p>
                            </div>
                            <div class="div col-2-1 center">
                                <a href="history.html" class="btn primary-btn payment-btn">領収書を発行</a>
                            </div>
                        </div>
                    </div>
                    @endfor
                </div>
            </div>

            <div class="dashbaord-home-col bottom">
                <h2 class="list-title border-bottom">{{ trans('dashboard.job_register') }}</h2>
                <div id="container">
                    <div id="element"></div>
                </div>
                <div class="btn-block">
                    <button class="btn primary-btn center-align" onclick="test()">予約する</button>
                </div>
            </div>

            <div class="dashbaord-home-col bottom">
                <h2 class="list-title border-bottom">{{ trans('dashboard.favourite') }}</h2>
                <div>
                    @for($i = 0; $i < 5; $i++)
                    <div class="row-item flex border-bottom">
                        <div class="div item-block">
                            <img src="{{ asset('/images/common/photo-01.jpg') }}">
                            <div class="item-info">
                                <h3 class="title">ニックネーム（年齢）</h3>
                                <p class="sub-info">所属・資格</p>
                                <div class="item-review">
                                    <p class="item-txt">レビュー　4</p>
                                    <i class="fa fa-star st-act"></i>
                                    <i class="fa fa-star st-act"></i>
                                    <i class="fa fa-star st-act"></i>
                                    <i class="fa fa-star st-act"></i>
                                    <i class="fa fa-star"></i>
                                    <p class="item-txt">(26件)</p>
                                </div>
                            </div>
                        </div>
                        <div class="div bid-btn-block">
                            <a href="message.html" class="btn primary-btn bid-btn">依頼する</a>
                        </div>
                    </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('/js/calendar.js') }}"></script>
    <script>
        $(window).on('load', function() {
            $('#side_menu_home').addClass('current');
        });
    </script>
@endsection
