<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Email: ylsc633@gmail.com
 * Date: 2017/5/20
 * Time: 下午11:47
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\WeiboUser
 *
 * @property int $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WeiboUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WeiboUser whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WeiboUser whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class WeiboUser extends Model
{
    protected $table = 'weibo_user';
    protected $fillable = [

    ];
}