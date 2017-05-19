<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Email: ylsc633@gmail.com
 * Date: 2017/5/19
 * Time: 下午7:32
 */

namespace App\Transformers;


use App\Models\InviteCode;

class InviteCodeTransformer extends BaseTransformer
{
    public function transform(InviteCode $inviteCode)
    {
        $return = [
            'id' => $inviteCode->id,
            'status' => $inviteCode->status,
            'obsoletedAt' => isset($inviteCode->obsoleted_at) ? rfc_3339($inviteCode->obsoleted_at) : null,
            'code' => $inviteCode->code,
            'url' => env('APP_URL','http://www.g9zz.com').'/register?source='.$inviteCode->code
        ];

        if ($inviteCode->inviter_id) {
            $return['inviter'] = [
                'id' => $inviteCode->inviter->id,
                'name' => $inviteCode->inviter->name,
                'avatar' => $inviteCode->inviter->avatar
            ];
        }

        if ($inviteCode->invitee_id) {
            $return['invitee'] = [
                'id' => $inviteCode->invitee->id,
                'name' => $inviteCode->invitee->name,
                'avatar' => $inviteCode->invitee->avatar
            ];
        }

        return $return;
    }
}