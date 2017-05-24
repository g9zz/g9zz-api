<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Email: ylsc633@gmail.com
 * Date: 2017/5/18
 * Time: 下午9:09
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Permissions
 *
 * @property int $id
 * @property string $name
 * @property string $display_name
 * @property string $description
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Roles[] $role
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Permissions whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Permissions whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Permissions whereDisplayName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Permissions whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Permissions whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Permissions whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Permissions extends Model
{
    protected $table = 'permissions';
    protected $fillable = [
            'name',
            'display_name',
            'description',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function role()
    {
        return $this->belongsToMany(Roles::class,'permission_role','permission_id','role_id');
    }

}