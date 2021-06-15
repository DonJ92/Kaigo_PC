@extends('layouts.dashboard')

@section('title', trans('helper.search.title'))

@section('content')
    <div class="main block-3">
        <div class="main-l main-block main-block-white">
            <div class="main-1-title">
                <h3>{{ trans('helper.search.search_panel') }}</h3>
            </div>
            <form class="search-block">
                <div>
                    <input class="form" type="text" placeholder="東京都　保育">
                </div>
                <div class="info-list-block">
                    <div class="title-block">
                        <h2><i class="fa fa-search"></i>&nbsp;{{ trans('helper.search.search_title') }}</h2>
                    </div>
                    <div class="con-block">
                        <div class="con-title">
                            <h3>{{ trans('helper.search.search_detail') }}</h3>
                        </div>
                        <div class="con-detail">
                            <span>場所</span>
                            <div class="con-column"><span>東京都、神奈川</span></div>
                        </div>
                        <div class="con-detail">
                            <span>時間帯</span>
                            <div class="con-column"><span>10:00〜20:00</span></div>
                        </div>
                        <div class="con-detail">
                            <span>職種</span>
                            <div class="con-column"><span>生活相談員 ></span></div>
                        </div>
                        <div class="con-detail">
                            <span>募集中の仕事のみ</span>
                            <div class="con-column"><span>生活相談員 ></span></div>
                        </div>
                        <div class="con-detail">
                            <span>年齢</span>
                            <div class="con-column"><span>〇〇歳</span></div>
                        </div>
                    </div>
                </div>
                <div class="btn-block">
                    <a class="btn reset-btn" href="#">リセット</a>
                    <a class="btn secondary-btn" href="#">この条件で検索</a>
                </div>
                <div class="btn-map">
                    <a href="#">マップで探す&nbsp<i class="ti-location-pin"></i></a>
                </div>
            </form>
        </div>
        <div class="main-m main-block main-block-gray">
            <div class="main-m-title">
                <h3>{{ trans('helper.search.list_panel') }}</h3>
            </div>
            <div class="worker-list" id="helper_list">
                <input type="hidden" id="count" value="0">
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

            $('#side_menu_job_list').addClass('current');

            getHelperList();
        });

        $('#helper_list').scroll(function() {
            if($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight) {
                getHelperList();
            }
        });

        function onFavourite(helper_id) {
            var token = $("input[name=_token]").val();

            $.ajax({
                url: '{{ route('dashboard.helper.favourite') }}',
                type: 'POST',
                data: {_token: token, helper_id: helper_id},
                dataType: 'JSON',
                success: function (response) {
                    if (response == true) {
                        toastr.success('{{ trans('favourite.register_success') }}', '', {"closeButton": true});
                        $("#like_ico_"+helper_id).removeClass();
                        $("#like_ico_"+helper_id).addClass('fa fa-heart light-pink');
                        $("#like_"+helper_id).attr('onclick', 'onUnFavourite(' + helper_id + ')');
                    } else
                        toastr.error('{{ trans('favourite.register_failed') }}', '', { "closeButton": true });
                }
            });

        }

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
                        $("#like_ico_"+helper_id).removeClass();
                        $("#like_ico_"+helper_id).addClass('fa fa-heart-o');
                        $("#like_"+helper_id).attr('onclick', 'onFavourite(' + helper_id + ')');
                    } else
                        toastr.error('{{ trans('favourite.cancel_failed') }}', '', { "closeButton": true });
                }
            });

        }
        
        function getHelperList() {
            var token = $("input[name=_token]").val();
            var count = $('#count').val();

            $.ajax({
                url: '{{ route('dashboard.helper.getlist') }}',
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

                            $('#helper_list').append('<div class="worker-block">\n' +
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
