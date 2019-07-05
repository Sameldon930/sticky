<?php

namespace app\admin\validate;

use think\Validate;

class Category extends  Validate{

    protected $rule = [
        ['name','require|max:10','分类名不能为空！|分类名长度不能超过10个字符'],
        ['parent_id','number'],
        ['id','number'],
        ['status','number|in:-1,0,1','状态值必须是数字！|状态范围不合法！'],
        ['listorder','number'],
    ];
    //场景设置  配置那个页面需要用到哪个字段
    protected $scene = [
        'add'=>['name','parent_id','id'],//add的页面只需要用到这两个字段
        'listorder'=>['id','listorder'],//排序
        'status' => ['id', 'status'],
    ];
}