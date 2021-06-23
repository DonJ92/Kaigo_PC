@extends('layouts.dashboard')

@section('title', trans('client.title'))

@section('header')
    <link href="//cdn.syncfusion.com/ej2/ej2-base/styles/material.css" rel="stylesheet">
    <link href="//cdn.syncfusion.com/ej2/ej2-buttons/styles/material.css" rel="stylesheet">
    <link href="//cdn.syncfusion.com/ej2/ej2-calendars/styles/material.css" rel="stylesheet">

    <script src="{{ asset('js/ej2/ej2.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/app.js') }}"></script>
@endsection

@section('content')
    <div class="main block-3">
        <div class="main-l main-block main-block-gray">
            <div class="main-1-title">
                <h3>{{ trans('client.list_panel') }}</h3>
            </div>
            <input type="hidden" id="count" value="0">
            <div class="job-list" id="job_list">
            </div>
        </div>
        <div class="main-m main-block main-block-white">
            <div class="main-m-title">
                <h3>{{ trans('client.detail_panel') }}</h3>
            </div>
            <div class="personal-detail-block">
                <div class="profile-block">
                    <img class="profile-photo" src="{{ $photo1 }}">
                    <div class="info-list-block">
                        <div class="con-block">
                            <div class="con-title">
                                <h3 class="pink">{{ trans('client.profile') }}</h3>
                            </div>
                            <div class="con-detail">
                                <span>{{ trans('client.age') }}</span>
                                <div class="con-column"><span>{{ $age }}</span></div>
                            </div>
                            <div class="con-detail">
                                <span>{{ trans('client.address') }}</span>
                                <div class="con-column"><span>{{ $province_name }}</span></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="detail-block">
                    <div class="user-infos">
                        <p class="user-ttl">{{ $last_name.$first_name }}</p>
                        <p class="user-place">{{ $province_name.$address }}</p>
                        <div class="user-item-review">
                            <p class="user-item-txt">レビュー　4</p>
                            <i class="fa fa-star st-act"></i>
                            <i class="fa fa-star st-act"></i>
                            <i class="fa fa-star st-act"></i>
                            <i class="fa fa-star st-act"></i>
                            <i class="fa fa-star"></i>
                            <p class="user-item-txt">(26件)</p>
                        </div>
                    </div>
                    <div class="job-item-customer profile">
                        <div class="job-item-customer-infos profile">
                            <p class="job-item-customer-ttl">{{ $gender }}</p>
                            <p class="job-item-customer-place">{{ trans('client.gender') }}</p>
                        </div>
                        <div class="job-item-customer-infos profile">
                            <p class="job-item-customer-ttl">321</p>
                            <p class="job-item-customer-place">{{ trans('client.like') }}</p>
                        </div>
                    </div>
                    <div class="job-column-block">
                        <h3 class="sub-title underline">{{ trans('client.introduction') }}</h3>
                        <p class="detail-content">
                            {{ $introduction }}
                        </p>
                    </div>
                    <div class="job-column-block">
                        <h3 class="sub-title underline">{{ trans('client.gallery') }}</h3>
                        <div class="gallery">
                            <img src="{{ $photo2 }}">
                            <img src="{{ $photo3 }}">
                            <img src="{{ $photo4 }}">
                            <img src="{{ $photo5 }}">
                        </div>
                    </div>
                    <div class="btn-block">
                        <a class="btn primary-btn right-align" onclick="loginPopup()">{{ trans('button.favourite') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('/js/calendar.js') }}"></script>
    <script>
        $(window).on('load', function() {
            @if ($errors->has('failed'))
            toastr.error('{{ $errors->first('failed') }}', '', { "closeButton": true });
            @endif

            @if (session()->has('success'))
            toastr.success('{{ session()->get('success') }}', '', { "closeButton": true });
            @endif

            $('#side_menu_job_list').addClass('current');

            getJobList();
        });

        $('#job_list').scroll(function() {
            if($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight) {
                getJobList();
            }
        });

        function onFavourite(job_id) {
            var token = $("input[name=_token]").val();

            $.ajax({
                url: '{{ route('dashboard.job.favourite') }}',
                type: 'POST',
                data: {_token: token, job_id: job_id},
                dataType: 'JSON',
                success: function (response) {
                    if (response == true) {
                        toastr.success('{{ trans('favourite.register_success') }}', '', {"closeButton": true});
                        $("#like_ico_"+job_id).removeClass();
                        $("#like_ico_"+job_id).addClass('fa fa-heart light-pink');
                        $("#like_"+job_id).attr('onclick', 'onUnFavourite(' + job_id + ')');
                    } else
                        toastr.error('{{ trans('favourite.register_failed') }}', '', { "closeButton": true });
                }
            });

        }

        function onUnFavourite(job_id) {
            var token = $("input[name=_token]").val();

            $.ajax({
                url: '{{ route('dashboard.job.favourite.cancel') }}',
                type: 'POST',
                data: {_token: token, job_id: job_id},
                dataType: 'JSON',
                success: function (response) {
                    if (response == true) {
                        toastr.success('{{ trans('favourite.cancel_success') }}', '', {"closeButton": true});
                        $("#like_ico_"+job_id).removeClass();
                        $("#like_ico_"+job_id).addClass('fa fa-heart-o');
                        $("#like_"+job_id).attr('onclick', 'onFavourite(' + job_id + ')');
                    } else
                        toastr.error('{{ trans('favourite.cancel_failed') }}', '', { "closeButton": true });
                }
            });

        }

        function getJobList() {
            var token = $("input[name=_token]").val();
            var count = $('#count').val();

            $.ajax({
                url: '{{ route('dashboard.job.getlist') }}',
                type: 'POST',
                data: {_token: token, count: count},
                dataType: 'JSON',
                success: function (response) {
                    datas = new Array();
                    if (response == undefined || response.length == 0) {
                    } else {
                        for (var i = 0; i < response.length; i++) {
                            if(response[i].favourite_id == null)
                                var favourite = '<a href="#" id="like_'+ response[i].id +'" onclick="onFavourite(' + response[i].id + ')">\n' +
                                    '   <span>{{ trans('button.favourite') }}</span>\n' +
                                    '   <i class="fa fa-heart-o" id="like_ico_'+ response[i].id +'"></i>\n' +
                                    '</a>\n';
                            else
                                var favourite = '<a href="#" id="like_'+ response[i].id +'" onclick="onUnFavourite(' + response[i].id + ')">\n' +
                                    '   <span>{{ trans('button.favourite') }}</span>\n' +
                                    '   <i class="fa fa-heart light-pink" id="like_ico_'+ response[i].id +'"></i>\n' +
                                    '</a>\n';

                            $('#job_list').append(
                                '<div class="job-block one-list">\n' +
                                '<div class="job-item">\n' +
                                '    <div class="job-item-customer">\n' +
                                '        <div class="job-item-customer-photo">\n' +
                                '            <a href="{{ url('dashboard/client/detail') }}/' + response[i].user_id + '"><img src="' + response[i].photo + '" alt="" /></a>\n' +
                                '        </div>\n' +
                                '        <div class="job-item-customer-infos">\n' +
                                '            <p class="job-item-customer-ttl"><a href="{{ url('dashboard/client/detail') }}/' + response[i].user_id + '">' + response[i].last_name + response[i].first_name + '</a></p>\n' +
                                '            <p class="job-item-customer-place">' + response[i].province + response[i].address + '</p>\n' +
                                '        </div>\n' +
                                '    </div>\n' +
                                '\n' +
                                '    <h4 class="job-item-ttl"><a href="{{ url('dashboard/job/detail') }}/' + response[i].id + '">' + response[i].title + '</a></h4>\n' +
                                '    <div class="job-item-meta">\n' +
                                '        <p class="job-item-meta-head">{{ trans('job.datetime') }}</p>\n' +
                                '        <p class="job-item-meta-data">' + response[i].period + ' ' + response[i].from_time + '~' + response[i].to_time + '</p>\n' +
                                '    </div>\n' +
                                '    <div class="job-item-meta">\n' +
                                '        <p class="job-item-meta-head">{{ trans('job.cost') }}</p>\n' +
                                '        <p class="job-item-meta-data">' + response[i].cost + '</p>\n' +
                                '    </div>\n' +
                                '    <div class="job-item-figure" style="background: url({{ asset('/images/common/job-figure.jpg') }});"></div>\n' +
                                '    <div class="job-item-share">\n' +
                                '        <i class="fa fa-share-alt"></i>\n' +
                                '        <div class="job-item-share-r">\n' +
                                '            <a href="#">\n' +
                                '                <span>{{ trans('button.bid') }}</span>\n' +
                                '                <i class="ti-comment "></i>\n' +
                                '            </a>\n' + favourite +
                                '        </div>\n' +
                                '    </div>\n' +
                                '</div>\n' +
                                '</div>'
                            );
                        }
                        $('#count').val(parseInt(count) + response.length);
                    }
                }
            });
        }
    </script>
@endsection
