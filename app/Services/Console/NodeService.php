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
use App\Traits\G9zzLog;
use App\Traits\Respond;

class NodeService
{
    use G9zzLog,Respond;
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

    /**
     * @param $request
     * @return mixed
     */
    public function storeNode($request)
    {
        $create = [
            'parent_id' => $request->get('parentId'),
            'weight' => $request->get('weight'),
            'name' => $request->get('name'),
            'slug' => $request->get('slug'),
            'description' => $request->get('description'),
            'is_show' => $request->get('isShow') == 'no' ? 'no' :'yes',
        ];
        $this->log('service.request to '.__METHOD__,['create' => $create]);
        $create['level'] = $this->checkLevel($create['parent_id']);
        $create['post_count'] = 0;

        return $this->nodeRepository->create($create);

    }

    /**
     * 通过父类ID生成等级level
     * @param $parentId
     * @param int $level
     * @param array $ids
     * @return mixed
     */
    public function getLevelByParentId($parentId,$level = 0,$ids= [])
    {
        if ($parentId == 0) {
            return $level;
        } else {
            $nodeData =  $this->nodeRepository->find($parentId);//返回对象
            if ($nodeData->parent_id != 0) {
                if (in_array($nodeData->parent_id,$ids)) {
                    $this->setCode(config('validation.validation.node')['error.relation']);
                    return $this->response();
                }
                $ids[] = $nodeData->parent_id;
                return $this->getLevelByParentId($nodeData->parent_id,$level+1,$ids);
            }
        }
        return $level + 1;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->nodeRepository->find($id);
    }

    /**
     * @param $request
     * @param $id
     * @return mixed
     */
    public function update($request,$id)
    {
        $update = parse_input($request->only(['parentId','weight','name','slug','description','isShow']));
        if (!$update['is_show']) unset($update['is_show']);
        $this->log('service.request to '.__METHOD__,['update' => $update]);
        $update['level'] = $this->checkLevel($update['parent_id']);
        return $this->nodeRepository->update($update,$id);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {
        $this->nodeRepository->find($id);
        $isHasChild =  $this->nodeRepository->getChildById($id);//return obj | bool
        if (!empty($isHasChild)) {
            $this->setCode(config('validation.validation.node')['has.child_node']);
            return $this->response();
        }
//        dd(2343);
        return  $this->nodeRepository->delete($id);
    }


    /**
     * @param $parentId
     * @return \Illuminate\Http\JsonResponse|int
     */
    public function checkLevel($parentId)
    {
        $level = $this->getLevelByParentId($parentId);
        $nodeMaxLevel = config('g9zz.node.max_level');
        //建议level不要设置那么大,如果要修改,请到config/g9zz.php 下进行修改
        if ($level > $nodeMaxLevel) {
            $this->setCode(config('validation.validation.node')['node.max_level']);
            return $this->response();
        }
        return $level;
    }

}