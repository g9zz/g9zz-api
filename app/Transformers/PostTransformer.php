<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Email: ylsc633@gmail.com
 * Date: 2017/4/19
 * Time: 下午9:47
 */

namespace App\Transformers;


use App\Models\Posts;

class PostTransformer extends BaseTransformer
{
    public function transform(Posts $posts)
    {
        $return = [
            'id' => $posts->id,
            'title' => $posts->title,
            'content' => $posts->content,
            'source' => $posts->source,
//            'user_id' => $posts->user_id,
            'replyCount' => $posts->reply_count,
            'viewCount' => $posts->view_count,
            'voteCount' => $posts->vote_count,
//            'last_reply_user_id' => $posts->last_reply_user_id,
            'order' => $posts->order,
            'isTop' => $posts->is_top,
            'isExcellent' => $posts->is_excellent,
            'isBlocked' => $posts->is_blocked,
            'bodyOriginal' => $posts->body_original,
            'excerpt' => $posts->excerpt,
            'isTagged' => $posts->is_tagged,
        ];

        if ($posts->user_id) {
            $return['user'] = [
                'name' => $posts->author->name,
                'avatar' => $posts->author->avatar,
            ];
        }

        if ($posts->last_reply_user_id) {
            $return['lastReplyUser'] = [
                'name' => $posts->last_reply_user->name,
                'avatar' => $posts->last_reply_user->avatar,
            ];
        }


        return $return;
    }

}