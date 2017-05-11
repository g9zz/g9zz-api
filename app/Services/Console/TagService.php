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

class TagService
{

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

}