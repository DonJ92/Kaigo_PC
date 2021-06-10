@extends('layouts.dashboard')

@section('content')
    <div class="main full-width no-padding">
        <div class="main no-padding-bottom">
            <h3 class="dashboard-ttl">新規応募申し込み</h3>
        </div>
        <div class="main full-width block-3">
            <div class="main-l main-block main-block-gray">
                <div class="flow">
                    <ul class="flow-ul">
                        <li class="flow-ttl"><a class="active"><i class="after"></i>日時を選択してください</a></li>
                        <li class="flow-ttl"><a class="active"><i class="after"></i>応募詳細を入力してください</a></li>
                        <li class="flow-ttl"><a class="active"><i class="now"></i>最終確認</a></li>
                    </ul>
                </div>
            </div>
            <div class="main-m main-block main-block-white">
                <form class="register-job-form confirm">
                    <h2 class="sub-title border-bottom">日時</h2>
                    <div class="row-item register-job-list flex border-bottom">
                        <p class="title">日付</p>
                        <p class="info">3/22（月）</p>
                    </div>
                    <div class="row-item register-job-list flex border-bottom">
                        <p class="title">時間帯</p>
                        <p class="info">9:00-16:00</p>
                    </div>

                    <h2 class="sub-title border-bottom">希望</h2>
                    <div class="row-item register-job-list flex border-bottom">
                        <p class="title">ご職種</p>
                        <p class="info">介護</p>
                    </div>
                    <div class="row-item register-job-list flex border-bottom">
                        <p class="title">地域</p>
                        <p class="info">東京都 ⾜⽴区</p>
                    </div>
                    <div class="row-item register-job-list flex border-bottom">
                        <p class="title">報酬</p>
                        <p class="info">¥5,000</p>
                    </div>
                    <div class="row-item register-job-list flex border-bottom">
                        <p class="title">保有資格</p>
                        <p class="info">〇〇２級資格,〇〇２級資格</p>
                    </div>
                    <div class="row-item register-job-list flex border-bottom">
                        <p class="title">労災</p>
                        <p class="info">加⼊してる</p>
                    </div>
                    <div class="row-item register-job-list flex border-bottom">
                        <p class="title">交通費</p>
                        <p class="info">支給あり</p>
                    </div>

                    <h2 class="sub-title border-bottom">支払い</h2>
                    <div class="row-item register-job-list flex border-bottom">
                        <p class="title">支払い方法</p>
                        <p class="info">クレジットカード（下4桁：1048）</p>
                    </div>
                    <div class="row-item register-job-list flex border-bottom">
                        <p class="title">クーポン</p>
                        <p class="info">なし</p>
                    </div>

                </form>

                <div class="btn-block right">
                    <a class="btn default-btn right-margin" href="{{ route('dashboard.job.info.register') }}">戻る</a>
                    <a class="btn primary-btn right-margin" href="{{ route('dashboard.job.register.confirm') }}">次へ</a>
                </div>
            </div>
        </div>
    </div>
@endsection
