<?php
namespace app\common\model;

use think\Model;
//推荐位模型层
class Featured extends BaseModel {

    public function getFeaturedByType($type){

        $data = [
            'status'=>['neq',-1],
            'type'=>$type
        ];
        $order = [
            'id'=>'desc'
        ];
        $res =  $this->where($data)->order($order)->paginate();

        return $res;
    }

}