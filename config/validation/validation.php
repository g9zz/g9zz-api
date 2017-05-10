<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Email: ylsc633@gmail.com
 * Date: 2017/4/12
 * Time: 下午6:00
 */

return [
    'default' => [
        'some.error' => 400000000,
        'data.null' => 400000001,
    ],
    'post' => [
      'title.required' =>  401000000,
    ],
    'node' => [
        'parentId.required' => 402000000,
        'weight.required' => 402000001,
        'name.required' => 402000002,
        'slug.required' => 402000003,
        'name.unique' => 402000004,
        'slug.unique' => 402000005,
        'slug.regex' => 402000006,
        'slug.max' => 402000007,
        'node.max_level' => 402000008,
    ]
];