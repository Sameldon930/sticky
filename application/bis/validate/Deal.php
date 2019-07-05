<?php

namespace  app\bis\validate;

use think\Validate;

class Deal extends Validate{

    protected  $rule = [
        ['name','require','团购名称不能为空']
    ];

    protected  $scene = [
        'add'=>['name']
    ];
}