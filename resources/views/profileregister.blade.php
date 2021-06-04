@extends('layouts.login')

@section('title', trans('profile.title'))

@section('body_class', 'profile-register')

@section('content')
    <script>
        $(window).on('load', function() {
            @if ($errors->has('failed'))
            toastr.error('{{ $errors->first('failed') }}', '', { "closeButton": true });
            @endif
        });
    </script>

    <h2>{{ trans('profile.title') }}</h2>

    <form method="POST" action="{{ route('profile.register.submit') }}">
        @csrf

        <div class="field-row">
            <p class="field-ttl">{{ trans('profile.input_desc') }}</p>
        </div>
        <div class="photo-div">
            <img class="main-photo" src="{{ asset('/images/photo-upload.svg') }}">
            <img class="sub-photo" src="{{ asset('/images/photo-upload.svg') }}">
            <img class="sub-photo" src="{{ asset('/images/photo-upload.svg') }}">
            <img class="sub-photo" src="{{ asset('/images/photo-upload.svg') }}">
            <img class="sub-photo" src="{{ asset('/images/photo-upload.svg') }}">
        </div>
        <div class="field-row field-merge">
            <p class="field-ttl">{{ trans('profile.introduction') }}</p>
            <textarea class="form form-textarea" id="introduction" name="introduction" placeholder="{{ trans('profile.introduction_placeholder') }}">{{ old('introduction') }}</textarea>
        </div>
        <div class="field-row">
            <p class="field-ttl">{{ trans('profile.age') }}</p>
            <select class="form @error('age') is-invalid @enderror" id="age" name="age">
                <option></option>
                @foreach ($age_list as $age_info)
                    <option value="{{ $age_info['id'] }}" @if(old('age') == $age_info['id']) selected @endif>{{ $age_info['name'] }}</option>
                @endforeach
            </select>
            @error('age')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="field-row">
            <p class="field-ttl">{{ trans('profile.user_type') }}</p>
            <select disabled class="form @error('type') is-invalid @enderror" id="type" name="type">
                @foreach ($type_list as $type_info)
                    <option value="{{ $type_info['id'] }}" @if ($type_info['id'] == auth()->user()->type) selected @endif>{{ $type_info['name'] }}</option>
                @endforeach
            </select>
            @error('type')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        @if(auth()->user()->type == HELPER)
        <div class="field-row">
            <p class="field-ttl">{{ trans('profile.experience_years') }}</p>
            <select class="form @error('experience_years') is-invalid @enderror" id="experience_years" name="experience_years">
                <option></option>
                @foreach ($experience_list as $experience_info)
                    <option value="{{ $experience_info['id'] }}" @if(old('experience_years') == $experience_info['id']) selected @endif>{{ $experience_info['name'] }}</option>
                @endforeach
            </select>
            @error('experience_years')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="field-row">
            <p class="field-ttl">{{ trans('profile.certificate') }}</p>
            <select class="form @error('certificate') is-invalid @enderror" id="certificate" name="certificate">
                <option></option>
                @foreach ($certificate_list as $certificate_info)
                    <option value="{{ $certificate_info['id'] }}" @if(old('certificate') == $certificate_info['id']) selected @endif>{{ $certificate_info['certificate'] }}</option>
                @endforeach
            </select>
            @error('certificate')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="field-row">
            <p class="field-ttl">{{ trans('profile.hourly_cost') }}</p>
            <select class="form @error('hourly_cost') is-invalid @enderror" id="hourly_cost" name="hourly_cost">
                <option></option>
                <option value="1" @if(old('hourly_cost') == 1) selected @endif>1,000円</option>
                <option value="2" @if(old('hourly_cost') == 2) selected @endif>2,000円</option>
                <option value="3" @if(old('hourly_cost') == 3) selected @endif>3,000円</option>
                <option value="4" @if(old('hourly_cost') == 4) selected @endif>4,000円</option>
                <option value="5" @if(old('hourly_cost') == 5) selected @endif>5,000円</option>
                <option value="6" @if(old('hourly_cost') == 6) selected @endif>6,000円</option>
                <option value="7" @if(old('hourly_cost') == 7) selected @endif>7,000円</option>
                <option value="8" @if(old('hourly_cost') == 8) selected @endif>8,000円</option>
                <option value="9" @if(old('hourly_cost') == 9) selected @endif>9,000円</option>
                <option value="10" @if(old('hourly_cost') == 10) selected @endif>10,000円</option>
            </select>
            @error('hourly_cost')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        @endif
        <div class="field-row field-merge field-content">
            <p class="field-ttl">{{ trans('profile.rule') }}</p>
            <div class="content">
                {{ trans('profile.rule_desc1') }}<br>
                {{ trans('profile.rule_desc2') }}<br>
                {{ trans('profile.rule_desc3') }}
            </div>
        </div>
        <div class="field-row field-merge field-content">
            <p class="field-ttl">{{ trans('profile.prohibits') }}</p>
            <div class="content">
                {{ trans('profile.prohibits_desc') }}
            </div>
        </div>
        <div class="field-row field-merge field-content">
            <p class="field-ttl last-ttl">{{ trans('profile.desc') }}</p>
        </div>
        <div class="field-row field-merge field-content">
            <div class="field-ttl last-ttl">
                <input class="checkbox" type="checkbox" id="agree" name="agree"><label for="agree">{{ trans('profile.agree') }}</label>
            </div>
        </div>
        <div class="btn-div last">
            <button type="submit" class="btn btn-next" id="submit_btn" disabled>{{ trans('button.register_profile') }}</button>
        </div>
    </form>

    <script>
        $('#agree').click(function(){
            if($(this).is(":checked")){
                $("#submit_btn").prop('disabled', false);
            }
            else if($(this).is(":not(:checked)")){
                $("#submit_btn").prop('disabled', true);
            }
        });
    </script>
@endsection
