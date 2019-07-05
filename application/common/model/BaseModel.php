<?php
namespace app\common\model;

use think\Model;
//模型层基类
class BaseModel extends Model{

    public  function  add($data){
        $data['status'] = 0;
        $this->save($data);
        return $this->id;
    }
}