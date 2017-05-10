<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Email: ylsc633@gmail.com
 * Date: 2017/5/10
 * Time: 下午8:16
 */

namespace App\Exceptions;


use Mockery\Exception;
use Throwable;

class CodeException extends Exception
{
    public function __construct($code = 0,$message = "",  Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}