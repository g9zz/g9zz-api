<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Email: ylsc633@gmail.com
 * Date: 2017/5/16
 * Time: 下午10:30
 */

namespace App\Services\Index;


use App\Repositories\Contracts\AppendRepositoryInterface;
use App\Repositories\Contracts\PostRepositoryInterface;
use App\Traits\G9zzLog;
use App\Traits\Respond;
use HyperDown\Parser;

class AppendService
{
    use G9zzLog,Respond;

    protected $appendRepository;
    protected $postRepository;
    public function __construct(AppendRepositoryInterface $appendRepository,
                                PostRepositoryInterface $postRepository)
    {
        $this->appendRepository = $appendRepository;
        $this->postRepository = $postRepository;
    }

    /**
     * @return mixed
     */
    public function paginate()
    {
        return $this->appendRepository->paginate(per_page());
    }

    /**
     * @param $request
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function store($request)
    {
        $content = $request->get('content');
        $create['content_original'] = $content;
        $parse = new Parser();
        $create['content'] = $parse->makeHtml($content);

        $authId = 1;//TODO::登录者的ID
        $postId = $request->get('postId');
        $post = $this->postRepository->find($postId);
        if ($post->user_id != $authId) {
            $this->setCode(config('validation.validation.append')['isNot.author']);
            return $this->response();
        }

        $appends = $this->appendRepository->getAppendCountByPostId($postId);
        $maxAppends = config('g9zz.append.max_count');
        if ($appends > $maxAppends) {
            $this->setCode(config('validation.validation.append')['max.count']);
            return $this->response();
        }
        $create['topic_id'] = $postId;
        $this->log('service.request to '.__METHOD__,['create' => $create]);
        return $this->appendRepository->create($create);
    }
}