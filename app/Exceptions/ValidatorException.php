<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Email: ylsc633@gmail.com
 * Date: 2017/4/18
 * Time: 下午10:39
 */

namespace App\Exceptions;

use Throwable;

class ValidatorException extends \Exception
{
    public function __construct( $code = 0,$message = "", Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}