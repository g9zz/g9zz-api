<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Email: ylsc633@gmail.com
 * Date: 2017/4/23
 * Time: 上午4:05
 */

namespace App\Repositories\Eloquent;


use App\Models\Nodes;
use App\Repositories\Contracts\NodeRepositoryInterface;

class NodeRepository extends BaseRepository implements NodeRepositoryInterface
{
    public function model()
    {
        return Nodes::class;
    }
}