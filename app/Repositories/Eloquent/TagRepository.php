<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Email: ylsc633@gmail.com
 * Date: 2017/5/11
 * Time: 下午11:56
 */

namespace App\Repositories\Eloquent;


use App\Models\Tags;
use App\Repositories\Contracts\TagRepositoryInterface;

class TagRepository extends BaseRepository implements TagRepositoryInterface
{
    public function model()
    {
        return Tags::class;
    }

    public function models()
    {
        return $this->model;
    }
}