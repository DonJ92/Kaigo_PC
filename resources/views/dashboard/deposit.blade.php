@extends('layouts.dashboard')

@section('content')
    <div class="main">
        <h3 class="dashboard-ttl">振り込み申請</h3>
        <form class="dashbaord-home-row one-column">
            <div class="div col-2-1 deposit-form">
                <h4 class="dashboard-sub-ttl">振り込み金額を入力してください</h4>
                <input class="form underline deposit-amount" type="text" placeholder="¥19,000">
                <p class="desc">2/10（⽉）⼊⾦するには、2/6(⾦)8時59分までに振込申請が必要となります。</p>
            </div>
            <div class="div col-2-1 deposit-form">
                <h4 class="dashboard-sub-ttl">振り込み先情報</h4>
                <div class="row-item border-bottom deposit-list">
                    <div class="item-block space-between">
                        <p class="title">銀行名</p>
                        <p class="info">〇〇銀行</p>
                    </div>
                </div>
                <div class="row-item border-bottom deposit-list">
                    <div class="item-block space-between">
                        <p class="title">支店名</p>
                        <p class="info">〇〇支店</p>
                    </div>
                </div>
                <div class="row-item border-bottom deposit-list">
                    <div class="item-block space-between">
                        <p class="title">口座種別</p>
                        <p class="info">普通</p>
                    </div>
                </div>
                <div class="row-item border-bottom deposit-list">
                    <div class="item-block space-between">
                        <p class="title">口座番号</p>
                        <p class="info">0000000</p>
                    </div>
                </div>
                <div class="row-item border-bottom deposit-list">
                    <div class="item-block space-between">
                        <p class="title">姓（カナ）</p>
                        <p class="info">ヤマダ</p>
                    </div>
                </div>
                <div class="row-item border-bottom deposit-list">
                    <div class="item-block space-between">
                        <p class="title">名（カナ）</p>
                        <p class="info">ハナコ</p>
                    </div>
                </div>
            </div>
            <div class="btn-block right">
                <a class="btn secondary-btn right-margin">振込口座登録</a>
                <a href="{{ route('dashboard.deposit.confirm') }}" class="btn primary-btn right-margin">確定</a>
            </div>
        </form>
    </div>
@endsection
