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
        'title.max' => 401000001,
        'content.required' => 401000002,
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
        'error.relation' => 402000009,
        'has.child_node' => 402000010,
    ],
    'tag' => [
        'name.required' => 403000000,
        'name.unique' => 403000001,
        'displayName.required' => 403000002,
        'displayName.unique' => 403000003,
        'displayName.max' => 403000004,
        'displayName.regex' => 403000005,
        'weight.required' => 403000006,
        'description.max' => 403000007,
    ],
    'reply' => [
        'postId.required' => 405000000,
        'postId.exists' => 405000001,
        'content.required' => 40500002,
    ],
    'append' => [
        'content.required' => 406000000,
        'content.max' => 406000001,
        'postId.required' => 406000002,
        'postId.exists' => 406000003,
        'isNot.author' => 406000004,
        'max.count' => 406000005,
    ],
    'permission' => [
        'name.required' => 407000000,
        'name.unique' => 407000001,
        'displayName.required' => 407000002,
        'displayName.unique' => 407000003,
        'description.max' => 407000004,
    ],
];