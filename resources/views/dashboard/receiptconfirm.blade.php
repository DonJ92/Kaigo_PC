@extends('layouts.dashboard')

@section('content')
    <div class="main">
        <form>
            <div class="confirm-div">
                <h2>送信完了</h2>
                <img src="{{ asset('/images/confirm.svg') }}">
            </div>
            <div class="btn-block right">
                <a class="btn primary-btn right-margin" href="{{ route('dashboard.home') }}">マイページへ</a>
            </div>
        </form>
    </div>
@endsection
