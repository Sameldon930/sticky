<?php
namespace app\common\model;

use think\Model;
//用户模型层
class User extends BaseModel {

    public  function  add($data){
        $data['status'] = 1;
        $this->save($data);
        return $this->id;
    }
    //获取用户名
    public function  getUserByUserName($username){
        if(!$username){
            exception('用户名不合法！');
        }
        $data = ['username'=>$username];
        return $this->where($data)->find();
    }
    //验证通过之后 更新对应用户的信息
    public function  updateId($arr = [],$id){
        return $this->allowField(true)->save($arr,['id'=>$id]);
    }

}