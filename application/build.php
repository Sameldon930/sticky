<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
/**
 *该文件执行生成结果 作用域该文件的所在目录
 */
return [
    // 生成应用公共文件
    '__file__' => ['common.php', 'config.php', 'database.php'],

    // 定义demo模块的自动生成 （按照实际定义的文件名生成）
    /*'demo'     => [
        '__file__'   => ['common.php'],
        '__dir__'    => ['behavior', 'controller', 'model', 'view'],
        'controller' => ['Index', 'Test', 'UserType'],
        'model'      => ['User', 'UserType'],
        'view'       => ['index/index'],
    ],*/
    // 模块搭建
    //创建common模块 也就是在application 创建 common  里面一个model model下面下面有Category和Admin两个模型
    'common'=>[
        '__dir__' =>['model'],//创建什么目录
        'model' =>['Category','Admin'],//在什么目录下创建什么文件
    ],
    //创建admin模块
    'admin' =>[
        '__dir__' =>['controller','view'],
        'controller'=>['index'],
        'view'=>['index']
    ],
    //创建api模块
    'api'=>[
        '__dir__' =>['controller','view'],
        'controller'=>['index','image'],
        'view' =>['index','image']
    ]

];
