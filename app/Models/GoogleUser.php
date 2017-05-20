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
 * App\Models\GoogleUser
 *
 * @property int $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GoogleUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GoogleUser whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GoogleUser whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class GoogleUser extends Model
{
    protected $table = 'google_user';
    protected $fillable = [

    ];
}