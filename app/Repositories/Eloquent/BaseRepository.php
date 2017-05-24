<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Date: 2017/4/12
 * Time: 下午3:28
 */

namespace App\Repositories\Eloquent;


use App\Exceptions\DataNullException;
use Bosnadev\Repositories\Eloquent\Repository;

abstract class BaseRepository extends Repository
{
    public function find($id, $columns = array('*'))
    {
        $result = parent::find($id, $columns);
         if (empty($result) ){
             throw new DataNullException();
         } else {
             return $result;
         }
    }

    public function delete($id)
    {
        $this->find($id);
        return parent::delete($id);
    }

}