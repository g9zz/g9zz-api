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
 * App\Models\Tags
 *
 * @property int $id
 * @property string $name 标签名(英文)
 * @property string $display_name 标签名(汉字)
 * @property string $description 描述
 * @property int $post_count 帖子数
 * @property bool $weight 权重
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Tags whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Tags whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Tags whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Tags whereDisplayName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Tags whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Tags whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Tags wherePostCount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Tags whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Tags whereWeight($value)
 * @mixin \Eloquent
 */
class Tags extends Model
{
    protected $table = 'tags';
    protected $fillable = [
        'name',
        'display_name',
        'description',
        'post_count',
        'weight',
    ];
}