<?php
namespace app\common\model;

use think\Model;
//生活服务分类模型层
class Category extends Model
{
    //定义属性 让创建时间的字段值等于执行的当前时间 这样create_time就不需要设置time()的值
    public function add($data){
        $data['status'] = 1;
        return $this->save($data);
    }
    //获取栏目
    public function  getFirstCategory(){
        //筛选条件
        $data = [
            'status'=>1,//状态开启
            'parent_id'=>0,//父级字段为0
        ];
        //排序方式
        $order = [
          'id'=>'desc'
        ];
        return $this->where($data)
            ->order($order)
            ->select();

    }
    //分类列表页
    public function getCategory($parent_id = 0){

        $data = [
            'status'=>['neq',-1],//状态不是删除
            'parent_id'=>$parent_id,
        ];

        $order = [
            'id'=>'desc'
        ];

        $res = $this->where($data)
            ->order($order)
            ->paginate();
        return $res;

    }
    //二级联动获取下一级分类
    public  function  getNormalCategoryByParentId($parent_id = 0){
        //条件
        $data = [
            'status'=>1,
            'parent_id'=>$parent_id,
        ];
        $order = [
            'id'=>'desc',
        ];
        return $this->where($data)
            ->order($order)
            ->select();
    }

    ///根据id获取正常的推荐分类
    public  function  getNormalRecommendCategoryByParentId($id=0,$limit=5){
        $data = [
            'parent_id'=>$id,
            'status'=>1,
        ];
        $order = [
            'listorder'=>'desc',
            'id'=>'desc'
        ];

        $res = $this->where($data)->order($order);
        if($limit){
            $result = $res->limit($limit);
        }
        return $result->select();
    }

    public function getNormalCategoryIdParentId($ids){
        $data = [
            'parent_id'=>['in',implode(',',$ids)],
            'status'=>1
        ];
        $order = [
            'listorder'=>'desc',
            'id'=>'desc'
        ];
        $result = $this->where($data)->order($order)->select();
        return $result;
    }
}