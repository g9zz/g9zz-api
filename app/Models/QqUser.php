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
 * App\Models\QqUser
 *
 * @property int $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\QqUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\QqUser whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\QqUser whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class QqUser extends Model
{
    protected $table = 'qq_user';
    protected $fillable = [

    ];
}