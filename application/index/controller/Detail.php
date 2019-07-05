<?php
namespace app\index\controller;

use think\App;
use think\Controller;

class Detail extends Base
{
    public function  index($id){
        if(!intval($id)){
            $this->error('ID不合法！');
        }
        //根据id查询商品的数据
        $deal = model('Deal')->get($id);
        if(!$deal || $deal->status != 1){
            $this->error('该商品不存在！');
        }
        //获取分类信息
        $category = model('Category')->get($deal->category_id);
        //获取分店信息
        $locations = model('BisLocation')->getNormalLocationsInId($deal->location_ids);

        //定义标识来判断是否处于抢购的状态
        $flag = 0;
        //如果开始时间大于现在的时间 表示可以抢购并出现倒计时
        if($deal->start_time > time()){
            $flag = 1;
            //计算能抢购的剩余时间
            $dtime = $deal->start_time - time();
            $timedata = '';
            //向下取整
            $d = floor($dtime/(3600*24));
            if($d){
                $timedata .= $d."天";
            }
            //小时
            $h = floor($dtime%(3600*24)/3600);
            if($h){
                $timedata .= $h."小时";
            }
            $m = floor($dtime%(3600*24)%3600/60);
            if($m){
                $timedata .=$m."分";
            }
            $this->assign('timedata',$timedata);
        }
        return $this->fetch('',[
            'deal'=>$deal,
            'title'=>$deal->name,
            'category' =>$category,
            'locations'=>$locations,
            'overplus'=>$deal->total_count - $deal->buy_count, //优惠价剩余份
            'flag'=>$flag,//是否能抢购的标识
            //提供经纬度到模板 然后在模板接收 以参数的形式传到封装好的函数
            'mapstr'=>$locations[0]['xpoint'].','.$locations[0]['ypoint'],
        ]);
    }
}
