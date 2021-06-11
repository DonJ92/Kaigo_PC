@extends('layouts.setting')

@section('content')
    <div class="main-m main-block main-block-white">
        <div class="main-m-title setting-board border-bottom-light">
        </div>
        <div class="setting-block">
            <h4 class="setting-title">出勤先銀行口座の登録</h4>
            <div class="setting-detail-block">
                <form>
                    <div class="field-row">
                        <p class="field-ttl">銀行名</p>
                        <input class="form" type="text" placeholder="〇〇銀行">
                    </div>
                    <div class="field-row">
                        <p class="field-ttl">⽀店名</p>
                        <input class="form" type="text" placeholder="〇〇支店">
                    </div>
                    <div class="field-row">
                        <p class="field-ttl">⼝座種別</p>
                        <input class="form" type="text" placeholder="普通">
                    </div>
                    <div class="field-row">
                        <p class="field-ttl">⼝座番号</p>
                        <input class="form" type="text" placeholder="0000000">
                    </div>
                    <div class="div flex">
                        <div class="field-row one-third">
                            <p class="field-ttl">姓（カナ）</p>
                            <input class="form" type="text" placeholder="ヤマダ">
                        </div>
                        <div class="field-row one-third">
                            <p class="field-ttl">名（カナ）</p>
                            <input class="form" type="text" placeholder="ハナコ">
                        </div>
                    </div>
                    <div class="btn-block right">
                        <a class="btn primary-btn" href="{{ route('dashboard.setting.creditcard') }}">クレジットカードを登録</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
