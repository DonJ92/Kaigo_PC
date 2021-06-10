@extends('layouts.dashboard')

@section('content')
    <div class="main full-width no-padding">
        <div class="main no-padding-bottom">
            <h3 class="dashboard-ttl">支払い履歴（領収書発行）</h3>
        </div>
        <div class="main full-width block-3">
            <div class="main-l main-block main-block-white history">
                <div>
                    @for($i = 0; $i < 8; $i++)
                    <div class="row-item border-bottom">
                        <div class="item-block">
                            <img src="/images/common/photo-01.jpg">
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
                                <a href="" class="btn primary-btn payment-btn">領収書を発行</a>
                            </div>
                        </div>
                    </div>
                    @endfor
                </div>
            </div>
            <div class="main-m main-block main-block-gray history">
                <form class="history-block">
                    <p class="desc">領収書を発行するメールアドレスと宛名（任意）を 入力して、「送信する」をタップ</p>
                    <div class="field-row one-one">
                        <p class="field-ttl">メールアドレス※必須</p>
                        <input class="form" type="text" placeholder="メールアドレス※必須">
                    </div>
                    <div class="field-row one-one">
                        <p class="field-ttl">宛名を入力</p>
                        <input class="form" type="text" placeholder="宛名を入力">
                    </div>
                    <div class="btn-block right">
                        <a class="btn primary-btn" href="{{ route('dashboard.receipt.confirm') }}">送信する</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
