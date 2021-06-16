@extends('layouts.setting')

@section('title', trans('payment.credit_card.title'))

@section('content')
    <div class="main-m main-block main-block-white">
        <div class="main-m-title setting-board border-bottom-light">
        </div>
        <div class="setting-block">
            <h4 class="setting-title">{{ trans('payment.credit_card.title') }}</h4>
            <div class="setting-detail-block">
                <form method="POST" action="{{ route('dashboard.setting.creditcard.submit') }}">
                    @csrf

                    <img class="credit-card-img" src="{{ asset('/images/credit-card.svg') }}">
                    <div class="field-row">
                        <p class="field-ttl">{{ trans('payment.credit_card.card_num') }}</p>
                        <input class="form @error('card_num') is-invalid @enderror" type="text" id="card_num" name="card_num" placeholder="0000 0000 0000 0000" value="{{ old('card_num') ? old('card_num') : $card_num }}">
                        @error('card_num')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="div flex">
                        <div class="field-row one-third">
                            <p class="field-ttl">{{ trans('payment.credit_card.expired_date') }}</p>
                            <select class="form @error('expired_month') is-invalid @enderror" name="expired_month">
                                <option></option>
                                @foreach($month_list as $month_info)
                                    <option value="{{ $month_info['id'] }}" @if((old('expired_month') ? old('expired_month') : $expired_month) == $month_info['id']) selected @endif>{{ $month_info['name'] }}</option>
                                @endforeach
                            </select>
                            @error('expired_month')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="field-row one-third">
                            <p class="field-ttl">&nbsp;</p>
                            <select class="form @error('expired_year') is-invalid @enderror" name="expired_year">
                                <option></option>
                                @foreach($year_list as $year_info)
                                    <option value="{{ $year_info['id'] }}" @if((old('expired_year') ? old('expired_year') : $expired_year) == $year_info['id']) selected @endif>{{ $year_info['name'] }}</option>
                                @endforeach
                            </select>
                            @error('expired_year')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="field-row">
                        <p class="field-ttl one-third">{{ trans('payment.credit_card.security_code') }}</p>
                        <input class="form @error('security_code') is-invalid @enderror" type="text" name="security_code" placeholder="000" value="{{ old('security_code') ? old('security_code') : $security_code }}">
                        @error('security_code')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
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
            $('#setting_bank_account').addClass('active');
        });

        document.getElementById('card_num').addEventListener('input', function (e) {
            e.target.value = e.target.value.replace(/[^\dA-Z]/g, '').replace(/(.{4})/g, '$1 ').trim();
        });
    </script>
@endsection
