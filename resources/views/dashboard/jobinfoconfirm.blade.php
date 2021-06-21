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
                        <li class="flow-ttl"><a class="active"><i class="now"></i>{{ trans('job.register.step3') }}</a></li>
                    </ul>
                </div>
            </div>
            <div class="main-m main-block main-block-white">
                <form method="POST" action="{{ route('dashboard.job.info.confirm.submit') }}">
                    @csrf

                    <div class="register-job-form confirm" >
                        <h2 class="sub-title border-bottom">{{ trans('job.register.time_title') }}</h2>
                        <div class="row-item register-job-list flex border-bottom">
                            <p class="title">{{ trans('job.job_title') }}</p>
                            <p class="info">{{ $title }}</p>
                            <input type="hidden" value="{{ $title }}" name="title">
                        </div>
                        <div class="row-item register-job-list flex border-bottom">
                            <p class="title">{{ trans('job.date') }}</p>
                            <p class="info">{{ $period_info }}</p>
                            <input type="hidden" value="{{ $period }}" name="period">
                        </div>
                        <div class="row-item register-job-list flex border-bottom">
                            <p class="title">{{ trans('job.timezone') }}</p>
                            <p class="info">{{ $from_time . '-' . $to_time }}</p>
                            <input type="hidden" value="{{ $from_time }}" name="from_time">
                            <input type="hidden" value="{{ $to_time }}" name="to_time">
                        </div>

                        <h2 class="sub-title border-bottom">{{ trans('job.info_title') }}</h2>
                        <div class="row-item register-job-list flex border-bottom">
                            <p class="title">{{ trans('job.type') }}</p>
                            <p class="info">{{ $type_name }}</p>
                            <input type="hidden" value="{{ $type }}" name="type">
                        </div>
                        <div class="row-item register-job-list flex border-bottom">
                            <p class="title">{{ trans('job.province') }}</p>
                            <p class="info">{{ $province_name }}</p>
                            <input type="hidden" value="{{ $province }}" name="province">
                        </div>
                        <div class="row-item register-job-list flex border-bottom">
                            <p class="title">{{ trans('job.cost') }}</p>
                            <p class="info">{{ $cost }}</p>
                            <input type="hidden" value="{{ $cost }}" name="cost">
                        </div>
                        <div class="row-item register-job-list flex border-bottom">
                            <p class="title">{{ trans('job.certificate') }}</p>
                            <p class="info">{{ implode(',', $certificate_name) }}</p>
                            <input type="hidden" value="{{ implode(',', $certificate) }}" name="certificate">
                        </div>
                        <div class="row-item register-job-list flex border-bottom">
                            <p class="title">{{ trans('job.accident') }}</p>
                            <p class="info">{{ $accident_type }}</p>
                            <input type="hidden" value="{{ $accident }}" name="accident">
                        </div>
                        <div class="row-item register-job-list flex border-bottom">
                            <p class="title">{{ trans('job.traffic_cost') }}</p>
                            <p class="info">{{ $traffic_cost_type }}</p>
                            <input type="hidden" value="{{ $traffic_cost }}" name="traffic_cost">
                        </div>

                        <h2 class="sub-title border-bottom">{{ trans('job.payment_title') }}</h2>
                        <div class="row-item register-job-list flex border-bottom">
                            <p class="title">{{ trans('job.payment_method') }}</p>
                            <p class="info">{{ $payment_method_type }}</p>
                            <input type="hidden" value="{{ $payment_method }}" name="payment_method">
                        </div>
                        <div class="row-item register-job-list flex border-bottom">
                            <p class="title">{{ trans('job.coupon') }}</p>
                            <p class="info">{{ $coupon_type }}</p>
                            <input type="hidden" value="{{ $coupon }}" name="coupon">
                        </div>

                        <h2 class="sub-title">{{ trans('job.address_title') }}</h2>
                        <div class="row-item register-job-list flex border-bottom">
                            <p class="title">{{ trans('job.address') }}</p>
                            <p class="info">{{ $address }}</p>
                            <input type="hidden" value="{{ $address }}" name="address">
                        </div>

                        <h2 class="sub-title">{{ trans('job.contact_title') }}</h2>
                        <div class="row-item register-job-list flex border-bottom">
                            <p class="title">{{ trans('job.name') }}</p>
                            <p class="info">{{ $name }}</p>
                            <input type="hidden" value="{{ $name }}" name="name">
                        </div>
                        <div class="row-item register-job-list flex border-bottom">
                            <p class="title">{{ trans('job.email') }}</p>
                            <p class="info">{{ $email }}</p>
                            <input type="hidden" value="{{ $email }}" name="email">
                        </div>
                        <div class="row-item register-job-list flex border-bottom">
                            <p class="title">{{ trans('job.phone') }}</p>
                            <p class="info">{{ $phone }}</p>
                            <input type="hidden" value="{{ $phone }}" name="phone">
                        </div>

                        <div class="row-item register-job-list flex border-bottom">
                            <p class="title">{{ trans('job.comment') }}</p>
                            <p class="info">{{ $comment }}</p>
                            <input type="hidden" value="{{ $comment }}" name="comment">
                        </div>
                    </div>

                    <div class="btn-block right">
                        <a class="btn default-btn right-margin" href="{{ route('dashboard.job.info.register') }}">{{ trans('button.back') }}</a>
                        <button type="submit" class="btn primary-btn right-margin">{{ trans('button.next') }}</button>
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
