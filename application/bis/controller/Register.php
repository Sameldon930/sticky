<?php
namespace app\bis\controller;

use think\Controller;

class  Register extends  Controller{

    public function  index(){
        //获取一级城市
        $citys = model('City')->getNormalCityByParentId();
        //获取一级栏目
        $categorys = model('Category')->getNormalCategoryByParentId();
        return $this->fetch('',[
            'citys'=>$citys,
            'categorys'=>$categorys
        ]);
    }
    //提交商户申请逻辑
    public function  add(){
        if(!request()->isPost()){
            $this->error('请求错误！');
        }
        //接收提交的数据
        $data = input('post.','','htmlentities');
        $validate = validate('Bis');
        //基本信息 总店相关信息 账户相关的信息校验
        if(!$validate->scene('add')->check($data)){
            $this->error($validate->getError());
        }
        //获取经纬度
        $lngLat =  \Map::getLngLat($data['address']);

        //判断是否为空 结果是否正确
        if( empty($lngLat) || $lngLat['result'] == [] ){
            $this->error('无法获取数据，或者匹配');
        }
        //判断提交的用户是否存在
        $accountResult = model('BisAccount')->get(['username'=>$data['username']]);
        if($accountResult){
            $this->error('该用户已经存在！');
        }

        //商户信息入库
        $bisData = [
            //防止xss攻击
            'name'=>$data['name'],
            'city_id'=>$data['city_id'],
            'city_path'=>empty($data['se_city_id'])?$data['city_id']:$data['city_id'].','.$data['se_city_id'],
            'logo'=>$data['logo'],
            'licence_logo'=>$data['licence_logo'],
            'description'=>empty($data['description'])?'':$data['description'],
            'bank_info'=>$data['bank_info'],
            'bank_user'=>$data['bank_user'],
            'bank_name'=>$data['bank_name'],
            'legal_person'=>$data['legal_person'],
            'person_tel'=>$data['person_tel'],
            'email'=>$data['email']
        ];
        //执行插入基本信息
        $bisId  = model('Bis')->save($bisData);
        $data['cat'] = '';
        if(!empty($data['se_category_id'])){
            $data['cat'] = implode('|',$data['se_category_id']);
        }
        //总店信息入库
        $locationData = [
            'bis_id'=>$bisId,
            'name'=>$data['name'],
            'logo'=>$data['logo'],
            'tel'=>$data['tel'],
            'contact'=>$data['contact'],
            'category_id'=>$data['category_id'],
            'category_path'=>empty($data['category_path'])?$data['category_id']:$data['category_path'],
            'address'=>$data['address'],
            'open_time'=>$data['open_time'],
            'content'=>empty($data['content'])?'':$data['content'],
            'is_main'=>1 ,   //1代表总店信息
            'xpoint'=>empty($lngLat['result']['location']['lng'])?'':$lngLat['result']['location']['lng'],
            'ypoint'=>empty($lngLat['result']['location']['lat'])?'':$lngLat['result']['location']['lat']
        ];
        $locationId = model('BisLocation')->add($locationData);

        //账户信息入库
        //密码校验字段的生成
        $data['code'] = rand(100,10000);
        $accountData = [
            'bis_id' => $bisId,
            'username'=>$data['username'],
            'code'=>$data['code'],
            'password'=>md5($data['password'].$data['code']),
            'is_main' =>1//代表总管理员
        ];
        $accountId = model('BisAccount')->save($accountData);
        if(!$accountId){
            $this->error('申请失败！');
        }
        //如果插入成功 那就发送邮件通知对方
        $url = request()->domain().url('bis/register/waiting',['id'=>$bisId]);
        $title = "入驻申请通知";
        $content="您提交的入驻申请请等待审核,可通过点击链接进行访问<a href='".$url."'target='_blank'>查看链接</a>查看审核状态";

        \PHPMailer\Email::send($data['email'],$title,$content);
        $this->success('申请成功！',url('register/waiting',['id'=>$bisId]));//跳转

    }

    //申请成功的提示页面
    public function waiting($id){
        if(empty($id)){
            $this->error('error');
        }
        //获取商户列表
        $detail = model('Bis')->get($id);
        return $this->fetch('',[
            'detail'=>$detail
        ]);
    }
}