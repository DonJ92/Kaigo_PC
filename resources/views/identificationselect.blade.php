@extends('layouts.login')

@section('title', trans('identification.title'))

@section('body_class', 'profile-register')

@section('content')
    <h2>{{ trans('identification.title') }}</h2>

    <form method="POST">
        @csrf

        <div class="field-row">
            <p class="field-ttl">{{ trans('identification.select_desc') }}</p>
        </div>
        <div class="select-div">
            <a class="select-btn auth-btn active" id="sel_identify">{{ trans('identification.identify') }}</a>
            <a class="select-btn req-btn" id="sel_skill">{{ trans('identification.skill') }}</a>
        </div>
        <div class="btn-div last">
            <a class="btn btn-next" id="btn_next" href="{{ route('identification.register') }}">{{ trans('button.next') }}</a>
        </div>
    </form>

    <script>
        $(window).on('load', function() {
            @if (session()->has('success'))
            toastr.success('{{ session()->get('success') }}', '', { "closeButton": true });
            @endif
        });

        $("#sel_identify").click(function(){
            $("#sel_skill").removeClass("active");
            if (!$("#sel_identify").hasClass("active"))
                $("#sel_identify").addClass("active");

            $('#btn_next').prop('href', '{{ route('identification.register') }}')
        });

        $("#sel_skill").click(function(){
            $("#sel_identify").removeClass("active");
            if (!$("#sel_skill").hasClass("active"))
                $("#sel_skill").addClass("active");

            $('#btn_next').prop('href', '{{ route('skill.register') }}')
        });
    </script>
@endsection
