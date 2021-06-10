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
                        <li class="flow-ttl"><a class="active"><i class="now"></i>応募詳細を入力してください</a></li>
                        <li class="flow-ttl"><a ><i></i>最終確認</a></li>
                    </ul>
                </div>
            </div>
            <div class="main-m main-block main-block-white">
                <form class="register-job-form">
                    <h2 class="sub-title">希望</h2>
                    <div class="field-row">
                        <p class="field-ttl">ご利⽤⽬的</p>
                        <select class="form">
                            <option value="" selected="">介護</option>
                        </select>
                    </div>
                    <div class="field-row">
                        <p class="field-ttl">地域</p>
                        <select class="form">
                            <option value="" selected="">東京都 ⾜⽴区</option>
                        </select>
                    </div>
                    <div class="field-row">
                        <p class="field-ttl">報酬</p>
                        <select class="form">
                            <option value="" selected="">¥5,000</option>
                        </select>
                    </div>
                    <div class="field-row">
                        <p class="field-ttl">保有資格</p>
                        <select class="form">
                            <option value="" selected="">〇〇２級資格,〇〇２級資格</option>
                        </select>
                    </div>
                    <div class="field-row">
                        <p class="field-ttl">労災</p>
                        <select class="form">
                            <option value="" selected="">加⼊してる</option>
                        </select>
                    </div>
                    <div class="field-row">
                        <p class="field-ttl">交通費</p>
                        <select class="form">
                            <option value="" selected="">支給あり</option>
                        </select>
                    </div>

                    <h2 class="sub-title">支払い</h2>
                    <div class="field-row">
                        <p class="field-ttl">支払い方法</p>
                        <select class="form">
                            <option value="" selected="">クレジットカード（下4桁：1048）</option>
                        </select>
                    </div>
                    <div class="field-row">
                        <p class="field-ttl">クーポン</p>
                        <select class="form">
                            <option value="" selected="">なし</option>
                        </select>
                    </div>

                    <h2 class="sub-title">住所</h2>
                    <div class="field-row">
                        <p class="field-ttl">対象住所</p>
                        <select class="form">
                            <option value="" selected="">東京都⾜⽴区〇〇〇〇〇〇〇〇</option>
                        </select>
                    </div>

                    <h2 class="sub-title">ご連絡先</h2>
                    <div class="field-row">
                        <p class="field-ttl">お名前</p>
                        <input class="form" type="text" placeholder="山田花子">
                    </div>
                    <div class="field-row">
                        <p class="field-ttl">メールアドレス</p>
                        <input class="form" type="text" placeholder="example@email.com">
                    </div>
                    <div class="field-row">
                        <p class="field-ttl">電話番号</p>
                        <input class="form" type="text" placeholder="000-0000-0000">
                    </div>
                    <div class="field-row">
                        <p class="field-ttl">その他</p>
                        <textarea class="form form-textarea">必須事項など</textarea>
                    </div>

                    <div class="btn-block right">
                        <a class="btn default-btn right-margin" href="{{ route('dashboard.job.register') }}">戻る</a>
                        <a class="btn primary-btn right-margin" href="{{ route('dashboard.job.info.confirm') }}">次へ</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
