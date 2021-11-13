<?php
/**
 * Created by PhpStorm.
 * User: jian
 * Date: 2019/2/28
 * Time: 16:30
 */

namespace app\common\lib;
use app\common\lib\Aes;
use app\common\lib\Time;
use think\Cache;

class IAuth
{
    /**密码加密
     * @param $data
     * @return string
     */
    public static function setPassword($data){
        return md5($data.config('app.password_salt'));
    }

    /**j加密数据
     * @param array $data 数据
     * @return HexString|string 字符串
     */
    public static function setSign($data = []){
        //按字母顺序
        ksort($data);
        //拼接数据
        $string = http_build_query($data);

        $string = (new Aes())->encrypt($string);

        return $string;
    }

    /**
     * 检查sign是否正常
     * @param $data
     */
    public static function checkSignPass($data){
        $str  = (new Aes())->decrypt($data['sign']);
        if(empty($str)){
            return false;
        }
        parse_str($str,$arr);
        if(!is_array($arr) || empty($arr['did'])
            || $arr['did'] != $data['did']
        ){
            return false;
        }
        //判断时间是否过期
        if(time() -> ceil($arr['time'] / 1000) > config('app.app_sign_time')){
            return false;
        }
        //判断有没有使用过
        if(Cache::get($data['sign'])){
            return false;
        }
        return true;

    }
}