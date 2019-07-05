<?php
namespace  app\api\controller;

use think\Controller;

//获取所属分类
class Category extends Controller{
    private  $obj;
    public function  _initialize(){
        $this->obj = model('Category');
    }
    //二级联动的接口
    public  function  getCategoryByParentId(){
        $id = input('post.id',0,'intval');
        if(!$id){
            $this->error('参数不合法！');
        }
        //获取二级分类
        $categorys = $this->obj->getNormalCategoryByParentId($id);
        if(!$categorys){
            return show(0,'error');
        }
        return show(1,'success',$categorys);

    }

}