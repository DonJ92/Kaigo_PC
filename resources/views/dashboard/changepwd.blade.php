@extends('layouts.setting')

@section('title', trans('changepwd.title'))

@section('content')
    <div class="main-m main-block main-block-white">
        <div class="main-m-title setting-board border-bottom-light">
        </div>
        <div class="setting-block">
            <h4 class="setting-title">{{ trans('changepwd.title') }}</h4>
            <div class="setting-detail-block">
                <form method="POST" action="{{ route('dashboard.setting.changepwd.submit') }}">
                    @csrf

                    <div class="field-row">
                        <p class="field-ttl">{{ trans('changepwd.current_password') }}</p>
                        <input class="form @error('current_password') is-invalid @enderror" type="password" name="current_password" placeholder="{{ trans('changepwd.password_placeholder') }}" value="{{ old('current_password') }}">
                        @error('current_password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="field-row">
                        <p class="field-ttl">{{ trans('changepwd.password') }}</p>
                        <input class="form @error('password') is-invalid @enderror" type="password" name="password" placeholder="{{ trans('changepwd.password_placeholder') }}"  value="{{ old('password') }}">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="field-row">
                        <p class="field-ttl">{{ trans('changepwd.password_confirmation') }}</p>
                        <input class="form" type="password" name="password_confirmation" placeholder="{{ trans('changepwd.password_placeholder') }}">
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
            $('#setting_changepwd').addClass('active');
        });
    </script>
@endsection
