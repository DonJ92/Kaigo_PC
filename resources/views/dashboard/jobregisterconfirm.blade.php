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
                        <li class="flow-ttl"><a class="active"><i class="after"></i>最終確認</a></li>
                    </ul>
                </div>
            </div>
            <div class="main-m main-block main-block-white">
                <form>
                    <div class="confirm-div">
                        <h2>応募申し込み完了</h2>
                        <img src="{{asset('/images/confirm.svg')}}">
                    </div>
                    <div class="btn-block right">
                        <a class="btn primary-btn right-margin" href="{{ route('dashboard.job.register') }}">定期予約一覧へ戻る</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
