@extends('layouts.app')

@section('title', trans('helper.search.title'))

@section('content')
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
                                '                                    <a onclick="loginPopup()">\n' +
                                '                                        <span>{{ trans('button.message') }}</span>\n' +
                                '                                        <i class="ti-comment"></i>\n' +
                                '                                    </a>\n' +
                                '                                    <a onclick="loginPopup()">\n' +
                                '                                       <span>{{ trans('button.favourite') }}</span>\n' +
                                '                                       <i class="ti-heart"></i>\n' +
                                '                                   </a>\n' +
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