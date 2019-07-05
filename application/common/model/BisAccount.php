<?php
namespace app\common\model;

use think\Model;
//商户账户信息模型层
class BisAccount extends BaseModel {

    public  function  updateById($data,$id){

        //过滤post数组中非表中的数据
        return $this->allowField(true)->save($data,['id'=>$id]);
    }

}