<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Email: ylsc633@gmail.com
 * Date: 2017/5/20
 * Time: 下午11:46
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\WechatUser
 *
 * @property int $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WechatUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WechatUser whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WechatUser whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class WechatUser extends Model
{
    protected $table = 'wechat_user';
    protected $fillable = [

    ];
}