<?php
namespace app\index\controller;

use think\App;
use think\Controller;

class Base extends Controller
{
    public  $city = "";
    public  $account = "";
    public function  _initialize(){
        //获取城市数据
        $citys = model('City')->getNormalCitys();
        $this->getCity($citys);

        //获取首页的分类数据
        $cats =  $this->getRecommendCats();

        $this->assign('controller',strtolower(request()->controller()));
        $this->assign('citys',$citys);
        $this->assign('city',$this->city);
        $this->assign('cats',$cats);
        $this->assign('user',$this->getLoginUser());
        $this->assign('title','o2o团购网');//页面头部名称


    }
    public  function  getCity($citys){
        foreach ($citys as $city){
            $city = $city->toArray();
            if($city['is_default'] == 1){
                $defaultName = $city['uname'];
                //结束循环
                break;
            }
        }
        $defaultName = $defaultName ? $defaultName:'anhui';
        //如果这个session值存在 并且用户没有选中
        if(session('cityname','','o2o') && !input('get.city')){
            $cityUname = session('cityname','','o2o');
        }else{
            //选中城市之后 存到session
            $cityUname = input('get.city',$defaultName,'trim');
            session('cityname',$cityUname,'o2o');
        }

        $this->city = model('City')->where(['uname'=>$cityUname])->find();
    }
    //获取当前用户 传到模板
    public  function  getLoginUser(){
        if(!$this->account){
            $this->account  =  session('o2o_user','','o2o');
        }
        return $this->account;
    }

    //获取首页推荐的商品分类数据
    public function  getRecommendCats(){

        $parentIds = $sedcatArr = $recomCats = array();
        $cats = model('Category')->getNormalRecommendCategoryByParentId(0,5);

        foreach($cats as $cat){
            $parentIds[] = $cat->id;
        }
        //获取二级分类的数据
        $sedCats = model('Category')->getNormalCategoryIdParentId($parentIds);
        foreach($sedCats as $sedCat){
            $sedcatArr[$sedCat->parent_id][] = [
                'id'=>$sedCat->id,
                'name'=>$sedCat->name
            ];
        }

        foreach($cats as $cat){
            /**
             * $recomCats 代表是一级和二级数据
             *  第一个参数是一级分类的name
             *  第二个参数是此一级分类下面的所有二级分类数据
             */
            $recomCats[$cat->id] = [
                $cat->name,
                empty($sedcatArr[$cat->id])?[]:$sedcatArr[$cat->id]
            ];
        }

        return $recomCats;

    }
}
