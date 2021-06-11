@extends('layouts.setting')

@section('content')
    <div class="main-m main-block main-block-white">
        <div class="main-m-title setting-board border-bottom-light">
        </div>
        <div class="setting-block">
            <h4 class="setting-title">支払い設定</h4>
            <div class="setting-detail-block">
                <form>
                    <img class="credit-card-img" src="{{ asset('/images/credit-card.svg') }}">
                    <div class="field-row">
                        <p class="field-ttl">クレジットカード番号</p>
                        <input class="form" type="text" placeholder="0000 0000 0000 0000">
                    </div>
                    <div class="div flex">
                        <div class="field-row one-third">
                            <p class="field-ttl">有効期限</p>
                            <select class="form">
                                <option>7月</option>
                            </select>
                        </div>
                        <div class="field-row one-third">
                            <p class="field-ttl">&nbsp;</p>
                            <select class="form">
                                <option>2020年</option>
                            </select>
                        </div>
                    </div>
                    <div class="field-row">
                        <p class="field-ttl one-third">セキュリティコード</p>
                        <input class="form" type="text" placeholder="000">
                    </div>
                    <div class="btn-block right">
                        <button class="btn primary-btn" type="submit">確定</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
