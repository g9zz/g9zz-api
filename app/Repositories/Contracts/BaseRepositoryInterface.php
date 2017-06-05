<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Date: 2017/4/12
 * Time: 下午3:27
 */

namespace App\Repositories\Contracts;

use Bosnadev\Repositories\Contracts\RepositoryInterface as Repository;

interface BaseRepositoryInterface extends Repository
{
    public function find($hid, $columns = array('*'));

    public function update(array $data, $hid);

    public function delete($hid);
}