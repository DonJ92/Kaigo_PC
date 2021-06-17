@extends('layouts.setting')

@section('title', trans('contactus.title'))

@section('content')
    <div class="main-m main-block main-block-white">
        <div class="main-m-title setting-board border-bottom-light">
        </div>
        <div class="setting-block">
            <h4 class="setting-title">{{ trans('contactus.title') }}</h4>
            <div class="setting-detail-block">
                <form>
                    <div class="div col-2-1 margin-center">
                        <div class="field-row one-one">
                            <p class="field-ttl">{{ trans('contactus.category') }}</p>
                            <select class="form">
                                <option value="" selected="">{{ trans('contactus.category_placeholder') }}</option>
                            </select>
                        </div>

                        <div class="field-row one-one">
                            <p class="field-ttl">{{ trans('contactus.email') }}</p>
                            <input class="form underline" type="text" placeholder="{{ trans('contactus.email_placeholder') }}"/>
                        </div>

                        <div class="field-row one-one">
                            <p class="field-ttl">{{ trans('contactus.content') }}</p>
                            <div>
                                <textarea class="form form-textarea" placeholder="{{ trans('contactus.content_placeholder') }}"></textarea>
                            </div>
                        </div>

                        <div class="job-column-block">
                            <h3 class="sub-title">{{ trans('contactus.warning_title') }}</h3>
                            <p class="detail-content">
                                {{ trans('contactus.warning_desc1') }}<br>
                                {{ trans('contactus.warning_desc2') }}<br>
                                {{ trans('contactus.warning_desc3') }}<br>
                                {{ trans('contactus.warning_desc4') }}
                            </p>
                        </div>
                    </div>

                    <div class="btn-block right">
                        <button class="btn primary-btn" type="submit">{{ trans('button.send') }}</button>
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
            $('#setting_contactus').addClass('active');
        });
    </script>
@endsection
