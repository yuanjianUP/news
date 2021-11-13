<?php
/**
 * Created by PhpStorm.
 * User: jian
 * Date: 2019/6/19
 * Time: 16:48
 */

namespace app\common\lib;


class Time
{
    /**
     * 获取13位时间戳
     * @return string
     */
    public static function get13TimeStamp(){
        list($t1,$t2) = explode(' ',microtime());
        return $t2 . ceil($t1 * 1000);
    }
}