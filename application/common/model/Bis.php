<?php
namespace app\common\model;

use think\Model;
//商户基本信息模型层
class Bis extends BaseModel {

    //获取提交申请的商户列表
    public  function  getBisByStatus($status=0){

        $data = [
            'status'=>$status
        ];
        $order = [
            'id'=>'desc'
        ];
        $res = $this->where($data)->order($order)->paginate();
        return $res;
    }

}