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
         if (empty(parent::find($id, $columns)) ){
             throw new DataNullException();
         } else {
             return parent::find($id,$columns);
         }
    }
}