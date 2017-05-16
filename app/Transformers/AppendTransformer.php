<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Email: ylsc633@gmail.com
 * Date: 2017/5/16
 * Time: 下午10:37
 */

namespace App\Transformers;


use App\Models\Appends;

class AppendTransformer extends BaseTransformer
{
    public function transform(Appends $appends)
    {
        $return = [
            'id' => $appends->id,
            'content' => $appends->content,
            'contentOriginal' => $appends->content_original,
            'createdAt' => rfc_3339($appends->created_at)
        ];
        if ($appends->topic_id) {
            $return['post'] = [
                'id' => isset($appends->post->id) ? $appends->post->id :null,
                'title' => isset($appends->post->title) ? $appends->post->title :null,
            ];
        }

        return $return;
    }
}