<?php

define('CLIENT', 1);
define('HELPER', 2);

define('USER_NONE', 1);
define('USER_PENDING', 2);
define('USER_CONFIRMED', 3);

define('HELPER_PAGE_CNT', 8);

define('FAVOURITE_HELPER', 1);
define('FAVOURITE_JOB', 2);

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
];