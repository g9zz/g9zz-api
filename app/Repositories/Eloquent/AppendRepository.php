<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Email: ylsc633@gmail.com
 * Date: 2017/5/16
 * Time: 下午10:31
 */

namespace App\Repositories\Eloquent;


use App\Models\Appends;
use App\Repositories\Contracts\AppendRepositoryInterface;

class AppendRepository extends BaseRepository implements AppendRepositoryInterface
{
    public function model()
    {
        return Appends::class;
    }

    /**
     * 通过帖子ID获取该帖子附言个数
     * @param $postId
     * @return mixed
     */
    public function getAppendCountByPostId($postId)
    {
        return $this->model->where('topic_id',$postId)->count();
    }
}