@extends('layouts.dashboard')

@section('title', trans('identification.title'))

@section('content')
    <div class="main">
        <form>
            <div class="confirm-div">
                <h2>{{ trans('identification.confirm_title') }}</h2>
                <img src="{{ asset('/images/confirm.svg') }}">
                <p>{{ trans('identification.confirm_desc_pre') }}<br>{{ trans('identification.confirm_desc_sur') }}</p>
            </div>
            <div class="btn-block right">
                <a class="btn primary-btn right-margin" href="{{ route('dashboard.home') }}">{{ trans('button.to_mypage') }}</a>
            </div>
        </form>
    </div>

    <script>
        $(window).on('load', function() {
            @if ($errors->has('failed'))
            toastr.error('{{ $errors->first('failed') }}', '', { "closeButton": true });
            @endif

            @if (session()->has('success'))
            toastr.success('{{ session()->get('success') }}', '', { "closeButton": true });
            @endif

            $('#side_menu_identification').addClass('current');
        });
    </script>
@endsection
