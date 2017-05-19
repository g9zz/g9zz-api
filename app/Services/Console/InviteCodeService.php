<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Email: ylsc633@gmail.com
 * Date: 2017/5/19
 * Time: 下午7:20
 */

namespace App\Services\Console;


use App\Repositories\Contracts\InviteCodeRepositoryInterface;
use App\Services\BaseService;
use Faker\Provider\Uuid;

class InviteCodeService extends BaseService
{
    protected $inviteCodeRepository;
    public function __construct(InviteCodeRepositoryInterface $inviteCodeRepository)
    {
        $this->inviteCodeRepository = $inviteCodeRepository;
    }

    /**
     * @param $request
     * @return mixed
     */
    public function paginate($request)
    {
        $status = $request->get('status');
        $query = $this->inviteCodeRepository->models();
        if (!empty($status)) {
            $query = $query->where('status',$status);
        }

        $orderId = $request->get('orderId');
        $orderId = $orderId == 'desc' || $orderId == 'asc' ? $orderId : '';
        if (!empty($orderId)) {
            $query = $query->orderBy('id',$orderId);
        }
        return $query->paginate(per_page());
    }


    /**
     * @return mixed
     */
    public function store()
    {
        $authId = 1;//TODO::修改成登录这个人的ID
        $maxNum = config('g9zz.invite_code.max_num');
        $hasNum = $this->inviteCodeRepository->getNumByAuthId($authId);//return int
        if ($hasNum >= $maxNum) {
            $this->setCode(config('validation.validation.invite_code')['max.num']);
            return $this->response();
        }

        $create = [
            'inviter_id' => $authId,
            'code' =>   Uuid::uuid(),
            'status' => 'created'
        ];
        $this->log('service.request to '.__METHOD__,['create' => $create]);
        return $this->inviteCodeRepository->create($create);
    }

    public function getAllCode()
    {
        $authId = 1;//TODO::修改成登录这个人的ID
        return $this->inviteCodeRepository->getAllCodeByInviterId($authId);
    }
}