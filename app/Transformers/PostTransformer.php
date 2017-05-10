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
        if ($posts->tag) {
            foreach ($posts->tag as $item) {
                $return['tag'][] = [
                    'name' => $item->name,
                    'displayName' => $item->display_name,
                    'description' => $item->description,
//                    'post_count' => $item->post_count,
                    'weight' => $item->weight,
                ];
            }
        }

        if ($posts->node) {
            foreach ($posts->node as $value) {
                $return['node'][] = [
                    'name' => $value->name,
                    'slug' => $value->slug,
                    'description' => $value->description,
                ];
            }
        }

        if ($posts->reply) {
            foreach ($posts->reply as $item) {
                $return['reply'] = [
                    'source' => $item->source,
                    'isBlocked' => $item->is_blocked,
                    'voteCount' => $item->vote_count,
                    'body' => $item->body,
                    'bodyOriginal' => $item->body_original,
                    'createdAt' => $item->created_at,
                ];
            }
        }

        if ($posts->postscript) {
            foreach ($posts->postscript as $item) {
                $return['reply'] = [
                    'content' => $item->content,
                    'contentOriginal' => $item->content_original,
                    'createdAt' => $item->created_at,
                ];
            }
        }

        return $return;
    }

}