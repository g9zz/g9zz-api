<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Email: ylsc633@gmail.com
 * Date: 2017/5/18
 * Time: 下午9:17
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Roles
 *
 * @property int $id
 * @property string $name
 * @property string $display_name
 * @property string $description
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Roles whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Roles whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Roles whereDisplayName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Roles whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Roles whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Roles whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Permissions[] $permission
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $user
 */
class Roles extends Model
{
    protected $table = 'roles';
    protected $fillable = [
        'name',
        'display_name',
        'description',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function user()
    {
        return $this->belongsToMany(User::class,'role_user','role_id','user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permission()
    {
        return $this->belongsToMany(Permissions::class,'permission_role','role_id','permission_id');
    }

}