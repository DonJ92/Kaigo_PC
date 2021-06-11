@extends('layouts.setting')

@section('content')
    <div class="main-m main-block main-block-white">
        <div class="main-m-title setting-board border-bottom-light">
        </div>
        <div class="setting-block">
            <h4 class="setting-title">お問い合わせ</h4>
            <div class="setting-detail-block">
                <form>
                    <div class="div col-2-1 margin-center">
                        <div class="field-row one-one">
                            <p class="field-ttl">お問い合わせカテゴリ</p>
                            <select class="form">
                                <option value="" selected="">未選択</option>
                            </select>
                        </div>

                        <div class="field-row one-one">
                            <p class="field-ttl">メールアドレス</p>
                            <input class="form underline" type="text" placeholder="メールアドレスを入力"/>
                        </div>

                        <div class="field-row one-one">
                            <p class="field-ttl">お問い合わせ内容</p>
                            <div>
                                <textarea class="form form-textarea" placeholder="お問い合わせ内容を記⼊してください。"></textarea>
                            </div>
                        </div>

                        <div class="job-column-block">
                            <h3 class="sub-title">注意事項</h3>
                            <p class="detail-content">
                                ご回答までに2営業⽇程度お時間を頂く場合がございます。<br>
                                予めご了承くださいませ。<br>
                                お問い合わせ受付：24時間 365⽇<br>
                                返信対応時間：平⽇10:00 ~ 19:00
                            </p>
                        </div>
                    </div>

                    <div class="btn-block right">
                        <button class="btn primary-btn" type="submit">送信する</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
