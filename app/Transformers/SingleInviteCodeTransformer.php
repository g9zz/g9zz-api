<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Email: ylsc633@gmail.com
 * Date: 2017/5/19
 * Time: 下午10:43
 */

namespace App\Transformers;


use App\Models\InviteCode;

class SingleInviteCodeTransformer extends BaseTransformer
{
    public function transform(InviteCode $inviteCode)
    {
        return [
            'url' => env('APP_URL','http://www.g9zz.com').'/register?source='.$inviteCode->code
        ];
    }
}