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


class Test extends Common
{
    public function test(){
        $data = [
            'did' => 123,
            'version' => 'jaifjda'
        ];
//        dump(IAuth::setSign($data)) ;exit;
        $string = 'aF8WXmNpGA4ESLAr/N1M5LJ0qDXr9/2KKttHB7ucpu8=';
        echo (new Aes())->decrypt($string);exit;
    }
}