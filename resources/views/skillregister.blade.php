@extends('layouts.login')

@section('title', trans('identification.title'))

@section('body_class', 'profile-register')

@section('content')
    <h2>資格・スキル申請</h2>

    <form>
        <div class="identyfy-div">
            <h3>{{ trans('identification.sub_title') }}</h3>
                <p class="identify-desc">{{ trans('identification.skill_desc') }}</p>
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
                </ul>
                <h3 class="center">{{ trans('identification.certificate_desc') }}</h3>
                <h2 class="confirm-h2">{{ $certificate }}</h2>
                <p class="content-font center light-pink">{{ trans('identification.skill_desc') }}</p>
                <div class="field-row center">
                    <p class="field-ttl">{{ trans('identification.certificate') }}</p>
                    <select class="form">
                        @foreach( $certificate_list as $certificate_info)
                            <option value="{{ $certificate_info['id'] }}" @if($certificate_id== $certificate_info['id']) selected @endif>{{ $certificate_info['certificate'] }}</option>
                        @endforeach
                    </select>
                </div>
                <img class="japhic" src="{{ asset('/images/Japhic.svg') }}">
                <p class="content-font">{{ trans('identification.japhic') }}</p>
        </div>
        <div class="btn-div last">
            <a class="btn btn-next" href="identification3.html">次へ</a>
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
