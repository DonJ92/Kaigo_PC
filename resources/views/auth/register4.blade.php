@extends('layouts.register')

@section('content')
    <h2>{{ trans('register.title') }}</h2>

    <form method="POST" action="{{ route('register.confirm') }}">
        @csrf

        <div class="confirm-div">
            <h2>{{ trans('register.register_finish') }}</h2>
            <img src="{{ asset('images/confirm.svg') }}">
        </div>
        <div class="btn-div last">
            <a class="btn btn-next btn-login" href="login.html">{{ trans('register.to_login') }}</a>
        </div>
    </form>
@endsection