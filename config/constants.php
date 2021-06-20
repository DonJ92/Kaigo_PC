<?php

define('CLIENT', 1);
define('HELPER', 2);

define('USER_NONE', 1);
define('USER_PENDING', 2);
define('USER_CONFIRMED', 3);

define('HELPER_HOME_PAGE_CNT', 9);
define('HELPER_LIST_PAGE_CNT', 8);
define('HELPER_DETAIL_PAGE_CNT', 6);
define('HELPER_FAVOURITE_PAGE_CNT', 12);

define('FAVOURITE_HELPER', 1);
define('FAVOURITE_JOB', 2);

define('NOTICE_ON', 1);
define('NOTICE_OFF', 2);

return [
    'gender' => [
        ['id' => 1, 'name' => '男性'],
        ['id' => 2, 'name' => '女性']
    ],

    'user_status' => [
        ['id' => 1, 'status' => '本人確認未提出'],
        ['id' => 2, 'status' => '審査中'],
        ['id' => 3, 'status' => '本人確認済み']
    ],

    'type' => [
        ['id' => 1, 'name' => '施設'],
        ['id' => 2, 'name' => 'ヘルパー']
    ],

    'age' => [
        ['id' => 1, 'name' => '10代'],
        ['id' => 2, 'name' => '20代'],
        ['id' => 3, 'name' => '30代'],
        ['id' => 4, 'name' => '40代'],
        ['id' => 5, 'name' => '50代'],
        ['id' => 6, 'name' => '60代']
    ],

    'experience' => [
        ['id' => 1, 'name' => '1年～5年'],
        ['id' => 2, 'name' => '6年～10年'],
        ['id' => 3, 'name' => '11年～15年'],
        ['id' => 4, 'name' => '16年～20年'],
        ['id' => 5, 'name' => '21年～25年'],
        ['id' => 6, 'name' => '26年～30年']
    ],

    'accident' => [
        ['id' => 1, 'type' => '加⼊してる'],
        ['id' => 2, 'type' => '加⼊してない']
    ],

    'traffic_cost' => [
        ['id' => 1, 'type' => '支給あり'],
        ['id' => 2, 'type' => '支給なし']
    ],

    'payment_method' => [
        ['id' => 1, 'type' => '銀行振込'],
        ['id' => 2, 'type' => 'クレジットカード']
    ],

    'coupon' => [
        ['id' => 1, 'type' => 'なし'],
        ['id' => 2, 'type' => 'あり']
    ],

    'exit_cause' => [
        ['id' => 1, 'desc' => '希望する条件に合う案件とマッチングしない'],
        ['id' => 2, 'desc' => '使い方がよくわからない'],
        ['id' => 3, 'desc' => '他のサービスを利用するため'],
        ['id' => 4, 'desc' => 'サービス内に不快な思いをしたため'],
    ]
];