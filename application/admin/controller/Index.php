<?php
/**
 * Created by PhpStorm.
 * User: jian
 * Date: 2019/2/27
 * Time: 17:17
 */
namespace app\admin\controller;
use think\Controller;

class Index extends Base
{
    public function index(){
        return $this->fetch();
    }
}