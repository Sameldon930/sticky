<?php
namespace  app\api\controller;

use think\Controller;
//获取城市
class City extends Controller{
    private $obj;
    public  function _initialize(){
        $this->obj = model('City');
    }
    //二级联动
    public  function  getCitysByParentId(){
        //获取id
        $id = input('post.id');
        if(!$id){
            $this->error('ID不合法！');
        }
        //通过id获取二级城市
        $citys = $this->obj->getNormalCityByParentId($id);
        if(!$citys){
            return show(0,'error');
        }
        return show(1,'success',$citys);
    }
}