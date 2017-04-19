<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Date: 2017/4/12
 * Time: 下午4:42
 */

namespace App\Repositories\Eloquent;


use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function model()
    {
        return User::class;
    }
}