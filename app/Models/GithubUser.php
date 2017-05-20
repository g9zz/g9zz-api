<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Email: ylsc633@gmail.com
 * Date: 2017/5/20
 * Time: 下午11:39
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\GithubUser
 *
 * @property int $id
 * @property int $github_id github的ID
 * @property string $nickname 昵称
 * @property string $name 用户名
 * @property string $email 邮箱
 * @property string $avatar 头像
 * @property int $gravatar_id
 * @property string $url github的api地址
 * @property string $html_url github地址
 * @property string $type 类型
 * @property string $site_admin
 * @property string $company
 * @property string $blog
 * @property string $location
 * @property string $hireable
 * @property string $bio
 * @property int $public_repos
 * @property int $public_gists
 * @property int $followers
 * @property string $github_created_at
 * @property string $github_updated_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GithubUser whereAvatar($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GithubUser whereBio($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GithubUser whereBlog($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GithubUser whereCompany($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GithubUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GithubUser whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GithubUser whereFollowers($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GithubUser whereGithubCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GithubUser whereGithubId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GithubUser whereGithubUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GithubUser whereGravatarId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GithubUser whereHireable($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GithubUser whereHtmlUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GithubUser whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GithubUser whereLocation($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GithubUser whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GithubUser whereNickname($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GithubUser wherePublicGists($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GithubUser wherePublicRepos($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GithubUser whereSiteAdmin($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GithubUser whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GithubUser whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GithubUser whereUrl($value)
 * @mixin \Eloquent
 */
class GithubUser extends Model
{
    protected $table = 'github_user';
    protected $fillable = [
        'github_id',
        'nickname',
        'name',
        'email',
        'avatar',
        'gravatar_id',
        'url',
        'html_url',
        'type',
        'site_admin',
        'company',
        'blog',
        'location',
        'hireable',
        'bio',
        'public_repos',
        'public_gists',
        'followers',
        'github_created_at',
        'github_updated_at',
    ];

    public function user()
    {
        return $this->hasOne(User::class,'github_id','id');
    }
}