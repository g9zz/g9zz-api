<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Email: ylsc633@gmail.com
 * Date: 2017/4/12
 * Time: 下午5:27
 */

namespace App\Traits;


use Dotenv\Exception\ValidationException;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use Psy\Util\Json;

trait Respond
{
    public $code = 200;

    public $data;

    public $status = 200;

    public function setCode($code)
    {
        $this->code = $code;
    }

    public function setData($data)
    {
        return $this->data = $data;
    }

    public function getData()
    {
        return $this->data;
    }

    public function getErrorCode()
    {
        return $this->code;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function response()
    {
        $status = $this->getStatus();
        $data = $this->getData() ? $this->getData() : new \stdClass();
        $fractal = app()->make('League\Fractal\Manager');
//        dd($fractal->createData($data)->toArray());
        $response = new \stdClass();
        $response->data = new \stdClass();
        if ($data instanceof Collection) {
            $paginator = $data->getPaginator();
            if ($paginator) {
                $pager = new \stdClass();
                $pager->entities = $paginator->getTotal();
                $pager->current = $paginator->getCurrentPage();
                $pager->total = $paginator->getLastPage();
                $pager->limit = $paginator->getPerPage();
                $pager->last = $paginator->getLastPage();
                $pager->next = $pager->current + 1 > $pager->last ? "" : $pager->current + 1;
                $pager->previous = $pager->current - 1 > 0 ? $pager->current - 1 : '';
                $response->pager = $pager;
            }
            $arr = $fractal->createData($data)->toArray();
            if (count($arr['data']) >1 ) $response->data->items = $arr['data'];
            $response->data = $arr['data'];
        }

        if ($data instanceof Item) {
            $arr = $fractal->createData($data);
            $response->data = $arr['data'];
        }
        return \Response::json($response, $status);
    }

    public function requestValidate(array $data, array $rules, $key = 'default')
    {
        $validation = config('validation.validation');
        $validation = isset($validation[$key]) ? array_merge($validation['default'], $validation[$key]) : $validation['default'];
        $validate = \Validator::make($data, $rules, $validation);
//        dd($validate->errors()->first());
        if ($validate->fails()) {
            $code = (int)$validate->errors()->first();
            throw new ValidationException($code);
        }
    }
}