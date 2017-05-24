<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Email: ylsc633@gmail.com
 * Date: 2017/5/16
 * Time: 下午10:30
 */

namespace App\Services\Index;


use App\Exceptions\TryException;
use App\Repositories\Contracts\AppendRepositoryInterface;
use App\Repositories\Contracts\PostRepositoryInterface;
use App\Services\BaseService;
use HyperDown\Parser;
use Vinkla\Hashids\Facades\Hashids;

class AppendService extends BaseService
{

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

        $authId = $request->get('g9zz_user_id');//TODO::登录者的ID
        $postHid = $request->get('postHid');
        $postId = parent::changeHidToId($postHid,'post');
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

        try {
            \DB::beginTransaction();
            $result = $this->appendRepository->create($create);
            $this->log('"service.request" to listener "' . __METHOD__ . '".', ['create' => $create]);
            $update['hid'] = Hashids::connection('append')->encode($result->id);
            $this->log('"service.request" to listener "' . __METHOD__ . '".', ['update' => $update]);
            $this->appendRepository->update($update,$result->id);
            \DB::commit();
        } catch (\Exception $e) {
            $this->log('"service.error" to listener "' . __METHOD__ . '".', ['message' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile()]);
            \DB::rollBack();
            throw new TryException(json_encode($e->getMessage()),(int)$e->getCode());
        }

        return $this->appendRepository->find($result->id);
    }

    /**
     * @param $hid
     * @return mixed
     */
    public function find($hid)
    {
        $appendId = parent::changeHidToId($hid,'append');
        return $this->appendRepository->find($appendId);
    }

    /**
     * @param $hid
     * @return mixed
     */
    public function delete($hid)
    {
        $appendId = parent::changeHidToId($hid,'append');
        return $this->appendRepository->delete($appendId);
    }

}