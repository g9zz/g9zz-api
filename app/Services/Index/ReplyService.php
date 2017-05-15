<?php

/**
 * Created by PhpStorm.
 * User: zhu
 * Email: ylsc633@gmail.com
 * Date: 2017/5/14
 * Time: 上午1:43
 */
namespace App\Services\Index;

use App\Repositories\Contracts\ReplyRepositoryInterface;
use App\Traits\G9zzLog;

class ReplyService
{
    use G9zzLog;

    public $replyRepository;

    public function __construct(ReplyRepositoryInterface $replyRepository)
    {
        $this->replyRepository = $replyRepository;
    }

    public function paginate()
    {
        return $this->replyRepository->paginate(per_page());
    }



}