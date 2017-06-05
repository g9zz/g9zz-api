<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Email: ylsc633@gmail.com
 * Date: 2017/4/19
 * Time: 下午9:39
 */

namespace App\Services\Console;


use App\Exceptions\DataNullException;
use App\Exceptions\TryException;
use App\Repositories\Contracts\PostRepositoryInterface;
use App\Services\BaseService;
use HyperDown\Parser;
use Vinkla\Hashids\Facades\Hashids;

class PostService extends BaseService
{
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
     * @param $hid
     * @return mixed
     */
    public function find($hid)
    {
        return $this->postRepository->find($hid);
    }

    /**
     * @param $hid
     * @return mixed
     */
    public function delete($hid)
    {
        return $this->postRepository->delete($hid);
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

        $create['user_id'] = $request->get('g9zz_user_id');//TODO::需要修改
        $parser = new Parser();
        $create['content'] = $parser->makeHtml($create['body_original']);
        $this->log('service.request to '.__METHOD__,['create' => $create]);
        try {
            \DB::beginTransaction();
            $result = $this->postRepository->create($create);
            $update['hid'] = Hashids::connection('post')->encode($result->id);
            $this->log('service.request to '.__METHOD__,['update' => $update]);
            $this->postRepository->update($update,$result->id);
            \DB::commit();
        } catch (\Exception $e) {
            $this->log('"service.error" to listener "' . __METHOD__ . '".', ['message' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile()]);
            \DB::rollBack();
            throw new TryException(json_encode($e->getMessage()),(int)$e->getCode());
        }

        return $this->postRepository->find($update['hid']);
    }

    /**
     * @param $request
     * @param $hid
     * @return mixed
     */
    public function update($request,$hid)
    {
        $update = [
            'title' => $request->get('title'),
            'body_original' => $request->get('content')
        ];
        $parser = new Parser();
        $update['content'] = $parser->makeHtml($update['body_original']);
        if (!empty($request->get('isTop'))) $update['is_top'] = $request->get('isTop')== 'yes' ? 'yes' :'no';

        return $this->postRepository->update($update,$hid);
    }


}