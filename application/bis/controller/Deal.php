<?php
namespace  app\bis\controller;

use think\Controller;

class Deal extends Base {
    public  function  index(){

         return $this->fetch();
    }


    public function add()
    {
        $bisId = $this->getLoginUser()->bis_id;
        if(request()->isPost()){
            //执行插入
            $data = input('post.');

            $validate = validate('Deal');
            if(!$validate->scene('add')->check($data)){
                $this->error($validate->getError());
            }

            $deals = [
                'bis_id'=>$bisId,
                'name'=>$data['name'],
                'image'=>$data['image'],
                'category_id'=>$data['category_id'],
                'se_category_id'=>empty($data['se_category_id'])?'':implode(',',$data['se_category_id']),//数组转字符串
                'city_id'=>$data['city_id'],
                'location_ids'=>empty($data['location_ids'])?'':implode(',',$data['location_ids']),//数组转字符串
                'start_time'=>strtotime($data['start_time']),
                'end_time'=>strtotime($data['end_time']),
                'total_count'=>$data['total_count'],
                'origin_price'=>$data['origin_price'],
                'current_price'=>$data['current_price'],
                'coupons_start_time'=>strtotime($data['coupons_start_time']),
                'coupons_end_time'=>strtotime($data['coupons_end_time']),
                'notes'=>$data['notes'],
                'description'=>$data['description'],
                'bis_account_id'=>$this->getLoginUser()->bis_id,
            ];
            $id = model('Deal')->add($deals);
            if($id ){
                $this->success('添加成功！',url('deal/index'));
            }else{
                $this->error('添加失败！');

            }
        }else{
            //获取一级城市
            $citys = model('City')->getNormalCityByParentId();
            //获取一级栏目
            $categorys = model('Category')->getNormalCategoryByParentId();
            return $this->fetch('',[
                'citys'=>$citys,
                'categorys'=>$categorys,
                'bislocations'=>model('BisLocation')->getNormalLocationByBisId($bisId),
            ]);
        }

    }
}