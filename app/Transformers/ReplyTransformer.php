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
            'hid' => $replies->hid,
            'source' => $replies->source,
//            'post_id' ,
//            'user_id',
//            'is_blocked',
//            'voteCount' => $replies->vote_count,
            'content' => $replies->body,
            'contentOriginal' => $replies->body_original,
        ];

        if ($replies->post_id) {
            $return['post'] = [
                'hid' =>  isset($replies->post->hid) ? $replies->post->hid : null,
                'title' => isset($replies->post->title) ? $replies->post->title : null,
            ];
        }

        if ($replies->user_id) {
            $return['user'] = [
                'hid' => isset($replies->user->hid) ? $replies->user->hid : null,
                'name' => isset($replies->user->name) ? $replies->user->name : null,
                'avatar' => isset($replies->user->avatar) ? $replies->user->avatar : null
            ];
        }
        return $return;
    }
}