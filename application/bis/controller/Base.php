<?php
namespace  app\bis\controller;

use think\Controller;

class  Base extends Controller{

    public $account;
    public  function  _initialize(){
        //访问所有后台页面的时候 都需要进行是否登陆的判断
        $login = $this->isLogin();
        if(!$login){//如果不存在 表示还没登陆过 跳转到登录页进行登陆处理
            return $this->redirect('login/index');
        }
    }
    //判断是否登陆
    public  function  isLogin(){
        //获取session
        $user = $this->getLoginUser();
        if($user && $user->id){
            return true;
        }
        return false;
    }
    public function  getLoginUser(){
        if(!$this->account){
            $this->account = session('bisAccount','','bis');
        }
        return $this->account;
    }


}