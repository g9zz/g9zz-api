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
use App\Traits\G9zzLog;
use HyperDown\Parser;

class PostService
{
    use G9zzLog;
    protected $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    /**
     * 分页
     * @param $request
     * @return mixed
     */
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

    /**
     * 查找帖子
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->postRepository
            ->with(['tag'])
            ->with(['node'])
            ->with(['reply'])
            ->with(['postscript'])
            ->find($id);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->postRepository->delete($id);
    }

    /**
     * @param $request
     * @return mixed
     */
    public function store($request)
    {
        $create = [
            'title' => $request->get('title'),
            'body_original' => $request->get('content')
        ];
        if (!empty($request->get('isTop'))) $create['is_top'] = $request->get('isTop')== 'yes' ? 'yes' :'no';

        $parser = new Parser();
        $create['content'] = $parser->makeHtml($create['body_original']);
        $this->log('service.request to '.__METHOD__,['create' => $create]);
        return $this->postRepository->create($create);
    }

    /**
     * @param $request
     * @param $id
     * @return mixed
     */
    public function update($request,$id)
    {
        $update = [
            'title' => $request->get('title'),
            'body_original' => $request->get('content')
        ];
        $parser = new Parser();
        $update['content'] = $parser->makeHtml($update['body_original']);
        if (!empty($request->get('isTop'))) $update['is_top'] = $request->get('isTop')== 'yes' ? 'yes' :'no';

        return $this->postRepository->update($update,$id);
    }


}