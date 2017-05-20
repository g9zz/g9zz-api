<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Email: ylsc633@gmail.com
 * Date: 2017/5/21
 * Time: 上午12:07
 */

namespace App\Services\Auth;


use App\Exceptions\TryException;
use App\Repositories\Contracts\InviteCodeRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Services\BaseService;
use Hashids\Hashids;

class UserService extends BaseService
{

    protected $userRepository;
    protected $hashids;
    protected $isInvite;
    protected $inviteCodeRepository;
    public function __construct(UserRepositoryInterface $userRepository,
                                Hashids $hashids,
                                InviteCodeRepositoryInterface $inviteCodeRepository)
    {
        $this->userRepository = $userRepository;
        $this->hashids = $hashids;
        $this->isInvite = config('g9zz.invite_code.is_invite');
        $this->inviteCodeRepository = $inviteCodeRepository;
    }

    /**
     * @param $create
     * @return mixed
     */
    public function create($create)
    {
        return $this->userRepository->create($create);
    }

    /**
     * @param $update
     * @param $id
     * @return mixed
     */
    public function update($update,$id)
    {
        return $this->userRepository->update($update,$id);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->userRepository->find($id);
    }

    /**
     * @param $create
     * @param $other
     * @return mixed
     */
    public function loginCreate($create,$other)
    {
        $this->log('service.request to '.__METHOD__,['create' => $create]);

        try {
            \DB::beginTransaction();
            $user = $this->userRepository->create($create);
            $update['hid'] = $this->hashids->encode($user->id);
            $this->log('service.request to '.__METHOD__,['user_update' => $update]);
            $this->userRepository->update($update,$user->id);

            if ($this->isInvite) {
                $inviteCode = $this->inviteCodeRepository->getInviteCodeByCode($other['invite_code']);
                if (empty($inviteCode)) {
                    $this->setCode(config('validation.validation.register')['inviteCode.exists']);
                    return $this->response();
                }
                $inviteCodeUpdate = [
                    'status' => 'used',
                    'invitee_id' => $user->id,
                    'obsoleted_at' => date('Y-m-d H:i:s',time()),
                ];
                $this->log('service.request to '.__METHOD__,['invite_code_update' => $inviteCodeUpdate]);
                $this->inviteCodeRepository->update($inviteCodeUpdate,$inviteCode->id);
            }

            $result = $this->userRepository->find($user->id);
            \DB::commit();
        } catch (\Exception $e) {
            $this->log('"service.error" to listener "' . __METHOD__ . '".', ['message' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile()]);
            \DB::rollBack();
            throw new TryException(json_encode($e->getMessage()),(int)$e->getCode());
        }
        return $result;
    }


    public function checkIsGithub($githubId)
    {
        $github = $this->userRepository->getGithub($githubId);

    }
}