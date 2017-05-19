<?php

/**
 * Created by PhpStorm.
 * User: zhu
 * Email: ylsc633@gmail.com
 * Date: 2017/5/18
 * Time: 下午10:47
 */

namespace App\Services;

use App\Traits\G9zzLog;
use App\Traits\Respond;

class BaseService
{
    use G9zzLog,Respond;

    public function __construct(){}
}