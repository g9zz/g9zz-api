<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Email: ylsc633@gmail.com
 * Date: 2017/4/19
 * Time: 下午9:40
 */

namespace App\Repositories\Contracts;


interface PostRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * @return mixed
     */
    public function models();
}