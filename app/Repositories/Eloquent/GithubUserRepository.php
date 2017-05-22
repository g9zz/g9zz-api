<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Email: ylsc633@gmail.com
 * Date: 2017/5/22
 * Time: 下午11:45
 */

namespace App\Repositories\Eloquent;


use App\Models\GithubUser;
use App\Repositories\Contracts\GithubUserRepositoryInterface;

class GithubUserRepository extends BaseRepository implements GithubUserRepositoryInterface
{
    public function model()
    {
        return GithubUser::class;
    }

    /**
     * 通过github的id获取github_user表
     * @param $githubId
     * @return mixed
     */
    public function getGithub($githubId)
    {
        return $this->model->where('github_id',$githubId)->first();
    }
}