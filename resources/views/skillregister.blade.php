@extends('layouts.login')

@section('title', trans('identification.title'))

@section('body_class', 'profile-register')

@section('content')
    <h2>{{ trans('identification.skill') }}</h2>

    <form method="POST" action="{{ route('skill.register.submit') }}" enctype="multipart/form-data">
        @csrf

        <div class="identyfy-div">
            <h3>{{ trans('identification.sub_title') }}</h3>
            <p class="identify-desc">{{ trans('identification.skill_desc') }}</p>
            <div class="identify-warning">
                <h3>{{ trans('identification.warning') }}</h3>
                <p>{{ trans('identification.warning_desc') }}</p>
            </div>
            <div class="identify-failure-div">
                <div>
                    <img src="{{ asset('/images/identify-failure1.svg') }}">
                    <p>{{ trans('identification.warning1_pre') }}<br>{{ trans('identification.warning1_sur') }}</p>
                </div>
                <div>
                    <img src="{{ asset('/images/identify-failure2.svg') }}">
                    <p>{{ trans('identification.warning2_pre') }}<br>{{ trans('identification.warning2_sur') }}</p>
                </div>
                <div>
                    <img src="{{ asset('/images/identify-failure3.svg') }}">
                    <p>{{ trans('identification.warning3_pre') }}<br>{{ trans('identification.warning3_sur') }}</p>
                </div>
            </div>
            <div class="identify-upload-div">
                <img id="doc_preview"  src="{{ asset('/images/identify-upload.svg') }}">
                <input type="file" id="doc" name="doc" class="display-none" onchange="preview()"/>
                @error('doc')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <ul class="content-font">
                <li>{{ trans('identification.warning1') }}</li>
                <li>{{ trans('identification.warning2') }}</li>
            </ul>
            <h3 class="center">{{ trans('identification.certificate_desc') }}</h3>
            <h2 class="confirm-h2">{{ $certificate }}</h2>
            <p class="content-font center light-pink">{{ trans('identification.skill_repair_desc') }}</p>
            <div class="field-row center">
                <p class="field-ttl">{{ trans('identification.certificate') }}</p>
                <select class="form" id="certificate" name="certificate">
                    @foreach( $certificate_list as $certificate_info)
                        <option value="{{ $certificate_info['id'] }}" @if($certificate_id== $certificate_info['id']) selected @endif>{{ $certificate_info['certificate'] }}</option>
                    @endforeach
                </select>
            </div>
            <img class="japhic" src="{{ asset('/images/Japhic.svg') }}">
            <p class="content-font">{{ trans('identification.japhic') }}</p>
        </div>
        <div class="btn-div last">
            <button type="submit" class="btn btn-next">{{ trans('button.next') }}</button>
        </div>
    </form>

    <script>
        $(window).on('load', function() {
            @if ($errors->has('failed'))
            toastr.error('{{ $errors->first('failed') }}', '', { "closeButton": true });
            @endif

            @if (session()->has('success'))
            toastr.success('{{ session()->get('success') }}', '', { "closeButton": true });
            @endif

            $("#doc_preview").click(function() {
                $("#doc").click();
            });
        });

        function preview() {
            var file = $("#doc").get(0).files[0];

            if(file){
                var reader = new FileReader();

                reader.onload = function(){
                    $("#doc_preview").attr("src", reader.result);
                }

                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection
