@extends('layouts.dashboard')

@section('content')
    <div class="main">
        <h3 class="dashboard-ttl">お気に入り</h3>
        <div class="dashbaord-home-row">
            <div class="job-list">
                @for($i = 0; $i < 9; $i++)
                <div class="job-block three-list">
                    <a href="{{ route('dashboard.job.detail') }}">
                        <div class="job-item">
                            <div class="job-item-customer">
                                <div class="job-item-customer-photo">
                                    <img src="{{ asset('/images/common/photo-01.jpg') }}" alt="" />
                                </div>
                                <div class="job-item-customer-infos">
                                    <p class="job-item-customer-ttl">発注者名</p>
                                    <p class="job-item-customer-place">場所</p>
                                </div>
                            </div>

                            <h4 class="job-item-ttl">案件タイトル</h4>
                            <div class="job-item-meta">
                                <p class="job-item-meta-head">日時</p>
                                <p class="job-item-meta-data">12/15(金) 14:00~18:00</p>
                            </div>
                            <div class="job-item-meta">
                                <p class="job-item-meta-head">時給</p>
                                <p class="job-item-meta-data">¥3,000~ / 1h</p>
                            </div>
                            <div class="job-item-figure" style="background: url({{ asset('/images/common/job-figure.jpg') }});"></div>
                            <div class="job-item-share">
                                <i class="fa fa-share-alt"></i>
                                <div class="job-item-share-r">
                                    <a href="#">
                                        <span>応募する</span>
                                        <i class="ti-comment "></i>
                                    </a>
                                    <a href="#">
                                        <span>お気に入り</span>
                                        <i class="ti-heart"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @endfor
            </div>
        </div>
    </div>
@endsection
