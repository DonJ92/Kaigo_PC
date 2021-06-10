@extends('layouts.login')

@section('title', trans('identification.title'))

@section('body_class', 'profile-register')

@section('content')
    <h2>{{ trans('identification.title') }}</h2>

    <form>
        <div class="confirm-div">
            <h2>{{ trans('identification.confirm_title') }}</h2>
            <img src="{{ asset('images/confirm.svg') }}">
            <p>{{ trans('identification.confirm_desc_pre') }}<br>{{ trans('identification.confirm_desc_sur') }}</p>
        </div>
        <div class="btn-div last">
            <a class="btn btn-next btn-login" href="{{ route('dashboard.home') }}">{{ trans('button.to_mypage') }}</a>
        </div>
    </form>
@endsection
