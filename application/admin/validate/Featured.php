<?php

namespace app\admin\validate;

use think\Validate;

class Featured extends  Validate{

    protected $rule = [
        'title'=>'require|max:25',
        'type'=>'require',
        'url'=>'require',
        'description'=>'require',
    ];
    //场景设置  配置那个页面需要用到哪个字段
    protected $scene = [
        'add'=>['title','type','url','description'],//add的页面只需要用到这两个字段
    ];
}