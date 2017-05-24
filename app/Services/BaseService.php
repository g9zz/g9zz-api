<?php

/**
 * Created by PhpStorm.
 * User: zhu
 * Email: ylsc633@gmail.com
 * Date: 2017/5/18
 * Time: 下午10:47
 */

namespace App\Services;

use App\Exceptions\DataNullException;
use App\Traits\G9zzLog;
use App\Traits\Respond;
use Vinkla\Hashids\Facades\Hashids;

class BaseService
{
    use G9zzLog,Respond;

    public function __construct(){}

    /**
     * 解密hid
     * @param $hid
     * @param $connection
     * @return mixed
     */
    public function changeHidToId($hid,$connection)
    {
        $result = Hashids::connection($connection)->decode($hid);
        if (empty($result)) throw new DataNullException();
        return $result[0];
    }
}