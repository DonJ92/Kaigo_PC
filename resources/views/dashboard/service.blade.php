@extends('layouts.setting')

@section('content')
    <div class="main-m main-block main-block-white">
        <div class="main-m-title setting-board border-bottom-light">
        </div>
        <div class="setting-block">
            <h4 class="setting-title">退会</h4>
            <div class="setting-detail-block">
                <form>
                    <div class="div col-2-1 margin-center">
                        <div class="service-div">
                            <p>Helpersをご利⽤いただき、誠にありがとうございます。 退会につきまして、以下の注意⽂を必ずお読みください。</p>
                        </div>
                        <div class="service-div">
                            <h3 class="title">注意実項&nbsp;&nbsp;<span class="status primary-bg service-status">必修</span></h3>
                            <hr class="title-bottom-line">
                            <p>注意事項をすべてご確認の上チェックをしてください。</p>
                            <div class="checkbox-div"><input class="checkbox" type="checkbox"><label for="">サービス名の全ての有料サービスを解約しました。</label></div>
                            <div class="checkbox-div"><input class="checkbox" type="checkbox"><label for="">有料会員期間が終わっていたとしても、月割り・日割り出のご返金は行っておりません。</label></div>
                            <div class="checkbox-div"><input class="checkbox" type="checkbox"><label for="">過去のやり取りやメッセージなどのすべてのデータが削除されます。</label></div>
                            <div class="checkbox-div"><input class="checkbox" type="checkbox"><label for="">一度退会してしまうと7日間再登録することがっできません。</label></div>
                            <div class="checkbox-div"><input class="checkbox" type="checkbox"><label for="">再登録しても、過去のデータを引き続ぐ事はできません。</label></div>
                            <p class="light-pink">「振込可能金額」のデータも全て削除され、復元されることはございません。</p>
                            <div class="deposit-amount-div div margin-center">
                                <span>振込可能金額</span>&nbsp;&nbsp;&nbsp;<h2>2,000</h2>
                            </div>
                        </div>
                        <div class="service-div">
                            <h3 class="title">退会理由&nbsp;&nbsp;<span class="status primary-bg service-status">必修</span></h3>
                            <hr class="title-bottom-line">
                            <p>退会理由を選択してください。（複数選択可）</p>
                            <div class="checkbox-div"><input class="checkbox" type="checkbox"><label for="">希望する条件に合う案件とマッチングしない</label></div>
                            <div class="checkbox-div"><input class="checkbox" type="checkbox"><label for="">使い方がよくわからない</label></div>
                            <div class="checkbox-div"><input class="checkbox" type="checkbox"><label for="">他のサービスを利用するため</label></div>
                            <div class="checkbox-div"><input class="checkbox" type="checkbox"><label for="">サービス内に不快な思いをしたため</label></div>
                        </div>
                        <div class="service-div">
                            <h3 class="title">ご意見&nbsp;&nbsp;<span class="status secondary-bg service-status">任意</span></h3>
                            <hr class="title-bottom-line">
                            <p>サービス名に改善してほしいポイントや欲しかった機能、その他ご意見があれば教えてください</p>
                            <div class="field-row one-one">
                                <textarea class="form form-textarea"></textarea>
                            </div>
                        </div>
                        <div class="service-div div center">
                            <h1>退会しますか？</h1>
                            <button class="btn default-btn service-btn">退会する</button>
                            <button class="btn default-btn service-btn">キャンセル</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
