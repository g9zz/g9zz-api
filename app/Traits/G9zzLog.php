<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Email: ylsc633@gmail.com
 * Date: 2017/4/19
 * Time: 下午11:05
 */

namespace App\Traits;



use Faker\Provider\Uuid;
use Request;

trait G9zzLog
{
    protected $request;
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function log($message, $context = array())
    {
        //TODO:修改request
        if ($this->request) {
            $client = $this->request->offsetGet('client');
            if (! isset($client['requestId'])) {
                $client['requestId'] = Uuid::uuid();
            }
            $context = array($context, $client);
        }

        return \Log::info($message, $context);
    }
}