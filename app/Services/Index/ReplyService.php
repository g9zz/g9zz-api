<?php

/**
 * Created by PhpStorm.
 * User: zhu
 * Email: ylsc633@gmail.com
 * Date: 2017/5/14
 * Time: 上午1:43
 */
namespace App\Services\Index;

use App\Repositories\Contracts\ReplyRepositoryInterface;
use App\Traits\G9zzLog;
use HyperDown\Parser;

class ReplyService
{
    use G9zzLog;

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
            'post_id' => $request->get('postId'),
            'user_id' => 2,//TODO::修改为登录者的id
//            'is_blocked',
//            'vote_count',
//            'body' ,
            'body_original' => $request->get('content'),
        ];

        $parse = new Parser();
        $body = $parse->makeHtml($create['body_original']);
        $create['body'] = $body;

        return $this->replyRepository->create($create);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->replyRepository->find($id);
    }

    /**
     * @param $request
     * @param $id
     * @return mixed
     */
    public function update($request,$id)
    {
        $update = [
            'body_original' => $request->get('content'),
        ];
        $parse = new Parser();
        $update['body'] = $parse->makeHtml($update['body_original']);
        return $this->replyRepository->update($update,$id);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->replyRepository->delete($id);
    }
}