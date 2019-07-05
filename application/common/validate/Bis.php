<?php
/**
 * 商家基本信息验证
 */
namespace  app\common\validate;

use think\Validate;

class Bis extends Validate{
    protected $rule = [
        'name'=>'require|max:25',
        'email'=>'email',
        'city_id'=>'require',
        'bank_info'=>'require',
        'bank_name'=>'require',
        'bank_user'=>'require',
        'legal_person'=>'require',
        'person_tel'=>'require',

        'tel'=>'require',
        'contact'=>'require',
        'category_id'=>'require',
        'address'=>'require',
        'open_time'=>'require',
        'content'=>'require',

        'username'=>'require',
        'password'=>'require',
    ];
    //场景设置
    protected $scene = [
        'add'=>['name','email','logo','city_id','bank_info','bank_name','bank_user','legal_person','person_tel'],
    ];
}

