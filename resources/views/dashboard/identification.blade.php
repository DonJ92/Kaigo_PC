@extends('layouts.dashboard')

@section('content')
    <div class="main">
        <h3 class="dashboard-ttl">本人確認</h3>
        <form>
            <div class="identyfy-div">
                <h3>カンタン本人確認</h3>
                    <p class="identify-desc">Helpersでは不正ユーザーや業者の排除に⼒を⼊れており、本⼈確認を⾏っていただくことで安全・安⼼にサービスをご利⽤いただける機能になります。</p>
                    <div class="identify-warning">
                        <img class="identify-photo" src="{{ asset('/images/identify-confirm.svg') }}">
                        <h3>以下のような画像は承認されません</h3>
                        <p>資格・スキル証明書が明確に⾒えるように 証明書全体が写るように撮影してください。</p>
                    </div>
                    <div class="identify-failure-div">
                        <div>
                            <img src="{{ asset('/images/identify-failure1.svg') }}">
                            <p>画像が<br>⾒切れている</p>
                        </div>
                        <div>
                            <img src="{{ asset('/images/identify-failure2.svg') }}">
                            <p>⼀部が<br>隠されている</p>
                        </div>
                        <div>
                            <img src="{{ asset('/images/identify-failure3.svg') }}">
                            <p>不鮮明で<br>読み取れない</p>
                        </div>
                    </div>
                    <div class="identify-upload-div">
                        <img src="{{ asset('/images/identify-upload.svg') }}">
                    </div>
                    <ul class="content-font">
                        <li>ご登録いただいた情報と、提出された書類の⽣年⽉⽇が⼀致しない場合は承認れませんのでご注意ください。</li>
                        <li>有効期限が切れていないことを確認してください。</li>
                        <li>ご登録いただいた⽣年⽉⽇と、提出された年齢確認書類の⽣年⽉⽇が⼀致しない場合は承認されず、メッセージのやりとりが始められませんのでご注意ください。</li>
                    </ul>
                    <h3 class="center">現在登録されている年齢</h3>
                    <h2 class="confirm-h2">26歳</h2>
                    <p class="content-font center light-pink">※修正が必要な場合には、 下記より正しい⽣年⽉⽇に変更してください。</p>
                    <div class="field-row center">
                        <p class="field-ttl">生年月日を入力してください</p>
                        <input type="date" class="form">
                    </div>
                    <img class="japhic" src="{{ asset('/images/Japhic.svg') }}">
                    <p class="content-font">当社は個⼈情報について適切な保護措置を講ずる体制を整備し、 運⽤、管理をしている企業として、 第三者機関である JAPHIC(ジャフィック)の認証を受けております。</p>
                    <div class="btn-block right">
                        <a class="btn primary-btn right-margin" href="{{ route('dashboard.identification.confirm') }}">次へ</a>
                    </div>
            </div>
        </form>
    </div>
@endsection
