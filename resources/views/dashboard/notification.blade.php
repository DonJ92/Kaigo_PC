@extends('layouts.setting')

@section('title', trans('notification.title'))

@section('content')
    <div class="main-m main-block main-block-white">
        <div class="main-m-title setting-board border-bottom-light">
        </div>
        <div class="setting-block">
            <h4 class="setting-title">{{ trans('notification.page_title') }}</h4>
            <div class="setting-detail-block">
                <form method="POST" action="{{ route('dashboard.setting.notification.submit') }}">
                    @csrf

                    <div class="notification-div border-bottom">
                        <P>{{ trans('notification.favourite') }}</P>
                        <label class="switch">
                            <input type="checkbox" name="favourite" @if( $favourite == NOTICE_ON ) checked @endif>
                            <span class="switch-slider round"></span>
                        </label>
                    </div>
                    <div class="notification-div border-bottom">
                        <P>{{ trans('notification.matching') }}</P>
                        <label class="switch">
                            <input type="checkbox" name="matching" @if( $matching == NOTICE_ON ) checked @endif>
                            <span class="switch-slider round"></span>
                        </label>
                    </div>
                    <div class="notification-div border-bottom">
                        <P>{{ trans('notification.message') }}</P>
                        <label class="switch">
                            <input type="checkbox" name="message" @if( $message == NOTICE_ON ) checked @endif>
                            <span class="switch-slider round"></span>
                        </label>
                    </div>
                    <div class="notification-div border-bottom">
                        <P>{{ trans('notification.notice') }}</P>
                        <label class="switch">
                            <input type="checkbox" name="notice" @if( $notice == NOTICE_ON ) checked @endif>
                            <span class="switch-slider round"></span>
                        </label>
                    </div>
                    <div class="notification-div">
                        <P>{{ trans('notification.other') }}</P>
                        <label class="switch">
                            <input type="checkbox" name="other" @if( $other == NOTICE_ON ) checked @endif>
                            <span class="switch-slider round"></span>
                        </label>
                    </div>
                    <div class="btn-block right">
                        <button class="btn primary-btn" type="submit">{{ trans('button.confirm') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(window).on('load', function() {
            @if ($errors->has('failed'))
            toastr.error('{{ $errors->first('failed') }}', '', { "closeButton": true });
            @endif

            @if (session()->has('success'))
            toastr.success('{{ session()->get('success') }}', '', { "closeButton": true });
            @endif

            $('#side_menu_setting').addClass('current');
            $('#setting_notification').addClass('active');
        });
    </script>
@endsection
