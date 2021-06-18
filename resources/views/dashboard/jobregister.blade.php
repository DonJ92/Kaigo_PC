@extends('layouts.dashboard')

@section('title', trans('job.register.title'))

@section('header')
    <link href="//cdn.syncfusion.com/ej2/ej2-base/styles/material.css" rel="stylesheet">
    <link href="//cdn.syncfusion.com/ej2/ej2-buttons/styles/material.css" rel="stylesheet">
    <link href="//cdn.syncfusion.com/ej2/ej2-calendars/styles/material.css" rel="stylesheet">

    <script src="{{ asset('js/ej2/ej2.min.js') }}" type="text/javascript"></script>
@endsection

@section('content')
    <div class="main full-width no-padding">
        <div class="main no-padding-bottom">
            <h3 class="dashboard-ttl">{{ trans('job.register.title') }}</h3>
        </div>
        <div class="main full-width block-3">
            <div class="main-l main-block main-block-gray">
                <div class="flow">
                    <ul class="flow-ul">
                        <li class="flow-ttl"><a class="active" href="#"><i class="now"></i>{{ trans('job.register.step1') }}</a></li>
                        <li class="flow-ttl"><a href="#"><i></i>{{ trans('job.register.step2') }}</a></li>
                        <li class="flow-ttl"><a href="#"><i></i>{{ trans('job.register.step3') }}</a></li>
                    </ul>
                </div>
            </div>
            <div class="main-m main-block main-block-white">
                <div id="container">
                    <div id="register-element"></div>
                </div>
                <div class="btn-block right">
                    <a class="btn primary-btn right-margin" href="#" onclick="onTimeDialog()">{{ trans('button.next') }}</a>
                </div>
            </div>
        </div>
    </div>

    <div id="dialog-box" class="time-dialog-box">
        <div id="close" class="close-btn"><a><i class="fa fa-close"></i></a></div>
        <form>
            <h2 class="dialog-title">{{ trans('common.login_dialog.title') }}</h2>
            <div class="field-row one-one">
                <input class="form underline" type="time" name="from_time">
            </div>
            <div class="field-row one-one">
                <input class="form underline" type="time" name="to_time">
            </div>
            <a href="{{ route('login') }}" class="btn secondary-btn">{{ trans('button.apply') }}</a>
        </form>
    </div>

    <script>
        $('#side_menu_job_register').addClass('current');
    </script>
    <script src="{{ asset('/js/registerjob.js') }}"></script>
@endsection
