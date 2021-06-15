@extends('layouts.setting')

@section('title', trans('payment.bank_account.title'))

@section('content')
    <div class="main-m main-block main-block-white">
        <div class="main-m-title setting-board border-bottom-light">
        </div>
        <div class="setting-block">
            <h4 class="setting-title">{{ trans('payment.bank_account.title') }}</h4>
            <div class="setting-detail-block">
                <form method="POST" action="{{ route('dashboard.setting.bankaccount.submit') }}">
                    @csrf

                    <div class="field-row">
                        <p class="field-ttl">{{ trans('payment.bank_account.bank') }}</p>
                        <input class="form @error('bank') is-invalid @enderror" type="text" name="bank" placeholder="{{ trans('payment.bank_account.bank_placeholder') }}" value="{{ old('bank') ? old('bank') : $bank }}">
                        @error('bank')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="field-row">
                        <p class="field-ttl">{{ trans('payment.bank_account.branch') }}</p>
                        <input class="form @error('branch') is-invalid @enderror" type="text" name="branch" placeholder="{{ trans('payment.bank_account.branch_placeholder') }}" value="{{ old('branch') ? old('branch') : $branch }}">
                        @error('branch')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="field-row">
                        <p class="field-ttl">{{ trans('payment.bank_account.account_type') }}</p>
                        <input class="form @error('account_type') is-invalid @enderror" type="text" name="account_type" placeholder="{{ trans('payment.bank_account.account_type_placeholder') }}" value="{{ old('account_type') ? old('account_type') : $account_type }}">
                        @error('account_type')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="field-row">
                        <p class="field-ttl">{{ trans('payment.bank_account.account_num') }}</p>
                        <input class="form @error('account_num') is-invalid @enderror" type="text" name="account_num" placeholder="{{ trans('payment.bank_account.account_num_placeholder') }}" value="{{ old('account_num') ? old('account_num') : $account_num }}">
                        @error('account_num')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="div flex">
                        <div class="field-row one-third">
                            <p class="field-ttl">{{ trans('payment.bank_account.last_name') }}</p>
                            <input class="form @error('last_name') is-invalid @enderror" type="text" name="last_name" placeholder="{{ trans('payment.bank_account.last_name_placeholder') }}" value="{{ old('last_name') ? old('last_name') : $last_name }}">
                            @error('last_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="field-row one-third">
                            <p class="field-ttl">{{ trans('payment.bank_account.first_name') }}</p>
                            <input class="form @error('first_name') is-invalid @enderror" type="text" name="first_name" placeholder="{{ trans('payment.bank_account.first_name_placeholder') }}" value="{{ old('first_name') ? old('first_name') : $first_name }}">
                            @error('first_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="btn-block">
                        <a class="btn secondary-btn" href="{{ route('dashboard.setting.creditcard') }}">{{ trans('button.add_credit_card') }}</a>
                        <button type="submit" class="btn primary-btn">{{ trans('button.confirm') }}</button>
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
    </script>
@endsection
