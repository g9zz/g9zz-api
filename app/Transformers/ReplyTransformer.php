<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Email: ylsc633@gmail.com
 * Date: 2017/5/14
 * Time: 上午2:15
 */

namespace App\Transformers;


use App\Models\Replies;

class ReplyTransformer extends BaseTransformer
{
    public function transform(Replies $replies)
    {
        $return = [
            'source' => $replies->source,
            'post_id' ,
            'user_id',
            'is_blocked',
            'voteCount' => $replies->vote_count,
            'content' => $replies->body,
            'contentOriginal' => $replies->body_original,
        ];

        if ($replies->post_id) {
            $return['post'] = [
                'id' => $replies->post->id,
                'title' => $replies->post->title
            ];
        }

        if ($replies->user_id) {
            $return['user'] = [
                'id' => $replies->user->id,
                'name' => $replies->user->name,
                'avatar' => $replies->user->avatar
            ];
        }

    }
}