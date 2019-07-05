<?php
namespace app\common\model;

use think\Model;
//订单模型层
class Order extends Model
{
    public function  add($data){
        $data['status'] = 1;
        $result = $this->save($data);
        return $result;

    }
}