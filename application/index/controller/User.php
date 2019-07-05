<?php
namespace app\index\controller;

use think\App;
use think\Controller;

class User extends Controller
{
    //登陆模块
    public function login(){
        //判断是否登陆 如果登陆过就跳转到主页
        $user = session('o2o_user','','o2o');
        if($user && $user->id){
            $this->redirect('index/index');
        }
        return  $this->fetch();
    }
    //登陆验证
    public  function  logincheck(){
        if(request()->isPost()){
           $data = input('post.');
           $validate = validate('User');
           if(!$validate->scene('logincheck')->check($data)){
                $this->error($validate->getError());
           }
           //验证该用户是否存在 这是个对象
           $user = model('User')->getUserByUserName($data['username']);
           //如果这个用户不存在 或者 这个用户是异常状态的话
            if(!$user || $user['status']!=1){
                $this->error('该用户不存在 或 状态异常！');
            }
            //判断密码是否正确
            if($user->password != md5($data['password'].$user->code)){
                $this->error('密码不正确！');
            }
            //验证通过更新字段值 进行保存
            $info = model('User')->updateId(['last_login_time'=>time()],$user->id);
            //session存用户信息
            session('o2o_user',$user,'o2o');
            $this->success('登陆成功！',url('index/index'));
        }
    }
    //注册模块
    pubLic function register(){

        if(request()->isPost()){
            $data = input('post.');
            //校验
            $validate = validate('User');
            if(!$validate->scene('register')->check($data)){
                $this->error($validate->getError());
            }
            //对比两次密码是否正确
            if($data['password'] != $data['repassword']){
                $this->error('两次密码输入不一致！');
            }

            //校验验证码是否正确
            if(!captcha_check($data['verifyCode'])){
                $this->error('验证码输入错误！');
            }
            //随机码 拼接密码
            $code = mt_rand(100,1000);
            //组织数据 准备入库
            $userData=[
                'username'=>$data['username'],
                'email'=>$data['email'],
                'password'=>md5($data['password'].$code),
                'code'=>$code
            ];
            $info = model('User')->add($userData);
            if($info){
                $this->success('注册成功!',url('user/login'));
            }else{
                $this->error('注册失败');
            }
        }else{
            return  $this->fetch();
        }


    }
    //退出登陆
    public function logout(){
        session(null,'o2o');
        $this->redirect('user/login');
    }
}
