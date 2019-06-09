<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
function getCatName($catId){
    if(!$catId){
        return '';
    }
    $cat = config('cat.lists');
    return !empty($cat[$catId])?$cat[$catId]:'';
}
function isYesNo($str){
    return $str ? '<span>是</span>':'<span>否</span>';
}
