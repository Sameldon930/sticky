<?php
namespace app\admin\controller;

use think\Controller;

class Base extends  Controller{

    //修改状态的公共方法
    public function  status(){
        //获取状态值
        $data = input('get.');
        if(empty($data['id'])){
            $this->error('id不合法！');
        }
        if(!is_numeric($data['status'])){
            $this->error('status不合法！');

        }
        //获取调用这个方法的控制器
        $model = request()->controller();
        //调用模型层进行处理
        $res = model($model)->save(['status'=>$data['status']],['id'=>$data['id']]);
        if($res){
            $this->success('修改成功！');
        }else{
            $this->error('修改失败!  ');
        }
    }
    //公共排序方法
    public function listorder($id,$listorder){
        $model = request()->controller();
        $res = model($model)->save(['listorder'=>$listorder],['id'=>$id]);
        if($res){
            //调用自带ajax的返回方法  result
            $this->result($_SERVER['HTTP_REFERER'],1,'success');
        }else{
            $this->result($_SERVER['HTTP_REFERER'],0,'排序失败!');
        }
    }


}
