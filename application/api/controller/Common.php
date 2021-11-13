<?php
/**
 * Created by PhpStorm.
 * User: jian
 * Date: 2019/6/18
 * Time: 12:02
 */

namespace app\api\controller;

use app\common\lib\Aes;
use app\common\lib\exception\ApiException;
use app\common\lib\IAuth;
use think\Cache;
use think\Controller;

class Common extends Controller
{
    public $headers = '';
    public function _initialize(){
        $this -> checkRequestAuth();
//        $this -> testAse();
    }
    public function checkRequestAuth(){
        $headers = request()->header();
        if(empty($headers['sign'])){
            throw new ApiException('sign不存在',400);
        }
        if(!in_array($headers['app_type'],config('app.apptypes'))){
            throw new ApiException('app_type不合法',400);
        }
        if(!IAuth::checkSignPass($headers)){
            throw new ApiException('授权码sign失败',400);
        }
        //设置sign有效时间,并判断有没有sign的cache防止黑客再次访问
        Cache::set($headers['sign'],1,config('app.app_sign_cache_time'));
        $this -> headers = $headers;

    }
    public function testAse(){
        $str = 'id=1&mes=jfadinnga';
        echo (new Aes())->encrypt($str);exit;
    }
}