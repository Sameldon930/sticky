<?php

namespace app\admin\controller;

use think\Controller;

class  Deal extends Controller{

    private  $obj;
    //公共读取模型层的方法
    public function _initialize()
    {
        $this->obj = model('Deal');
    }
    public function  index(){
        //获取搜索框提交的数据
        $data = input('get.','','htmlentities');
        $sdata = [];
        //如果有分类搜索框有内容
        if(!empty($data['category_id'])){
            $sdata['category_id'] = $data['category_id'];
        }
        //如果城市的搜索框中有内容
        if(!empty($data['city_id'])){
            $sdata['city_id'] = $data['city_id'];

        }
        //时间筛选 如果时间都不为空 并且结束时间大于开始时间
        if(!empty($data['start_time']) && !empty($data['end_time']) && strtotime($data['end_time'])> strtotime($data['start_time'])){
            $data['create_time'] = [
              ['gt',strtotime($data['start_time'])],
              ['lt',strtotime($data['end_time'])]
            ];
        }
        //模糊查询
        if(!empty($data['name'])){
            $sdata['name'] = ['like','%'.$data['name'].'%'];
        }
        //获取团购列表
        $deals = $this->obj->getNormalDeals($sdata);
        //获取分类
        $categorys = model('Category')->getNormalCategoryByParentId();

        $categoryArr = $cityArr = [];
        //分类名转中文
        foreach($categorys as $category){
            $categoryArr[$category->id] = $category->name;
        }
        //获取城市
        $citys = model('City')->getNormalCitys();
        //城市名转中文
        foreach($citys as $city){
            $cityArr[$city->id] = $city->name;
        }



        return $this->fetch('',[
            'categorys'=>$categorys,
            'citys'=>$citys,
            'deals'=>$deals,
            //页面保留搜索记录  并在模板传入对应的value值
            'category_id'=>empty($data['category_id']) ?'':$data['category_id'],
            'city_id'=>empty($data['city_id']) ?'':$data['city_id'],
            'name'=>empty($data['name']) ?'':$data['name'],
            'start_time'=>empty($data['start_time']) ?'':$data['start_time'],
            'end_time'=>empty($data['end_time']) ?'':$data['end_time'],
            //页面的城市名和分类名中文化
            'categoryArr' =>empty($categoryArr)?'':$categoryArr,
            'cityArr'=>empty($cityArr)?'':$cityArr,


        ]);
    }






}