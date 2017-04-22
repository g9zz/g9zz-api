<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Email: ylsc633@gmail.com
 * Date: 2017/4/23
 * Time: 上午4:40
 */

namespace App\Transformers;


use App\Models\Nodes;

class NodeTransformer extends BaseTransformer
{
    public function transform(Nodes $nodes)
    {
        $return = [
            'postCount' => $nodes->post_count,
            'weight' => $nodes->weight,
            'level' => $nodes->level,
            'is_show' => $nodes->is_show,
            'name' => $nodes->name,
            'slug' => $nodes->slug,
            'description' => $nodes->description,
            'newHtml' => $nodes->newHtml,
        ];
        return $return;
    }
}