<?php

namespace app\admin\controller;

use think\Controller;

class  Category extends Base {

    private  $obj;
    //公共读取模型层的方法
    public function _initialize()
    {
        $this->obj = model('Category');
    }

    //列表页
    public  function  index(){

        //接受参数
        $parent_id = input('get.parent_id',0,'intval');

        $categorys = $this->obj->getCategory($parent_id);
        return $this->fetch('',[
            'categorys'=>$categorys
        ]);
    }

    //添加页面
    public  function  add(){
        //获取一级栏目
        $categorys =  $this->obj->getFirstCategory();

        //模板开启 并将上面的数据传给模板页面
        return $this->fetch('',[
            'category'=>$categorys
        ]);
    }

    //表单提交保存的方法
    public function  save(){

        if(!request()->isPost()) {
            $this->error('请求失败！');
        }
        $data = input('post.');
        $validate  = validate('Category');
        //如果验证失败
        if(!$validate->scene('add')->check($data)){
            $this->error($validate->getError());
        }
        //如果id已经存在 那就走 更新的方法 不存在就执行插入
        if(!empty($data['id'])){
            return $this->update($data);
        }
        //验证没有问题之后 就插入model中去
        $res = $this->obj->add($data);


        if($res){
            $this->success('新增成功！');
        }else{
            $this->error('新增失败！');
        }
    }
    //编辑页面
    public  function edit($id=0){
        if(intval($id) < 1){
            $this->error('参数不合法!');
        }
        //获取一级栏目
        $categorys = $this->obj->getFirstCategory();
        //获取这个id的单条数据 id必须是主键
        $category = $this->obj->get($id);
        return $this->fetch('',[
            'categorys'=>$categorys,
            'category'=>$category
        ]);

    }
    //更新保存
    public function  update($data){
        // 提交数据 参数1是数据 参数2是条件
        $res = $this->obj->save($data,['id'=>intval($data['id'])]);
        if($res){
            $this->success('更新成功!');
        }else{
            $this->error('更新失败!');
        }
    }






}