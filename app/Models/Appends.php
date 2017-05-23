<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Email: ylsc633@gmail.com
 * Date: 2017/4/18
 * Time: 下午10:44
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Appends
 *
 * @property int $id
 * @property string $content 帖子附言内容
 * @property string $content_original 附言原文
 * @property int $topic_id 帖子ID
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Appends whereContent($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Appends whereContentOriginal($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Appends whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Appends whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Appends whereTopicId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Appends whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Posts $post
 * @property string $hid 加密ID
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Appends whereHid($value)
 */
class Appends extends Model
{
    protected $table = 'appends';
    protected $fillable = [
        'hid',
        'content',
        'content_original',
        'topic_id',
    ];

    public function post()
    {
        return $this->hasOne(Posts::class,'id','topic_id');
    }
}