@extends('layouts.dashboard')

@section('title', trans('helper.search.title'))

@section('content')
    <div class="main block-3">
        <div class="main-l main-block main-block-white">
            <div class="main-1-title">
                <h3>{{ trans('helper.search.search_panel') }}</h3>
            </div>
            <form class="search-block" id="search_form">
                <div>
                    <input class="form" type="text" id="index" placeholder="{{ trans('helper.index_placeholder') }}">
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
                            <span>{{ trans('common.address') }}</span>
                            <div class="con-column">
                                <select class="search-form ui dropdown" dir="rtl" id="province" name="province[]" multiple>
                                    @foreach ($province_list as $province_info)
                                        <option value="{{ $province_info['id'] }}">{{ $province_info['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="con-detail">
                            <span>{{ trans('common.job_type') }}</span>
                            <div class="con-column">
                                <select class="search-form" dir="rtl" id="job_type" name="job_type">
                                    <option value="">{{ trans('common.all') }}</option>
                                    @foreach ($job_list as $job_info)
                                        <option value="{{ $job_info['id'] }}">{{ $job_info['job_type'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="con-detail">
                            <span>{{ trans('common.experience_years') }}</span>
                            <div class="con-column">
                                <select class="search-form" dir="rtl" id="experience_years" name="experience_years">
                                    <option value="">{{ trans('common.all') }}</option>
                                    @foreach ($experience_list as $experience_info)
                                        <option value="{{ $experience_info['id'] }}" @if($experience_info['id'] == old('experience_years')) selected @endif>{{ $experience_info['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="con-detail">
                            <span>{{ trans('common.age') }}</span>
                            <div class="con-column">
                                <select class="search-form" dir="rtl" id="age" name="age">
                                    <option value="">{{ trans('common.all') }}</option>
                                    @foreach ($age_list as $age_info)
                                        <option value="{{ $age_info['id'] }}" @if($age_info['id'] == old('age')) selected @endif>{{ $age_info['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="btn-block">
                    <a class="btn reset-btn" href="#" onclick="reset()">{{ trans('button.reset') }}</a>
                    <a class="btn secondary-btn" href="#" onclick="onSearch()">{{ trans('button.search_for_condition') }}</a>
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

            $('#side_menu_job_list').addClass('current');

            getHelperList();
        });

        $('#helper_list').scroll(function() {
            if($(this).html() != '' && $(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight) {
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
            var index = $('#index').val();
            var province = $('#province').dropdown('get value');
            var job_type = $('#job_type').val();
            var experience_years = $('#experience_years').val();
            var age = $('#age').val();

            $.ajax({
                url: '{{ route('dashboard.helper.getlist') }}',
                type: 'POST',
                data: {_token: token, count: count, index:index, province: province, job_type: job_type, experience_years: experience_years, age: age},
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

        function reset() {
            $('#search_form')[0].reset();
            $('#province').dropdown('clear');
        }

        function onSearch() {
            $('#helper_list').scrollTop(0);
            $('#count').val(0);
            $('#helper_list').html("");
            getHelperList();
        }

        $('#province').dropdown();
    </script>
@endsection
