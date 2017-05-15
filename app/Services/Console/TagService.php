<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Email: ylsc633@gmail.com
 * Date: 2017/5/11
 * Time: 下午11:54
 */

namespace App\Services\Console;


use App\Repositories\Contracts\TagRepositoryInterface;
use App\Traits\G9zzLog;

class TagService
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
        return $this->tagRepository->create($create);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->tagRepository->find($id);
    }

    /**
     * @param $request
     * @param $id
     * @return mixed
     */
    public function update($request,$id)
    {
        $update = parse_input($request->only(['weight','name','displayName','description']));
        $this->log('service.request to '.__METHOD__,['update' => $update]);
        return $this->tagRepository->update($update,$id);
    }

    public function delete($id)
    {
        return $this->tagRepository->delete($id);
    }
}