@extends('layouts.dashboard')

@section('content')
    <div class="main">
        <form>
            <div class="confirm-div">
                <h2>本人確認書類提出完了</h2>
                <img src="{{ asset('/images/confirm.svg') }}">
                <p>審査が完了するまで<br>もうしばらくお待ちください</p>
            </div>
            <div class="btn-block right">
                <a class="btn primary-btn right-margin" href="{{ route('dashboard.home') }}">マイページへ</a>
            </div>
        </form>
    </div>
@endsection