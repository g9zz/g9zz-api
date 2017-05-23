<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Email: ylsc633@gmail.com
 * Date: 2017/5/12
 * Time: 上午12:00
 */

namespace App\Transformers;


use App\Models\Tags;

class TagTransformer extends BaseTransformer
{
    public function transform(Tags $tags)
    {
        $return = [
            'hid' => $tags->hid,
            'name' => $tags->name,
            'displayName' => $tags->display_name,
            'description' => $tags->description,
            'postCount' => $tags->post_count,
            'weight' => $tags->weight,
        ];

        return $return;
    }
}