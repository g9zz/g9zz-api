<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Email: ylsc633@gmail.com
 * Date: 2017/4/28
 * Time: 下午7:54
 */

return [
    'node' => [
        'max_level' => 3
    ],
    'append' => [
        'max_count' => 1
    ],
    'invite_code' => [
        'max_num' => 5,
        'is_invite' => env('IS_INVITE',false),
    ],
    'token' => [
        'valid_time' => 12 * 60 * 60  //秒数
    ]
];