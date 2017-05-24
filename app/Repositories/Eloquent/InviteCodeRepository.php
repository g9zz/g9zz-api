<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Email: ylsc633@gmail.com
 * Date: 2017/5/19
 * Time: 下午7:24
 */

namespace App\Repositories\Eloquent;


use App\Models\InviteCode;
use App\Repositories\Contracts\InviteCodeRepositoryInterface;

class InviteCodeRepository extends BaseRepository implements InviteCodeRepositoryInterface
{
    public function model()
    {
        return InviteCode::class;
    }

    public function models()
    {
        return $this->model;
    }

    /**
     * @param $authId
     * @return mixed
     */
    public function getNumByAuthId($authId)
    {
        return $this->model->where('inviter_id',$authId)->count();
    }

    /**
     * 通过 邀请人获取该人的所有邀请码
     * @param $inviterId
     * @return mixed
     */
    public function getAllCodeByInviterId($inviterId)
    {
        return $this->model->where('inviter_id',$inviterId)->get();
    }

    /**
     * 通过邀请码获取对应信息
     * @param $code
     * @return mixed
     */
    public function getInviteCodeByCode($code)
    {
        return $this->model->where('code',$code)->first();
    }
}