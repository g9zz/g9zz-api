<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Email: ylsc633@gmail.com
 * Date: 2017/5/19
 * Time: 下午7:23
 */

namespace App\Repositories\Contracts;


interface InviteCodeRepositoryInterface extends BaseRepositoryInterface
{
    public function models();

    /**
     * 获取邀请人有多少个邀请码了
     * @param $authId
     * @return mixed
     */
    public function getNumByAuthId($authId);

    /**
     * 通过邀请人获取这人所有的邀请码
     * @param $inviterId
     * @return mixed
     */
    public function getAllCodeByInviterId($inviterId);

    /**
     * 通过邀请码获取对应信息
     * @param $code
     * @return mixed
     */
    public function getInviteCodeByCode($code);
}