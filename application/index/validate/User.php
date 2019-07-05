<?php
namespace app\index\validate;

use think\Validate;

class  User extends  Validate{

    protected  $rule = [
        'username'=>'require',
        'password'=>'require',
        'email'=>'require',
        'verifyCode'=>'require'
    ];

    protected $scene = [
        'register'=>['username','password','email','verifyCode'],
        'logincheck'=>['username','password']
    ];

}