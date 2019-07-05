<?php
namespace  app\common\model;

use think\Model;

class  City extends  Model{


    //获取正常的城市信息
    public  function  getNormalCityByParentId($parent_id = 0){
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

    //获取城市 不是父级的
    public function getNormalCitys(){
        $data = [
            'status'=>1,
            'parent_id'=>['gt',0]
        ];
        $order = [
            'id'=>'desc'
        ];
        return $this->where($data)->order($order)->select();

    }

}