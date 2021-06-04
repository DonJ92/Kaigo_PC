@extends('layouts.login')

@section('title', trans('login.title'))

@section('body_class', 'login')

@section('content')
<h2>{{ trans('login.title') }}</h2>

<form method="POST" action="{{ route('login') }}">
    @csrf

    <div class="field-row field-merge">
        <p class="field-ttl">{{ trans('login.phone_desc') }}</p>
        <input class="form @error('phone') is-invalid @enderror" type="text" id="phone" name="phone" value="{{ old('phone') }}" placeholder="{{ trans('login.phone_placeholder') }}"/>
        @error('phone')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="field-row">
        <p class="field-ttl">{{ trans('login.password_desc') }}</p>
        <input class="form @error('password') is-invalid @enderror" type="password" id="password" name="password" placeholder="{{ trans('login.pwd_placeholder') }}"/>
        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="field-row">
        <p class="field-ttl">{{ trans('login.forgot_pwd') }}<a href="#">{{ trans('common.here') }}</a></p>
    </div>
    <div class="btn-div last">
        <button type="submit" class="btn btn-next">{{ trans('button.login') }}</button>
    </div>
</form>
@endsection
