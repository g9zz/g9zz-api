<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Email: ylsc633@gmail.com
 * Date: 2017/4/19
 * Time: 下午9:41
 */

namespace App\Repositories\Eloquent;


use App\Models\Posts;
use App\Repositories\Contracts\PostRepositoryInterface;

class PostRepository extends BaseRepository implements PostRepositoryInterface
{
    public function model()
    {
        return Posts::class;
    }

    /**
     * @return mixed
     */
    public function models()
    {
        return $this->model;
    }
}