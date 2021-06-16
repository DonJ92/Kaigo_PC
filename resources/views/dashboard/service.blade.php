@extends('layouts.setting')

@section('title', trans('service.title'))

@section('content')
    <div class="main-m main-block main-block-white">
        <div class="main-m-title setting-board border-bottom-light">
        </div>
        <div class="setting-block">
            <h4 class="setting-title">{{ trans('service.page_title') }}</h4>
            <div class="setting-detail-block">
                <form method="POST" action="{{ route('dashboard.setting.exit') }}">
                    @csrf

                    <div class="div col-2-1 margin-center">
                        <div class="service-div">
                            <p>{{ trans('service.desc') }}</p>
                        </div>
                        <div class="service-div">
                            <h3 class="title">{{ trans('service.warning_title') }}&nbsp;&nbsp;<span class="status primary-bg service-status">{{ trans('common.required') }}</span></h3>
                            <hr class="title-bottom-line">
                            <p>{{ trans('service.warning_desc') }}。</p>
                            <div class="checkbox-div"><input class="checkbox" type="checkbox" id="warning1" required><label for="warning1">{{ trans('service.warning1') }}</label></div>
                            <div class="checkbox-div"><input class="checkbox" type="checkbox" id="warning2" required><label for="warning2">{{ trans('service.warning2') }}</label></div>
                            <div class="checkbox-div"><input class="checkbox" type="checkbox" id="warning3" required><label for="warning3">{{ trans('service.warning3') }}</label></div>
                            <div class="checkbox-div"><input class="checkbox" type="checkbox" id="warning4" required><label for="warning4">{{ trans('service.warning4') }}</label></div>
                            <div class="checkbox-div"><input class="checkbox" type="checkbox" id="warning5" required><label for="warning5">{{ trans('service.warning5') }}</label></div>
                            <p class="light-pink">{{ trans('service.deposit_desc') }}</p>
                            <div class="deposit-amount-div div margin-center">
                                <span>{{ trans('service.deposit_title') }}</span>&nbsp;&nbsp;&nbsp;<h2>{{ trans('service.deposit_amount') }}</h2>
                            </div>
                        </div>
                        <div class="service-div">
                            <h3 class="title">{{ trans('service.exit_cause_title') }}&nbsp;&nbsp;<span class="status primary-bg service-status">{{ trans('common.required') }}</span></h3>
                            <hr class="title-bottom-line">
                            <p>{{ trans('service.exit_cause_desc') }}</p>
                            @foreach($exit_cause_list as $exit_cause_info)
                            <div class="checkbox-div"><input class="checkbox" type="checkbox" id="cuase{{ $exit_cause_info['id'] }}" name="cause[]" value="{{ $exit_cause_info['id'] }}" @if(is_array(old('cause')) && in_array($exit_cause_info['id'], old('cause'))) checked @endif><label for="cuase{{ $exit_cause_info['id'] }}">{{ $exit_cause_info['desc'] }}</label></div>
                            @endforeach
                            @error('cause')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="service-div">
                            <h3 class="title">{{ trans('service.opinion_title') }}&nbsp;&nbsp;<span class="status secondary-bg service-status">{{ trans('common.random') }}</span></h3>
                            <hr class="title-bottom-line">
                            <p>{{ trans('service.opinion_desc') }}</p>
                            <div class="field-row one-one">
                                <textarea class="form form-textarea @error('opinion') is-invalid @enderror" name="opinion">{{ old('opinion') }}</textarea>
                                @error('opinion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="service-div div center">
                            <h1>{{ trans('service.exit_confirm') }}</h1>
                            <button type="submit" class="btn default-btn service-btn cursor-pointer">{{ trans('button.exit') }}</button>
                            <button class="btn default-btn service-btn cursor-pointer">{{ trans('button.cancel') }}</button>
                        </div>
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
            $('#setting_service').addClass('active');
        });
    </script>
@endsection
