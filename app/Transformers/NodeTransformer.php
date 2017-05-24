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
//            'id' => $nodes->id,
            'hid' => $nodes->hid,
            'postCount' => $nodes->post_count,
            'weight' => $nodes->weight,
            'level' => $nodes->level,
            'is_show' => $nodes->is_show,
            'name' => $nodes->name,
            'displayName' => $nodes->display_name,
            'description' => $nodes->description,
        ];

        if ($nodes->newHtml) {
            $return['html'] = ['newHtml' => $nodes->newHtml];
        }


        return $return;
    }
}