<?php
/**
 * Created by PhpStorm.
 * User: jian
 * Date: 2019/8/4
 * Time: 17:02
 */

namespace app\api\controller\v1;

use app\api\controller\Common;
use app\common\lib\exception\ApiException;
use app\common\lib\exception\ApiHandleException;
class Cat extends Common
{
    public function read(){
        $cats = config('cat.list');
        $result[] = [
            'catid' => 0,
            'catname' => '首页',
        ];
        foreach($cats as $catid => $catname){
            $result[]  = [
                'catid' => $catid,
                'catname' => $catname
            ];
        }
        return show(1,'ok',$result,200);
    }
}