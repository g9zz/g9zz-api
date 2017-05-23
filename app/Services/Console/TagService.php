<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Email: ylsc633@gmail.com
 * Date: 2017/5/11
 * Time: 下午11:54
 */

namespace App\Services\Console;


use App\Exceptions\TryException;
use App\Repositories\Contracts\TagRepositoryInterface;
use App\Services\BaseService;
use App\Traits\G9zzLog;
use Vinkla\Hashids\Facades\Hashids;

class TagService extends BaseService
{
    use G9zzLog;

    protected $tagRepository;

    public function __construct(TagRepositoryInterface $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    /**
     * @param $page
     * @param lluminate\Http\Request
     * @return mixed
     */
    public function paginate($page,$request)
    {
        $query = $this->tagRepository->models();

        $postCount = $request->get('cOrder');
        if (!empty($postCount)) {
            $postCount = $postCount == 'desc' ? 'desc' : 'asc';
            $query = $query->orderBy('post_count',$postCount);
        }

        $weightOrder = $request->get('wOrder');
        if (!empty($weightOrder)) {
            $weightOrder = $weightOrder == 'desc' ? 'desc' : 'asc';
            $query = $query->orderBy('weight',$weightOrder);
        }

        return $query->paginate($page);
    }

    /**
     * @param $request
     * @return mixed
     */
    public function store($request)
    {
        $create = [
            "name" => $request->get('name'),
            "display_name" => $request->get('displayName'),
            "description" => $request->get('description'),
            "weight" => $request->get('weight'),
        ];

        $this->log('service.request to '.__METHOD__,['create' => $create]);
        $create['post_count'] = 0;
        try {
            \DB::beginTransaction();
            $result = $this->tagRepository->create($create);
            $update['hid'] = Hashids::connection('tag')->encode($result->id);
            $this->tagRepository->update($update,$result->id);
            \DB::commit();
        } catch (\Exception $e) {
            $this->log('"service.error" to listener "' . __METHOD__ . '".', ['message' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile()]);
            \DB::rollBack();
            throw new TryException(json_encode($e->getMessage()),(int)$e->getCode());
        }

        return $this->tagRepository->find($result->id);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        $id = parent::changeHidToId($id,'tag');
        return $this->tagRepository->find($id);
    }

    /**
     * @param $request
     * @param $id
     * @return mixed
     */
    public function update($request,$id)
    {
        $id = parent::changeHidToId($id,'tag');
        $update = parse_input($request->only(['weight','name','displayName','description']));
        $this->log('service.request to '.__METHOD__,['update' => $update]);
        return $this->tagRepository->update($update,$id);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        $id = parent::changeHidToId($id,'tag');
        return $this->tagRepository->delete($id);
    }
}