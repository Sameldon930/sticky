<?php
namespace app\common\model;

use think\Model;
//商户门店信息模型层
class BisLocation extends BaseModel {

    public  function  getNormalLocationByBisId($bisId){
        $data = [
            'bis_id'=>$bisId,
            'status'=>1
        ];
        $res = $this->where($data)->order('id','desc')->select();
        return $res;
    }

    public  function  getNormalLocationsInId($ids){
        $data = [
            'id'=>['in',$ids],
            'status'=>1
        ];
        return $this->where($data)->select();
    }

}