@extends('layouts.dashboard')

@section('title', trans('favourite.title'))

@section('content')
    <div class="main">
        <h3 class="dashboard-ttl">{{ trans('favourite.title') }}</h3>
        <div class="dashbaord-home-row">
            <input type="hidden" id="count" value="0">
            <div class="worker-list" id="helper_list">
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

            $('#side_menu_favourite').addClass('current');

            getHelperList();
        });

        $('#helper_list').scroll(function() {
            if($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight) {
                getHelperList();
            }
        });

        function onUnFavourite(helper_id) {
            var token = $("input[name=_token]").val();

            $.ajax({
                url: '{{ route('dashboard.helper.favourite.cancel') }}',
                type: 'POST',
                data: {_token: token, helper_id: helper_id},
                dataType: 'JSON',
                success: function (response) {
                    if (response == true) {
                        toastr.success('{{ trans('favourite.cancel_success') }}', '', {"closeButton": true});
                        $('#helper_list').html('');
                        $('#count').val(0);
                        getHelperList();
                    } else
                        toastr.error('{{ trans('favourite.cancel_failed') }}', '', { "closeButton": true });
                }
            });

        }

        function getHelperList() {
            var token = $("input[name=_token]").val();
            var count = $('#count').val();

            $.ajax({
                url: '{{ route('dashboard.favourite.helper.getlist') }}',
                type: 'POST',
                data: {_token: token, count: count},
                dataType: 'JSON',
                success: function (response) {
                    datas = new Array();
                    if (response == undefined || response.length == 0) {
                    } else {
                        for (var i = 0; i < response.length; i++) {
                            var favourite = '<a href="#" id="like_'+ response[i].id +'" onclick="onUnFavourite(' + response[i].id + ')">\n' +
                                '   <span>{{ trans('button.favourite') }}</span>\n' +
                                '   <i class="fa fa-heart light-pink" id="like_ico_'+ response[i].id +'"></i>\n' +
                                '</a>\n';

                            $('#helper_list').append('<div class="worker-block three-list">\n' +
                                '                        <div class="worker-item">\n' +
                                '                            <div class="worker-item-head">\n' +
                                '                                <div class="worker-item-photo">\n' +
                                '                                    <a href="{{ url('dashboard/helper/detail') }}/' + response[i].id + '"><img src="' + response[i].photo + '" alt="" /></a>\n' +
                                '                                </div>\n' +
                                '                                <div class="worker-item-infos">\n' +
                                '                                    <div class="worker-item-ttl">\n' +
                                '                                        <span><a href="{{ url('dashboard/helper/detail') }}/' + response[i].id + '">' + response[i].last_name + response[i].first_name + '</a></span>\n' +
                                '                                        <div class="worker-item-review">\n' +
                                '                                            <p class="worker-item-txt">レビュー　4</p>\n' +
                                '                                            <i class="fa fa-star st-act"></i>\n' +
                                '                                            <i class="fa fa-star st-act"></i>\n' +
                                '                                            <i class="fa fa-star st-act"></i>\n' +
                                '                                            <i class="fa fa-star st-act"></i>\n' +
                                '                                            <i class="fa fa-star"></i>\n' +
                                '                                            <p class="worker-item-txt">(26件)</p>\n' +
                                '                                        </div>\n' +
                                '                                    </div>\n' +
                                '                                    <p class="worker-item-address">' + response[i].province_name + '</p>\n' +
                                '                                </div>\n' +
                                '                            </div>\n' +
                                '\n' +
                                '                            <div class="worker-item-attr-list">\n' +
                                '                                <div class="worker-item-attr-item">\n' +
                                '                                    <div class="worker-item-attr-item-inner">\n' +
                                '                                        <div class="worker-item-attr-item-icon">\n' +
                                '                                            <img src="{{ asset('/images/common/ico-female.png') }}" alt="" />\n' +
                                '                                        </div>\n' +
                                '                                        <p class="worker-item-attr-item-txt-small">' + response[i].gender + '</p>\n' +
                                '                                    </div>\n' +
                                '                                </div>\n' +
                                '\n' +
                                '                                <div class="worker-item-attr-item">\n' +
                                '                                    <div class="worker-item-attr-item-inner">\n' +
                                '                                        <p class="worker-item-attr-item-txt-large">' + response[i].age + '</p>\n' +
                                '                                        <p class="worker-item-attr-item-txt-small">{{ trans('helper.age') }}</p>\n' +
                                '                                    </div>\n' +
                                '                                </div>\n' +
                                '\n' +
                                '                                <div class="worker-item-attr-item cert">\n' +
                                '                                    <div class="worker-item-attr-item-inner">\n' +
                                '                                        <p class="worker-item-attr-item-txt-large">' + response[i].certificate + '</p>\n' +
                                '                                        <p class="worker-item-attr-item-txt-small">{{ trans('helper.skill') }}</p>\n' +
                                '                                    </div>\n' +
                                '                                </div>\n' +
                                '\n' +
                                '                                <div class="worker-item-attr-item cost">\n' +
                                '                                    <div class="worker-item-attr-item-inner">\n' +
                                '                                        <p class="worker-item-attr-item-txt-large">' + response[i].hourly_cost + '</p>\n' +
                                '                                        <p class="worker-item-attr-item-txt-small">{{ trans('helper.hourly_cost') }}</p>\n' +
                                '                                    </div>\n' +
                                '                                </div>\n' +
                                '                            </div>\n' +
                                '\n' +
                                '                            <div class="worker-item-cta">\n' +
                                '                                <div class="worker-item-cta-inner">\n' +
                                '                                    <a href="#">\n' +
                                '                                        <span>{{ trans('button.message') }}</span>\n' +
                                '                                        <i class="ti-comment"></i>\n' +
                                '                                    </a>\n' + favourite +
                                '                                </div>\n' +
                                '                            </div>\n' +
                                '                        </div>\n' +
                                '                </div>');
                        }
                        $('#count').val(parseInt(count) + response.length);
                    }
                }
            });
        }
    </script>
@endsection
