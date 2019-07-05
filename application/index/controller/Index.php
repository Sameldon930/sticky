<?php
namespace app\index\controller;

use think\App;
use think\Controller;

class Index extends Base
{
    public function index()
    {
        //商品分类 数据-美食 推荐的数据
        $datas = model('Deal')->getNormalDealByCategoryCityId(1,$this->city->id);
        //获取四个子分类
        $foods = model('Category')->getNormalRecommendCategoryByParentId(1,4);

        return  $this->fetch('',[
            'datas'=>$datas,
            'foods'=>$foods
        ]);
    }
}
