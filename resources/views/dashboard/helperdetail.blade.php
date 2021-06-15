@extends('layouts.dashboard')

@section('title', trans('helper.detail.title'))

@section('content')
    <div class="main block-3">
        <div class="main-l main-block main-block-gray">
            <div class="main-1-title">
                <h3>{{ trans('helper.detail.list_panel') }}</h3>
            </div>
            <div class="worker-list" id="helper_list">
                <input type="hidden" id="count" value="0">
            </div>
        </div>
        <div class="main-m main-block main-block-white">
            <div class="main-m-title">
                <h3>{{ trans('helper.detail.detail_panel') }}</h3>
            </div>
            <div class="personal-detail-block">
                <div class="profile-block">
                    <img class="profile-photo" src="{{ $photo1 }}">
                    <div class="info-list-block">
                        <div class="con-block">
                            <div class="con-title">
                                <h3 class="pink">{{ trans('helper.detail.profile') }}</h3>
                            </div>
                            <div class="con-detail">
                                <span>{{ trans('helper.age') }}</span>
                                <div class="con-column"><span>{{ $age }}</span></div>
                            </div>
                            <div class="con-detail">
                                <span>{{ trans('helper.address') }}</span>
                                <div class="con-column"><span>{{ $province_name }}</span></div>
                            </div>
                            <div class="con-detail">
                                <span>{{ trans('helper.job_type') }}</span>
                                <div class="con-column"><span>{{ $job_type }}</span></div>
                            </div>
                            <div class="con-detail">
                                <span>{{ trans('helper.experience_years') }}</span>
                                <div class="con-column"><span>{{ $experience_years }}</span></div>
                            </div>
                            <div class="con-detail">
                                <span>{{ trans('helper.certificate') }}</span>
                                <div class="con-column"><span>{{ $certificate }}</span></div>
                            </div>
                            <div class="con-detail">
                                <span>{{ trans('helper.hourly_cost') }}</span>
                                <div class="con-column"><span>{{ $hourly_cost }}</span></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="detail-block">
                    <div class="user-infos">
                        <p class="user-ttl">{{ $last_name . $first_name }}</p>
                        <p class="user-place">{{ $province_name . $address }}</p>
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
                            <p class="job-item-customer-ttl">{{ $job_type }}</p>
                            <p class="job-item-customer-place">{{ trans('helper.detail.category') }}</p>
                        </div>
                        <div class="job-item-customer-infos profile">
                            <p class="job-item-customer-ttl">{{ $gender }}</p>
                            <p class="job-item-customer-place">{{ trans('helper.detail.gender') }}</p>
                        </div>
                        <div class="job-item-customer-infos profile">
                            <p class="job-item-customer-ttl">{{ $favourite_count }}</p>
                            <p class="job-item-customer-place">{{ trans('helper.detail.like') }}</p>
                        </div>
                    </div>
                    <div class="job-column-block">
                        <h3 class="sub-title underline">{{ trans('helper.detail.introduction') }}</h3>
                        <p class="detail-content">
                            {{ $introduction }}
                        </p>
                    </div>
                    <div class="job-column-block">
                        <h3 class="sub-title underline">{{ trans('helper.detail.gallery') }}</h3>
                        <div class="gallery">
                            <img src="{{ $photo2 }}">
                            <img src="{{ $photo3 }}">
                            <img src="{{ $photo4 }}">
                            <img src="{{ $photo5 }}">
                        </div>
                    </div>
                    <div class="btn-block">
                        <a class="btn secondary-btn">依頼する</a>
                        @if($favourite_id === null)
                            <a class="btn primary-btn">{{ trans('button.add_favourite') }}</a>
                        @else
                            <a class="btn primary-btn">{{ trans('button.cancel_favourite') }}</a>
                        @endif
                    </div>
                </div>
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

                            $('#helper_list').append(
                                '<div class="worker-block one-list">\n' +
                                '    <a href="{{ url('dashboard/helper/detail') }}/' + response[i].id + '">\n' +
                                '        <div class="worker-item">\n' +
                                '            <div class="worker-item-head">\n' +
                                '                <div class="worker-item-photo">\n' +
                                '                    <img src="' + response[i].photo + '" alt="" />\n' +
                                '                </div>\n' +
                                '                <div class="worker-item-infos">\n' +
                                '                    <div class="worker-item-ttl">\n' +
                                '                        <span>' + response[i].last_name + response[i].first_name + '</span>\n' +
                                '                        <div class="worker-item-review">\n' +
                                '                            <p class="worker-item-txt">レビュー　4</p>\n' +
                                '                            <i class="fa fa-star st-act"></i>\n' +
                                '                            <i class="fa fa-star st-act"></i>\n' +
                                '                            <i class="fa fa-star st-act"></i>\n' +
                                '                            <i class="fa fa-star st-act"></i>\n' +
                                '                            <i class="fa fa-star"></i>\n' +
                                '                            <p class="worker-item-txt">(26件)</p>\n' +
                                '                        </div>\n' +
                                '                    </div>\n' +
                                '                    <p class="worker-item-address">' + response[i].province_name + '</p>\n' +
                                '                </div>\n' +
                                '            </div>\n' +
                                '\n' +
                                '            <div class="worker-item-attr-list">\n' +
                                '                <div class="worker-item-attr-item">\n' +
                                '                    <div class="worker-item-attr-item-inner">\n' +
                                '                        <div class="worker-item-attr-item-icon">\n' +
                                '                            <img src="{{ asset('/images/common/ico-female.png') }}" alt="" />\n' +
                                '                        </div>\n' +
                                '                        <p class="worker-item-attr-item-txt-small">' + response[i].gender + '</p>\n' +
                                '                    </div>\n' +
                                '                </div>\n' +
                                '\n' +
                                '                <div class="worker-item-attr-item">\n' +
                                '                    <div class="worker-item-attr-item-inner">\n' +
                                '                        <p class="worker-item-attr-item-txt-large">' + response[i].age + '</p>\n' +
                                '                        <p class="worker-item-attr-item-txt-small">{{ trans('helper.age') }}</p>\n' +
                                '                    </div>\n' +
                                '                </div>\n' +
                                '\n' +
                                '                <div class="worker-item-attr-item cert">\n' +
                                '                    <div class="worker-item-attr-item-inner">\n' +
                                '                        <p class="worker-item-attr-item-txt-large">' + response[i].certificate + '</p>\n' +
                                '                        <p class="worker-item-attr-item-txt-small">{{ trans('helper.skill') }}</p>\n' +
                                '                    </div>\n' +
                                '                </div>\n' +
                                '\n' +
                                '                <div class="worker-item-attr-item">\n' +
                                '                    <div class="worker-item-attr-item-inner">\n' +
                                '                        <p class="worker-item-attr-item-txt-large">' + response[i].hourly_cost + '</p>\n' +
                                '                        <p class="worker-item-attr-item-txt-small">{{ trans('helper.hourly_cost') }}</p>\n' +
                                '                    </div>\n' +
                                '                </div>\n' +
                                '            </div>\n' +
                                '\n' +
                                '            <div class="worker-item-cta">\n' +
                                '                <div class="worker-item-cta-inner">\n' +
                                '                    <a href="#">\n' +
                                '                        <span>{{ trans('button.message') }}</span>\n' +
                                '                        <i class="ti-comment"></i>\n' +
                                '                    </a>\n' + favourite +
                                '                </div>\n' +
                                '            </div>\n' +
                                '        </div>\n' +
                                '    </a>\n' +
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
