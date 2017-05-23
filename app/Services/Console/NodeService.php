<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Email: ylsc633@gmail.com
 * Date: 2017/4/23
 * Time: 上午4:04
 */

namespace App\Services\Console;


use App\Exceptions\TryException;
use App\Repositories\Contracts\NodeRepositoryInterface;
use App\Services\BaseService;
use Vinkla\Hashids\Facades\Hashids;

class NodeService extends BaseService
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
            'display_name' => $request->get('displayName'),
            'description' => $request->get('description'),
            'is_show' => $request->get('isShow') == 'no' ? 'no' :'yes',
        ];
        $this->log('service.request to '.__METHOD__,['create' => $create]);

        if ($create['parent_id'] === 0 || $create['parent_id'] === "0") {
            $parentId = $create['parent_id'];
        } else {
            $parentId = parent::changeHidToId($create['parent_id'],'node');
        }

        $create['level'] = $this->checkLevel($parentId);
        $create['post_count'] = 0;

        try {
            \DB::beginTransaction();
            $create['parent_id'] = $parentId;
            $result = $this->nodeRepository->create($create);
            $update['hid'] = Hashids::connection('node')->encode($result->id);
            $this->nodeRepository->update($update,$result->id);
            \DB::commit();
        } catch (\Exception $e) {
            $this->log('"service.error" to listener "' . __METHOD__ . '".', ['message' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile()]);
            \DB::rollBack();
            throw new TryException(json_encode($e->getMessage()),(int)$e->getCode());
        }


        return $this->nodeRepository->find($result->id);

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
     * @param $hid
     * @return mixed
     */
    public function find($hid)
    {
        $id = parent::changeHidToId($hid,'node');
        return $this->nodeRepository->find($id);
    }

    /**
     * @param $request
     * @param $hid
     * @return mixed
     */
    public function update($request,$hid)
    {
        $id = parent::changeHidToId($hid,'node');
        $update = parse_input($request->only(['parentId','weight','name','displayName','description','isShow']));
        if (!$update['is_show']) unset($update['is_show']);
        $this->log('service.request to '.__METHOD__,['request' => $update]);

        if ($update['parent_id'] === 0 || $update['parent_id'] === "0") {
            $parentId = $update['parent_id'];
        } else {
            $parentId = parent::changeHidToId($update['parent_id'],'node');
        }

        $update['parent_id'] = $parentId;
        $update['level'] = $this->checkLevel($parentId);
        $this->log('service.request to '.__METHOD__,['update' => $update]);
        return $this->nodeRepository->update($update,$id);
    }

    /**
     * @param $hid
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($hid)
    {
        $id = parent::changeHidToId($hid,'node');
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