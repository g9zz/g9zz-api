<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Email: ylsc633@gmail.com
 * Date: 2017/4/23
 * Time: 上午4:04
 */

namespace App\Services\Console;


use App\Repositories\Contracts\NodeRepositoryInterface;

class NodeService
{
    protected $nodeRepository;

    public function __construct(NodeRepositoryInterface $nodeRepository)
    {
        $this->nodeRepository = $nodeRepository;
    }

    /**
     * 节点按照父子关系排序
     * @return array
     */
    public function orderNode()
    {
        $model = $this->nodeRepository->all();
        $data  = self::tree($model);
        foreach ($data as $key => $value) {
            $data[$key]->newHtml = $value->html.$value->name;
        }
        return $data;
    }

    /**
     * 排序算法
     * @param $model
     * @param int $parentId
     * @param int $level
     * @param string $html
     * @return array
     */
    public  static function tree($model, $parentId = 0, $level = 0, $html = '-')
    {
        $data = array();
        foreach ($model as $k => $v) {
            if ($v->parent_id == $parentId) {
                if ($level != 0) {
                    $v->html = str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $level);
                    $v->html .= '|';
                }
                $v->html .= str_repeat($html, $level);
                $data[] = $v;
                $data = array_merge($data, self::tree($model, $v->id, $level + 1));
            }
        }
        return $data;
    }

    public function storeNode($request)
    {
        $create = [
            'parent_id' => $request->get('parent_id'),
            'weight' => $request->get('weight'),
            'name' => $request->get('name'),
            'slug' => $request->get('slug'),
            'description' => $request->get('description'),
        ];

        dd($create);

    }
}