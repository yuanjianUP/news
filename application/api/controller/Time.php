<?php
/**
 * Created by PhpStorm.
 * User: jian
 * Date: 2019/6/18
 * Time: 12:49
 */

namespace app\api\controller;
use app\common\lib\IAuth;
use app\common\lib\Aes;
use think\Controller;


class Time extends Controller
{
    public function index(){
        return show(1,'ok',time());
    }
}