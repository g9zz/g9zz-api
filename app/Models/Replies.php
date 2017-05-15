<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Email: ylsc633@gmail.com
 * Date: 2017/4/18
 * Time: 下午10:43
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Replies
 *
 * @property int $id
 * @property string $source 来源跟踪：iOS，Android
 * @property int $post_id 帖子ID
 * @property int $user_id 用户ID
 * @property string $is_blocked 是否block
 * @property int $vote_count 投票数
 * @property string $body 回复内容
 * @property string $body_original 回复原文
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Replies whereBody($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Replies whereBodyOriginal($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Replies whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Replies whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Replies whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Replies whereIsBlocked($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Replies wherePostId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Replies whereSource($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Replies whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Replies whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Replies whereVoteCount($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Posts $post
 * @property-read \App\Models\User $user
 */
class Replies extends Model
{
    protected $table = 'replies';
    protected $fillable = [
        'source',
        'post_id',
        'user_id',
        'is_blocked',
        'vote_count',
        'body',
        'body_original',
    ];

    public function post()
    {
        return $this->hasOne(Posts::class,'id','post_id');
    }

    public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    }

}