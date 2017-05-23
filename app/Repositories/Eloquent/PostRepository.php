<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Email: ylsc633@gmail.com
 * Date: 2017/4/19
 * Time: 下午9:41
 */

namespace App\Repositories\Eloquent;


use App\Exceptions\DataNullException;
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

    /**
     * 通过HID查找内容
     * @param $hid
     * @return mixed
     */
    public function findWithHid($hid)
    {
        return $this->model->whereHid($hid)->first();
    }

    /**
     * 将hid切换成id
     * @param $hid
     * @return mixed
     */
    public function changeHidToId($hid)
    {
        $result = $this->findWithHid($hid);
        if (empty($result)) throw  new DataNullException();
        return $result->id;
    }

    /**
     * 通过id获取帖子相关
     * @param $id
     * @return mixed
     */
    public function getPost($id)
    {
        return $this->model->with(['tag'])
            ->with(['node'])
            ->with(['reply'])
            ->with(['postscript'])
            ->find($id);
    }
}