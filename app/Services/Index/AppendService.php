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

class AppendService
{
    protected $appendRepository;
    public function __construct(AppendRepositoryInterface $appendRepository)
    {
        $this->appendRepository = $appendRepository;
    }

    /**
     * @return mixed
     */
    public function paginate()
    {
        return $this->appendRepository->paginate(per_page());
    }
}