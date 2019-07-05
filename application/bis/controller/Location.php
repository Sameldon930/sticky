<?php
namespace  app\bis\controller;

use think\Controller;

class Location extends Base {

    //列表页
    public  function  index(){
         return $this->fetch();
    }
    //新增门店
    public  function  add(){
        if(request()->isPost()){
            $data = input('post.');

            //获取门店归属的商户id
            $accountId = $this->getLoginUser()->bis_id;
            if(!empty($data['se_category_id'])){
                $data['cat'] = implode('|',$data['se_category_id']);
            }
            //获取经纬度
            $lngLat = \Map::getLngLat($data['address']);
            //判断是否为空 结果是否正确
            if(empty($lngLat) || $lngLat['result'] == []){
                $this->error('无法获取数据，或者匹配');

            }
            //门店信息入库操作
            $locationData = [
                'bis_id'=>$accountId,
                'name'=>$data['name'],
                'logo'=>$data['logo'],
                'tel'=>$data['tel'],
                'contact'=>$data['contact'],
                'category_id'=>$data['category_id'],
                'category_path'=>empty($data['category_path'])?$data['category_id']:$data['category_path'],
                'address'=>$data['address'],
                'open_time'=>$data['open_time'],
                'content'=>empty($data['content'])?'':$data['content'],
                'is_main'=>0,   //0代表门店信息
                'xpoint'=>empty($lngLat['result']['location']['lng'])?'':$lngLat['result']['location']['lng'],
                'ypoint'=>empty($lngLat['result']['location']['lat'])?'':$lngLat['result']['location']['lat']
            ];
            $locationId = model('BisLocation')->add($locationData);
            if($locationId){
                $this->success('门店添加成功');
            }else{
                $this->error('门店添加失败');

            }
        }else{
            //获取一级城市
            $citys = model('City')->getNormalCityByParentId();
            //获取一级栏目
            $categorys = model('Category')->getNormalCategoryByParentId();
            return $this->fetch('',[
                'citys'=>$citys,
                'categorys'=>$categorys
            ]);
        }


    }
}