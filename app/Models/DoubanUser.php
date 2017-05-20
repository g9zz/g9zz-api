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
 * App\Models\DoubanUser
 *
 * @property int $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\DoubanUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\DoubanUser whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\DoubanUser whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class DoubanUser extends Model
{
    protected $table = 'douban_user';
    protected $fillable = [

    ];
}