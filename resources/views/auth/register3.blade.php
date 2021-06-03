@extends('layouts.register')

@section('content')
    <h2>{{ trans('register.title') }}</h2>

    <form method="POST" action="{{ route('register.confirm') }}">
        @csrf

        <input type="hidden" id="last_name" name="last_name" value="{{ old('last_name') ? old('last_name') : (isset($last_name) ? $last_name : '') }}"/>
        <input type="hidden" id="first_name" name="first_name" value="{{ old('first_name') ? old('first_name') : (isset($first_name) ? $first_name : '') }}"/>
        <input type="hidden" id="gender" name="gender" value="{{ old('gender') ? old('gender') : (isset($gender) ? $gender : '') }}"/>
        <input type="hidden" id="province" name="province" value="{{ old('province') ? old('province') : (isset($province) ? $province : '') }}"/>
        <input type="hidden" id="address" name="address" value="{{ old('address') ? old('address') : (isset($address) ? $address : '') }}"/>
        <input type="hidden" id="phone" name="phone" value="{{ old('phone') ? old('phone') : (isset($phone) ? $phone : '') }}"/>
        <input type="hidden" id="password" name="password" value="{{ old('password') ? old('password') : (isset($password) ? $password : '') }}"/>

        <div class="field-row field-block">
            <p class="field-ttl">{{ trans('register.sms_desc') }}</p>
            <input class="form @error('sms_code') is-invalid @enderror" type="text" id="sms_code" name="sms_code" placeholder=""/>
            @error('sms_code')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="btn-div">
            <a class="btn btn-back" href="{{ url()->previous() }}">{{ trans('button.back') }}</a>
            <button type="submit" class="btn btn-next">{{ trans('button.next') }}</button>
        </div>
    </form>
@endsection