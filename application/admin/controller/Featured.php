<?php

namespace app\admin\controller;

use think\Controller;

class  Featured extends Base {

    private  $obj;
    //公共读取模型层的方法
    public function _initialize()
    {

        $this->obj = model('Featured');
    }

    public function  add(){
        if(request()->isPost()){
            $data = input('post.');
            $validate = validate('Featured');
            if(!$validate->scene('add')->check($data)){
                $this->error($validate->getError());
            }
            $id = model('Featured')->add($data);
            if($id){
                $this->success('添加成功！');
            }else{
                $this->error('添加失败！');
            }
        }else{
            //获取配置文件中的推荐位类别
            $types = config('featured.featured_type');
            return $this->fetch('',[
                'types'=>$types
            ]);
        }

    }

    public  function index(){
        //获取配置的推荐位分类 然后渲染到页面
        $types = config('featured.featured_type');
        //获取搜索提交的数据
        $type = input('get.type',0,'intval');

        //获取推荐为列表  内含搜索数据 可置空
        $results = $this->obj->getFeaturedByType($type);
        return $this->fetch('',[
            'types'=>$types,
            'results'=>$results,
            'typeVal'=>empty($type['type'])?'':$type['type'],
        ]);
    }









}