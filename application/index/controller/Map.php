<?php
namespace app\index\controller;

use think\App;
use think\Controller;

class Map extends Controller
{
    public function getMapImage($data){
        return \Map::staticimage($data);
    }
}
