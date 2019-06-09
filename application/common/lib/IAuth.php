<?php
/**
 * Created by PhpStorm.
 * User: jian
 * Date: 2019/2/28
 * Time: 16:30
 */

namespace app\common\lib;


class IAuth
{
    public static function setPassword($data){
        return md5($data.config('app.password_salt'));
    }
}