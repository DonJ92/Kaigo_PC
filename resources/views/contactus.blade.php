@extends('layouts.app')

@section('title', trans('contactus.title'))

@section('content')
    <form class="conatct-form">
        <h2 class="contact-title">{{ trans('contactus.title') }}</h2>

        <div class="field-row">
            <p class="field-ttl">{{ trans('contactus.category') }}</p>
            <select class="form">
                <option value="" disabled selected>{{ trans('contactus.category_placeholder') }}</option>
            </select>
        </div>

        <div class="field-row">
            <p class="field-ttl">{{ trans('contactus.email') }}</p>
            <input class="form underline" type="text" placeholder="{{ trans('contactus.email_placeholder') }}"/>
        </div>

        <div class="field-row">
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
    </form>
@endsection