<?php
namespace app\bis\controller;

use think\Controller;

class Login  extends  Controller{

    //登陆页
    public function  index(){
        //判断是否为post提交的 如果是 进行处理登陆逻辑 如果不行 只现显示页面
        if(request()->isPost()){
            //接收数据
            $data = input('post.');
            //通过用户名获取信息
            $ret = model('BisAccount')->get(['username'=>$data['username']]);
            if(!$ret || $ret->status!=1){//如果不存在 或者 状态不是正常的
                $this->error('该用户不存在或用户没有审核通过！');
            }
            //查询的密码和提交的密码是否相等
            if($ret->password != md5($data['password'].$ret->code)){
                $this->error('密码不正确');
            }
            //以上验证成功之后 进行更新对应商户的默写字段值
            model('BisAccount')->updateById(['last_login_time'=>time()],$ret->id);
            //存session  名称 值 作用域
            session('bisAccount',$ret,'bis');
            return $this->success('登陆成功！',url('index/index'));
        }else{
            //获取session值 如果已经存在 不需要在登陆 直接访问后台
            $account = session('bisAccount','','bis');
            if($account && $account->id){
                return  $this->redirect(url('index/index'));
            }
            return $this->fetch();
        }
    }

    //退出登陆
    public function logout(){
        //清除session
        session(null,'bis');
        //跳转到登陆页面
        $this->redirect('login/index');
    }


}