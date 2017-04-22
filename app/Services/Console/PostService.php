<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Email: ylsc633@gmail.com
 * Date: 2017/4/19
 * Time: 下午9:39
 */

namespace App\Services\Console;


use App\Repositories\Contracts\PostRepositoryInterface;

class PostService
{
    protected $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function paginate($request)
    {
        if (empty($request)) {
            return $this->postRepository->paginate(per_page());
        }
        $request['replyCount']= $this->order($request,'replyCount');
        $request['viewCount']= $this->order($request,'viewCount');
        $request['voteCount']= $this->order($request,'voteCount');
        $request['isTop']= $this->order($request,'isTop');
        $request['isExcellent']= $this->order($request,'isExcellent');
        $request['isBlocked']= $this->order($request,'isBlocked');
        $request['isTagged']= $this->order($request,'isTagged');

        $query = $this->postRepository->models();
        $query = $this->allOrderBy($request,$query,'replyCount');
        $query = $this->allOrderBy($request,$query,'viewCount');
        $query = $this->allOrderBy($request,$query,'voteCount');
        $query = $this->allOrderBy($request,$query,'isTop');
        $query = $this->allOrderBy($request,$query,'isExcellent');
        $query = $this->allOrderBy($request,$query,'isBlocked');
        $query = $this->allOrderBy($request,$query,'isTagged');

        return $query->paginate(per_page());

    }

    /**
     * repository排序
     * @param $request
     * @param $query
     * @param $key
     * @return mixed
     */
    public function allOrderBy($request,$query,$key)
    {
        if (!empty($request[$key])) {
            $query = $query->orderBy(string_parse_input($key),$request[$key]);
        }
        return $query;
    }

    /**
     * 排序
     * @param $request
     * @param $key
     * @return null
     */
    public function order($request,$key)
    {
        if (isset($request[$key])) {
            if ($request[$key] == 'desc' || $request[$key] == 'asc') {
                return $request[$key];
            } else {
                return null;
            }
        } else {
            return null;
        }

    }

    public function find($id)
    {
        return $this->postRepository
            ->with(['tag'])
            ->with(['node'])
            ->with(['reply'])
            ->with(['postscript'])
            ->find($id);
    }

}