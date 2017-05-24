<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Email: ylsc633@gmail.com
 * Date: 2017/5/22
 * Time: 下午11:44
 */

namespace App\Repositories\Contracts;


interface GithubUserRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * 通过github的id获取github_user表
     * @param $githubId
     * @return mixed
     */
    public function getGithub($githubId);

}