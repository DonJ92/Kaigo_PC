@extends('layouts.setting')

@section('content')
    <div class="main-m main-block main-block-white">
        <div class="main-m-title setting-board border-bottom-light">
        </div>
        <div class="setting-block">
            <h4 class="setting-title">プッシュ通知</h4>
            <div class="setting-detail-block">
                <form>
                    <div class="notification-div border-bottom">
                        <P>いいねをもらった時</P>
                        <label class="switch">
                            <input type="checkbox" checked>
                            <span class="switch-slider round"></span>
                        </label>
                    </div>
                    <div class="notification-div border-bottom">
                        <P>マッチングした時</P>
                        <label class="switch">
                            <input type="checkbox" checked>
                            <span class="switch-slider round"></span>
                        </label>
                    </div>
                    <div class="notification-div border-bottom">
                        <P>メッセージをもらった時</P>
                        <label class="switch">
                            <input type="checkbox">
                            <span class="switch-slider round"></span>
                        </label>
                    </div>
                    <div class="notification-div border-bottom">
                        <P>お知らせ</P>
                        <label class="switch">
                            <input type="checkbox" checked>
                            <span class="switch-slider round"></span>
                        </label>
                    </div>
                    <div class="notification-div">
                        <P>その他のお知らせ</P>
                        <label class="switch">
                            <input type="checkbox">
                            <span class="switch-slider round"></span>
                        </label>
                    </div>
                    <div class="btn-block right">
                        <button class="btn primary-btn" type="submit">確定</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
