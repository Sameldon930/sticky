<?php

namespace app\admin\validate;

use think\Validate;

class Bis extends  Validate{

    protected $rule = [

        ['status','number|in:-1,0,1,2','状态值必须是数字！|状态范围不合法！'],

    ];
    //场景设置  配置那个页面需要用到哪个字段
    protected $scene = [

        'status' => ['id', 'status'],
    ];
}