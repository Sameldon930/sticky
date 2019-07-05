<?php
namespace app\admin\controller;

use think\Controller;

class Index extends  Controller
{
    public function index()
    {

        return $this->fetch();
    }
//    public function welcome(){
//        //测试邮件服务的方法
//        \phpmailer\Email::send('sameldon930@126.com','张泽山？','TEST');
//        return '发送成功！';
//    }
    //测试根据地址来获取经纬度接口
//    public function  test(){
//        print_r(\Map::getLngLat('福建省漳州市东山县')) ;
//    }

    //测试根据经纬度或者地址来获取百度地图接口
//    public function  image(){
//        print_r(\Map::staticimage('福建省漳州市东山县'));
//    }



}
