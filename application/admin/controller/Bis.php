<?php
namespace app\admin\controller;

use think\Controller;

class Bis extends  Controller
{
    private  $obj;
    //公共读取模型层的方法
    public function _initialize()
    {
        $this->obj = model('Bis');
    }
    //正常的商户列表
    public function  index(){
        $bis =  $this->obj->getBisByStatus(1);//1表示审核通过
        return $this->fetch('',[
           'bis'=>$bis
        ]);

    }

    //列表页
    public  function  apply(){

        $bis = $this->obj->getBisByStatus();
        return $this->fetch('',[
            'bis'=>$bis
        ]);

    }
    //入驻申请详情页
    public function  detail(){
        //获取id
        $id = input('get.id');
        if(empty($id)){
            return $this->error('ID错误！');
        }
        //获取一级城市
        $citys = model('City')->getNormalCityByParentId();
        //获取一级栏目
        $categorys = model('Category')->getNormalCategoryByParentId();
        //根据id获取对应的商户申请信息
        //基本信息
        $bisData = $this->obj->get($id);

        //总店信息
        $locationData  =  model('BisLocation')->get(['bis_id'=>$id,'is_main'=>1]);
        //账号信息
        $accountData =  model('BisAccount')->get(['bis_id'=>$id,'is_main'=>1]);
        return $this->fetch('',[
            'citys'=>$citys,
            'categorys'=>$categorys,
            'bisData'=>$bisData,
            'locationData'=>$locationData,
            'accountData'=>$accountData
        ]);
    }

    //修改状态以及删除
    public function status(){
        $data = input('get.');
        $validate = validate('Bis');
        if(!$validate->scene('status')->check($data)){
            $this->error($validate->getError());
        }
        //编辑对应id内容的状态值
        $res = $this->obj->save(['status'=>$data['status']], ['id'=>$data['id']]);
        //关联的表的状态也改变
        $location = model('BisLocation')->save(['status'=>$data['status'],'bis_id'=>$data['id'],'is_main'=>1]);
        $account = model('BisAccount')->save(['status'=>$data['status'],'bis_id'=>$data['id'],'is_main'=>1]);
        //获取商户的email
        $info = $this->obj->get($data['id']);

        if($res &&  $location && $account ){
            //发送邮件进行通知
            /**
             * 审核状态 1 通过  2不通过 -1记录删掉
             */
            if($data['status']==1){

                $content = "申请通过可以进行登陆！";
                \PHPMailer\Email::send($info['email'],'入驻申请审核结果',$content);
            }else if($data['status']==2){
                $content =  "很遗憾，申请失败！";
                \PHPMailer\Email::send($info['email'],'入驻申请审核结果',$content);
            }else{
                $content = "记录删除，请重新申请！" ;
                \PHPMailer\Email::send($info['email'],'入驻申请审核结果',$content);
            }
            $this->success('切换成功！');
        }else{
            $this->error('切换失败！');
        }
    }



}
