<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Email: ylsc633@gmail.com
 * Date: 2017/5/14
 * Time: 上午1:46
 */

namespace App\Repositories\Eloquent;


use App\Models\Replies;
use App\Repositories\Contracts\ReplyRepositoryInterface;

class ReplyRepository extends BaseRepository implements ReplyRepositoryInterface
{
    public function model()
    {
        return Replies::class;
    }
}