<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------
error_reporting(E_ERROR | E_WARNING | E_PARSE);
// 应用公共文件
function status($status){
    if($status == 1){
        $str = '<span class="label label-success radius">正常</span>';
    }else if($status == 0){
        $str = '<span class="label label-danger radius">待审</span>';
    }else{
        $str = '<span class="label label-danger radius">删除</span>';
    }
    return $str;
}

/**
 * @param $url   请求地址
 * @param $type  请求类型 0get 1post
 * @param array $data 提交数据
 * 封装curl方法
 */

function doCurl($url,$type=0,$data=[]){
    //初始化
    $ch = curl_init();

    //设置选项
    curl_setopt($ch,CURLOPT_URL,$url);//配置请求地址
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);//是否返回结果
    curl_setopt($ch,CURLOPT_HEADER,0);//header头内容不输出
    //请求方式是post的实话
    if($type == 1){
        curl_setopt($ch,CURLOPT_POST,1);//开启post
        curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
    }
    //执行并获取内容
    $output = curl_exec($ch);
    //释放curl
    curl_close($ch);
    //返回数据
    return $output;
}

//入驻商户申请审核状态
function bisRegister($status){
    if($status == 1){
        $str = "入驻申请成功";
    }else if($status == 0){
        $str = "待审核，审核之后平台方会发送邮件通知，请关注邮件";
    }else if($status == 2){
        $str = "非常抱歉，提交的材料不符合条件，请重新提交";
    }else{
        $str = "该申请已被删除";
    }

    return $str;
}

//分页的公共方法
function pagination ($obj){
    if(!$obj){
        return '';
    }
    return '<div class="cl pd-5 bg-1 bk-gray mt-20 tp5-o2o">'.$obj->render().'</div>';
}


//详情页获取二级城市的公共方法
function getSeCityName($path){
    if(empty($path)){
        return '';
    }
    //匹配逗号后面的字段值
    if(preg_match('/,/',$path)){
        $cityPath = explode(',',$path);
        $cityId = $cityPath[1];
    }else{
        $cityId = $path;
    }
    $city = model('City')->get($cityId);
    return $city->name;
}
//计算城市数量
function countLocation($ids){
    if(!$ids){
        return 1;
    }
    if(preg_match('/,/',$ids)){
        $arr = explode(',',$ids);
        return count($arr);
    }
}

//生成订单号
function setOrderSn(){
    list($t1,$t2) = explode(' ',microtime());
    $t3 = explode('.',$t1*10000);
    return $t2.$t3[0].(rand(10000,99999));
}
