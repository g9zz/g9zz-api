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
 * App\Models\Nodes
 *
 * @property int $id
 * @property int $parent_id 父级 id
 * @property int $post_count 帖子数
 * @property bool $weight 权重
 * @property bool $level 等级
 * @property string $is_show
 * @property string $name 名称
 * @property string $slug 缩略名
 * @property string $description 描述
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Nodes whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Nodes whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Nodes whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Nodes whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Nodes whereIsShow($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Nodes whereLevel($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Nodes whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Nodes whereParentId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Nodes wherePostCount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Nodes whereSlug($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Nodes whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Nodes whereWeight($value)
 * @mixin \Eloquent
 */
class Nodes extends Model
{
    protected $table = 'nodes';
    protected $fillable = [
        'parent_id',
        'post_count',
        'weight',
        'level',
        'is_show',
        'name',
        'slug',
        'description',
    ];
}