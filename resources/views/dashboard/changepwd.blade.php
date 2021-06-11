@extends('layouts.setting')

@section('content')
    <div class="main-m main-block main-block-white">
        <div class="main-m-title setting-board border-bottom-light">
        </div>
        <div class="setting-block">
            <h4 class="setting-title">パスワード変更</h4>
            <div class="setting-detail-block">
                <form>
                    <div class="field-row">
                        <p class="field-ttl">現在のパスワード</p>
                        <input class="form" type="password" placeholder="半⾓英数字(6桁以上)">
                    </div>
                    <div class="field-row">
                        <p class="field-ttl">新しいパスワードを入力してください</p>
                        <input class="form" type="password" placeholder="半⾓英数字(6桁以上)">
                    </div>
                    <div class="field-row">
                        <p class="field-ttl">新しいパスワードを⼊⼒してください（確認用）</p>
                        <input class="form" type="password" placeholder="半⾓英数字(6桁以上)">
                    </div>
                    <div class="btn-block right">
                        <button class="btn primary-btn" type="submit">確定</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
