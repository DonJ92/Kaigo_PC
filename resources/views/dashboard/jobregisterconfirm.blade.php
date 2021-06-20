@extends('layouts.dashboard')

@section('title', trans('job.register.title'))

@section('content')
    <div class="main full-width no-padding">
        <div class="main no-padding-bottom">
            <h3 class="dashboard-ttl">{{ trans('job.register.title') }}</h3>
        </div>
        <div class="main full-width block-3">
            <div class="main-l main-block main-block-gray">
                <div class="flow">
                    <ul class="flow-ul">
                        <li class="flow-ttl"><a class="active"><i class="after"></i>{{ trans('job.register.step1') }}</a></li>
                        <li class="flow-ttl"><a class="active"><i class="after"></i>{{ trans('job.register.step2') }}</a></li>
                        <li class="flow-ttl"><a class="active"><i class="after"></i>{{ trans('job.register.step3') }}</a></li>
                    </ul>
                </div>
            </div>
            <div class="main-m main-block main-block-white">
                <form>
                    <div class="confirm-div">
                        <h2>{{ trans('job.register.registered') }}</h2>
                        <img src="{{asset('/images/confirm.svg')}}">
                    </div>
                    <div class="btn-block right">
                        <a class="btn primary-btn right-margin" href="{{ route('dashboard.job.register') }}">{{ trans('button.to_job_register') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(window).on('load', function() {
            $('#side_menu_job_register').addClass('current');
        });
    </script>
@endsection
