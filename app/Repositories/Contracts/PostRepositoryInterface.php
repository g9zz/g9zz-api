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

    /**
     * 通过hid查找内容
     * @param $hid
     * @return mixed
     */
    public function findWithHid($hid);

    /**
     * 将hid切换成id
     * @param $hid
     * @return mixed
     */
    public function changeHidToId($hid);

    /**
     * 通过id获取帖子
     * @param $id
     * @return mixed
     */
    public function getPost($id);
}