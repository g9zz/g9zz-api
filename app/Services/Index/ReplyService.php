<?php

/**
 * Created by PhpStorm.
 * User: zhu
 * Email: ylsc633@gmail.com
 * Date: 2017/5/14
 * Time: 上午1:43
 */
namespace App\Services\Index;

use App\Exceptions\TryException;
use App\Repositories\Contracts\ReplyRepositoryInterface;
use App\Services\BaseService;
use HyperDown\Parser;
use Vinkla\Hashids\Facades\Hashids;

class ReplyService extends BaseService
{

    public $replyRepository;

    public function __construct(ReplyRepositoryInterface $replyRepository)
    {
        $this->replyRepository = $replyRepository;
    }

    /**
     * @return mixed
     */
    public function paginate()
    {
        return $this->replyRepository->paginate(per_page());
    }

    /**
     * @param $request
     * @return mixed
     */
    public function store($request)
    {
        $create = [
//            'source',
            'post_id' => parent::changeHidToId($request->get('postId'),'post'),
            'user_id' => $request->get('g9zz_user_id'),//TODO::修改为登录者的id
//            'is_blocked',
//            'vote_count',
//            'body' ,
            'body_original' => $request->get('content'),
        ];

        $parse = new Parser();
        $body = $parse->makeHtml($create['body_original']);
        $create['body'] = $body;
        try {
            \DB::beginTransaction();
            $result = $this->replyRepository->create($create);
            $update['hid'] = Hashids::connection('reply')->encode($result->id);
            $this->replyRepository->update($update,$result->id);
            \DB::commit();
        } catch (\Exception $e) {
            $this->log('"service.error" to listener "' . __METHOD__ . '".', ['message' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile()]);
            \DB::rollBack();
            throw new TryException(json_encode($e->getMessage()),(int)$e->getCode());
        }
        return $this->replyRepository->find($result->id);
    }

    /**
     * @param $hid
     * @return mixed
     */
    public function find($hid)
    {
        $id = parent::changeHidToId($hid,'reply');
        return $this->replyRepository->find($id);
    }

    /**
     * @param $request
     * @param $hid
     * @return mixed
     */
    public function update($request,$hid)
    {
        $id = parent::changeHidToId($hid,'reply');
        $update = [
            'body_original' => $request->get('content'),
        ];
        $parse = new Parser();
        $update['body'] = $parse->makeHtml($update['body_original']);
        return $this->replyRepository->update($update,$id);
    }

    /**
     * @param $hid
     * @return mixed
     */
    public function delete($hid)
    {
        $id = parent::changeHidToId($hid,'reply');
        return $this->replyRepository->delete($id);
    }
}