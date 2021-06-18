@extends('layouts.register')

@section('content')
    <h2>{{ trans('register.title') }}</h2>

    <form method="POST" action="{{ route('register.sms') }}">
        @csrf

        <input type="hidden" id="last_name" name="last_name" value="{{ old('last_name') ? old('last_name') : (isset($last_name) ? $last_name : '') }}"/>
        <input type="hidden" id="first_name" name="first_name" value="{{ old('first_name') ? old('first_name') : (isset($first_name) ? $first_name : '') }}"/>
        <input type="hidden" id="gender" name="gender" value="{{ old('gender') ? old('gender') : (isset($gender) ? $gender : '') }}"/>
        <input type="hidden" id="province" name="province" value="{{ old('province') ? old('province') : (isset($province) ? $province : '') }}"/>
        <input type="hidden" id="address" name="address" value="{{ old('address') ? old('address') : (isset($address) ? $address : '') }}"/>

        <div class="field-row field-merge">
            <p class="field-ttl">{{ trans('register.phone') }}</p>
            <input class="form @error('phone') is-invalid @enderror" type="text" id="phone" name="phone" value="{{ old('phone') }}" placeholder="{{ trans('register.phone_placeholder') }}" pattern="[0-9]{3}-[0-9]{4}-[0-9]{4}"/>
            @error('phone')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="field-row field-block">
            <p class="field-ttl">{{ trans('register.password') }}</p>
            <input class="form @error('password') is-invalid @enderror" type="password" id="password" name="password" value="{{ old('password') }}" placeholder="{{ trans('register.pwd_placeholder') }}"/>
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="field-row field-block">
            <p class="field-ttl">{{ trans('register.password_confirmation') }}</p>
            <input class="form" type="password" id="password_confirmation" name="password_confirmation" placeholder="{{ trans('register.pwd_cfm_placeholder') }}"/>
        </div>
        <div class="btn-div">
            <a class="btn btn-back" href="{{ url()->previous() }}">{{ trans('button.back') }}</a>
            <button type="submit" class="btn btn-next">{{ trans('button.next') }}</button>
        </div>
    </form>

    <script>
        $(document).ready(function(){
            $('#phone').mask('000-0000-0000');
        });
    </script>
@endsection