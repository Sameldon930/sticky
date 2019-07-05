<?php
namespace app\api\controller;

/**
 * Class image
 * @package app\api\controller
 * 图片上传api接口
 */
use think\Controller;
use think\Request;
use think\File;
class image extends  Controller{

    //图片上传
    public function  upload(){
        //调用框架内的文件上传方法
        $file = Request::instance()->file('file');
        //给定一个目录  在public目录下新建一个目录
        $info = $file->move('upload');
        if($info && $info->getPathname()){//如果上传成功
            return show(1,'success','/'.$info->getPathname());
        }
        return show(0,'upload error');
    }
}