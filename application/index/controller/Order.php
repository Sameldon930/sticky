<?php
namespace app\index\controller;

use think\App;
use think\Controller;

class Order extends Base
{
    public function index(){
        $user = $this->getLoginUser();
        if(!$user){
            $this->error('未登陆',url('user/login'));
        }
        $id = input('get.id',0,'intval');
        if(!$id){
            $this->error('参数不合法！');
        }
        $count = input('get,deal_count',0,'intval');
        $totalPrice = input('get.deal_count',0,'intval');
        //根据id获取商品
        $deal = model('Deal')->find($id);
        if(!$deal || $deal->status != 1){
            $this->error('该商品不存在！');
        }
        if(empty($_SERVER['HTTP_REFERER'])){
            $this->error('请求不合法！');
        }

        //组织数据入库
        $data = [
            'out_trade_no'=>setOrderSn(),//订单号的生成
            'user_id'=>$user->id,
            'username'=>$user->username,
            'deal_id'=>$id,
            'deal_count'=>$count,
            'total_price'=>$totalPrice,
            'referer'=>$_SERVER['HTTP_REFERER']
        ];
        $orderId = model('Order')->add($data);

        $this->redirect('pay/index',['id'=>$orderId ]);
    }
    public function confirm(){
        //验证登陆
        if(!$this->getLoginUser()){
            $this->error('请登陆','user/login');
        }
        //接收参数
        $id = input('get.id',0,'intval');
        if(!$id){
            $this->error('参数不合法！');
        }
        $count = input('get.count',1,'intval');
        $deal = model('Deal')->find($id);
        if(!$deal || $deal->status != 1){
            $this->error('商品不存在！');
        }
        return $this->fetch('',[
            'controller' => 'pay',
            'count'=>$count,
            'deal'=>$deal
        ]);
    }
}
