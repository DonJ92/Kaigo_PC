@extends('layouts.dashboard')

@section('title', trans('identification.title'))

@section('content')
    <div class="main">
        <h3 class="dashboard-ttl">{{ trans('identification.title') }}</h3>
        <form method="POST" action="{{ route('dashboard.identification.submit') }}" enctype="multipart/form-data">
            @csrf

            <div class="identyfy-div">
                <h3>{{ trans('identification.sub_title') }}</h3>
                <p class="identify-desc">{{ trans('identification.identification_desc') }}</p>
                <div class="identify-warning">
                    <img class="identify-photo" src="{{ asset('/images/identify-confirm.svg') }}">
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
                    <li>{{ trans('identification.warning3') }}</li>
                </ul>
                <h3 class="center">{{ trans('identification.age_desc') }}</h3>
                <h2 class="confirm-h2">{{ $age }}</h2>
                <p class="content-font center light-pink">{{ trans('identification.birthday_repair_desc') }}</p>
                <div class="field-row center">
                    <p class="field-ttl">{{ trans('identification.birthday_label') }}</p>
                    <input type="date" class="form" id="birthday" name="birthday">
                    @error('birthday')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <img class="japhic" src="{{ asset('/images/Japhic.svg') }}">
                <p class="content-font">{{ trans('identification.japhic') }}</p>
                <div class="btn-block right">
                    <button type="submit" class="btn primary-btn right-margin">{{ trans('button.next') }}</button>
                </div>
            </div>
        </form>
    </div>

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

            $('#side_menu_identification').addClass('current');
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
