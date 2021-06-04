@extends('layouts.login')

@section('title', trans('profile.title'))

@section('body_class', 'profile-register')

@section('content')
    <h2>{{ trans('profile.title') }}</h2>

    <form method="POST" action="{{ route('profile.select.submit') }}">
        @csrf

        <input type="hidden" id="type" name="type" value="{{ CLIENT }}">
        <div class="field-row">
            <p class="field-ttl">{{ trans('profile.select_desc') }}</p>
        </div>
        <div class="select-div">
            <a class="select-btn auth-btn active" id="sel_client">{{ trans('profile.client') }}</a>
            <a class="select-btn req-btn" id="sel_helper">{{ trans('profile.helper') }}</a>
        </div>
        <div class="btn-div last">
            <button type="submit" class="btn btn-next">{{ trans('button.next') }}</button>
        </div>
    </form>

    <script src="{{ asset('/js/profile/select.js') }}"></script>
@endsection
