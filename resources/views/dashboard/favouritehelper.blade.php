@extends('layouts.dashboard')

@section('content')
    <div class="main">
        <h3 class="dashboard-ttl">お気に入り</h3>
        <div class="dashbaord-home-row">
            <div class="worker-list">
                @for($i = 0; $i < 12; $i++)
                <div class="worker-block three-list">
                    <a href="workerdetail.html">
                        <div class="worker-item">
                            <div class="worker-item-head">
                                <div class="worker-item-photo">
                                    <img src="{{ asset('/images/common/photo-02.jpg') }}" alt="" />
                                </div>
                                <div class="worker-item-infos">
                                    <div class="worker-item-ttl">
                                        <span>ニックネーム</span>
                                        <div class="worker-item-review">
                                            <p class="worker-item-txt">レビュー　4</p>
                                            <i class="fa fa-star st-act"></i>
                                            <i class="fa fa-star st-act"></i>
                                            <i class="fa fa-star st-act"></i>
                                            <i class="fa fa-star st-act"></i>
                                            <i class="fa fa-star"></i>
                                            <p class="worker-item-txt">(26件)</p>
                                        </div>
                                    </div>
                                    <p class="worker-item-address">居住地</p>
                                </div>
                            </div>

                            <div class="worker-item-attr-list">
                                <div class="worker-item-attr-item">
                                    <div class="worker-item-attr-item-inner">
                                        <div class="worker-item-attr-item-icon">
                                            <img src="{{ asset('/images/common/ico-female.png') }}" alt="" />
                                        </div>
                                        <p class="worker-item-attr-item-txt-small">女性</p>
                                    </div>
                                </div>

                                <div class="worker-item-attr-item">
                                    <div class="worker-item-attr-item-inner">
                                        <p class="worker-item-attr-item-txt-large">25~30</p>
                                        <p class="worker-item-attr-item-txt-small">年齢</p>
                                    </div>
                                </div>

                                <div class="worker-item-attr-item">
                                    <div class="worker-item-attr-item-inner">
                                        <p class="worker-item-attr-item-txt-large">生活相談員資格</p>
                                        <p class="worker-item-attr-item-txt-small">資格・スキル</p>
                                    </div>
                                </div>

                                <div class="worker-item-attr-item">
                                    <div class="worker-item-attr-item-inner">
                                        <p class="worker-item-attr-item-txt-large">¥3,000〜</p>
                                        <p class="worker-item-attr-item-txt-small">希望時給</p>
                                    </div>
                                </div>
                            </div>

                            <div class="worker-item-cta">
                                <div class="worker-item-cta-inner">
                                    <a href="#">
                                        <span>メッセージ</span>
                                        <i class="ti-comment"></i>
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
