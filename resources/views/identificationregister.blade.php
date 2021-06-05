@extends('layouts.login')

@section('title', trans('identification.title'))

@section('body_class', 'profile-register')

@section('content')
    <h2>{{ trans('identification.title') }}</h2>

    <form method="POST" action="{{ route('identification.register.submit') }}">
        <div class="identyfy-div">
            <h3>{{ trans('identification.sub_title') }}</h3>
                <p class="identify-desc">{{ trans('identification.identification_desc') }}</p>
                <img class="identify-photo" src="{{ asset('/images/identify-confirm.svg') }}">
                <div class="identify-warning">
                    <h3>{{ trans('identification.warning') }}</h3>
                    <p>{{ trans('identification.warning_desc') }}</p>
                </div>
                <div class="identify-failure-div">
                    <div>
                        <img src="{{ asset('/images/identify-failure1.svg') }}">
                        <p>{{ trans('identification.warning1_pre') }}<br>{{ trans('identification.warning1_sur') }}</p>
                    </div>
                    <div>
                        <img src="{{ asset('/images/identify-failure2.svg') }}">
                        <p>{{ trans('identification.warning2_pre') }}<br>{{ trans('identification.warning2_sur') }}</p>
                    </div>
                    <div>
                        <img src="{{ asset('/images/identify-failure3.svg') }}">
                        <p>{{ trans('identification.warning3_pre') }}<br>{{ trans('identification.warning3_sur') }}</p>
                    </div>
                </div>
                <div class="identify-upload-div">
                    <img src="{{ asset('/images/identify-upload.svg') }}">
                </div>
                <ul class="content-font">
                    <li>{{ trans('identification.warning1') }}</li>
                    <li>{{ trans('identification.warning2') }}</li>
                    <li>{{ trans('identification.warning3') }}</li>
                </ul>
                <h3 class="center">{{ trans('identification.age_desc') }}</h3>
                <h2 class="confirm-h2">{{ $age }}</h2>
                <p class="content-font center light-pink">{{ trans('identification.birthday_desc') }}</p>
                <div class="field-row center">
                    <p class="field-ttl">{{ trans('identification.birthday_label') }}</p>
                    <input type="date" class="form">
                </div>
                <img class="japhic" src="{{ asset('/images/Japhic.svg') }}">
                <p class="content-font">{{ trans('identification.japhic') }}</p>
        </div>
        <div class="btn-div last">
            <button type="submit" class="btn btn-next">{{ trans('button.next') }}</button>
        </div>

    </form>

    <script>
        $(window).on('load', function() {
            @if (session()->has('success'))
            toastr.success('{{ session()->get('success') }}', '', { "closeButton": true });
            @endif
        });
    </script>
@endsection
