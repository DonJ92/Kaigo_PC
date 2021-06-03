@extends('layouts.register')

@section('content')
    <h2>{{ trans('register.title') }}</h2>

    <form method="POST" action="{{ route('register.info') }}">
        @csrf

        <div class="field-row field-block">
            <p class="field-ttl">{{ trans('register.last_name') }}</p>
            <input class="form @error('last_name') is-invalid @enderror" type="text" id="last_name" name="last_name" value="{{ old('last_name') }}" placeholder="氏名"/>
            @error('last_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="field-row field-block">
            <p class="field-ttl">{{ trans('register.first_name') }}</p>
            <input class="form @error('last_name') is-invalid @enderror" type="text" id="first_name" name="first_name" value="{{ old('first_name') }}" placeholder="名前"/>
            @error('first_name')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="field-row">
            <p class="field-ttl">{{ trans('register.gender') }}</p>
            <select class="form @error('gender') is-invalid @enderror" id="gender" name="gender">
                @foreach($gender_list as $gender_info)
                    <option value="{{ $gender_info['id'] }}" @if( old('gender') == $gender_info['id']) selected @endif>{{ $gender_info['name'] }}</option>
                @endforeach
            </select>
            @error('gender')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="field-row">
            <p class="field-ttl">{{ trans('register.province') }}</p>
            <select class="form @error('province') is-invalid @enderror" id="province" name="province">
                <option></option>
                @foreach($province_list as $province_info)
                    <option value="{{ $province_info['id'] }}" @if( old('province') == $province_info['id']) selected @endif>{{ $province_info['name'] }}</option>
                @endforeach
            </select>
            @error('province')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="field-row field-merge">
            <p class="field-ttl">{{ trans('register.address') }}</p>
            <input class="form @error('address') is-invalid @enderror" type="text" id="address" name="address" value="{{ old('address') }}" placeholder="{{ trans('register.address') }}"/>
            @error('address')
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
