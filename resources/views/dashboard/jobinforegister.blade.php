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
                        <li class="flow-ttl"><a class="active"><i class="now"></i>{{ trans('job.register.step2') }}</a></li>
                        <li class="flow-ttl"><a ><i></i>{{ trans('job.register.step3') }}</a></li>
                    </ul>
                </div>
            </div>
            <div class="main-m main-block main-block-white">
                <form class="register-job-form" method="POST" action="{{ route('dashboard.job.info.register.submit') }}">
                    @csrf

                    <input type="hidden" name="period" value="{{ old('period') ? old('period') : (isset($period) ? $period : '') }}">
                    <input type="hidden" name="from_time" value="{{ old('from_time') ? old('from_time') : (isset($from_time) ? $from_time : '') }}">
                    <input type="hidden" name="to_time" value="{{ old('to_time') ? old('to_time') : (isset($to_time) ? $to_time : '') }}">

                    <h2 class="sub-title">{{ trans('job.info_title') }}</h2>
                    <div class="field-row">
                        <p class="field-ttl">{{ trans('job.job_title') }}</p>
                        <input class="form @error('title') is-invalid @enderror" type="text" id="title" name="title" value="{{ old('title') }}">
                        @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="field-row">
                        <p class="field-ttl">{{ trans('job.type') }}</p>
                        <select class="form @error('type') is-invalid @enderror" name="type">
                            <option></option>
                            @foreach($job_type_list as $job_type)
                                <option value="{{ $job_type['id'] }}" @if($job_type['id'] == old('type')) selected @endif>{{ $job_type['job_type'] }}</option>
                            @endforeach
                        </select>
                        @error('type')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="field-row">
                        <p class="field-ttl">{{ trans('job.province') }}</p>
                        <select class="form @error('province') is-invalid @enderror" name="province">
                            <option></option>
                            @foreach($province_list as $province_info)
                                <option value="{{ $province_info['id'] }}" @if($province_info['id'] == old('province')) selected @endif>{{ $province_info['name'] }}</option>
                            @endforeach
                        </select>
                        @error('province')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="field-row">
                        <p class="field-ttl">{{ trans('job.cost') }}</p>
                        <input class="form @error('cost') is-invalid @enderror" type="number" name="cost" value="{{ old('cost') }}">
                        @error('cost')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="field-row">
                        <p class="field-ttl">{{ trans('job.certificate') }}</p>
                        <select class="form ui dropdown @error('certificate') is-invalid @enderror" id="certificate" name="certificate[]" multiple>
                            <option></option>
                            @foreach($certificate_list as $certificate_info)
                                <option value="{{ $certificate_info['id'] }}" @if(is_array(old('certificate')) && in_array($certificate_info['id'], old('certificate'))) selected @endif>{{ $certificate_info['certificate'] }}</option>
                            @endforeach
                        </select>
                        @error('certificate')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="field-row">
                        <p class="field-ttl">{{ trans('job.accident') }}</p>
                        <select class="form @error('accident') is-invalid @enderror" id="accident" name="accident">
                            @foreach($accident_list as $accident_info)
                                <option value="{{ $accident_info['id'] }}" @if($accident_info['id'] == old('accident')) selected @endif>{{ $accident_info['type'] }}</option>
                            @endforeach
                        </select>
                        @error('accident')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="field-row">
                        <p class="field-ttl">{{ trans('job.traffic_cost') }}</p>
                        <select class="form @error('traffic_cost') is-invalid @enderror" id="traffic_cost" name="traffic_cost">
                            @foreach($traffic_cost_list as $traffic_cost_info)
                                <option value="{{ $traffic_cost_info['id'] }}" @if($traffic_cost_info['id'] == old('traffic_cost')) selected @endif>{{ $traffic_cost_info['type'] }}</option>
                            @endforeach
                        </select>
                        @error('traffic_cost')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <h2 class="sub-title">{{ trans('job.payment_title') }}</h2>
                    <div class="field-row">
                        <p class="field-ttl">{{ trans('job.payment_method') }}</p>
                        <select class="form @error('payment_method') is-invalid @enderror" id="payment_method" name="payment_method">
                            @foreach($payment_method_list as $payment_method_info)
                                <option value="{{ $payment_method_info['id'] }}" @if($payment_method_info['id'] == old('payment_method')) selected @endif>{{ $payment_method_info['type'] }}</option>
                            @endforeach
                        </select>
                        @error('payment_method')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="field-row">
                        <p class="field-ttl">{{ trans('job.coupon') }}</p>
                        <select class="form @error('coupon') is-invalid @enderror" id="coupon" name="coupon">
                            @foreach($coupon_list as $coupon_info)
                                <option value="{{ $coupon_info['id'] }}" @if($coupon_info['id'] == old('coupon')) selected @endif>{{ $coupon_info['type'] }}</option>
                            @endforeach
                        </select>
                        @error('coupon')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <h2 class="sub-title">{{ trans('job.address_title') }}</h2>
                    <div class="field-row">
                        <p class="field-ttl">{{ trans('job.address') }}</p>
                        <input class="form @error('address') is-invalid @enderror" type="text" name="address" value="{{ old('address') }}">
                        @error('address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <h2 class="sub-title">{{ trans('job.contact_title') }}</h2>
                    <div class="field-row">
                        <p class="field-ttl">{{ trans('job.name') }}</p>
                        <input class="form @error('name') is-invalid @enderror" type="text" name="name" value="{{ old('name') }}">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="field-row">
                        <p class="field-ttl">{{ trans('job.email') }}</p>
                        <input class="form @error('email') is-invalid @enderror" type="text" name="email" value="{{ old('email') }}">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="field-row">
                        <p class="field-ttl">{{ trans('job.phone') }}</p>
                        <input class="form @error('phone') is-invalid @enderror" type="text" id="phone" name="phone" value="{{ old('phone') }}">
                        @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="field-row">
                        <p class="field-ttl">{{ trans('job.comment') }}</p>
                        <textarea class="form form-textarea @error('comment') is-invalid @enderror" name="comment">{{ old('comment') }}</textarea>
                        @error('comment')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="btn-block right">
                        <a class="btn default-btn right-margin" href="{{ route('dashboard.job.register') }}">{{ trans('button.back') }}</a>
                        <button type="submit" class="btn primary-btn right-margin cursor-pointer">{{ trans('button.next') }}</button>
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

            $('#side_menu_job_register').addClass('current');
        });

        $('#certificate').dropdown();
        $('#phone').mask('000-0000-0000');
    </script>
@endsection
