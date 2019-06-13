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

function status($id,$status){
    $controller = request()->controller();
    $sta = $status == 1 ? 0 : 1;
    $url = url($controller.'/status',['id'=>$id,'status'=>$sta]);
    if($status == 1){
        $str = "<a href='javascript::' status-url='".$url."' onclick='app_status(this)' title='修改状态'><span class='label label-success radius'>正常</span></a>";
    }elseif ($status == 0){
        $str = "<a href='javascript::' status-url='".$url."' onclick='app_status(this)' title='修改状态'><span class='label label-danger radius'>待审</span></a>";
    }
    return $str;
}

/**
 * @param $status 业务状态码
 * @param $message 信息提示
 * @param array $data 数据
 * @param int $httpCode http状态码
 */
function show($status,$message,$data=[],$httpCode=200){
    $data = [
        'status'=>$status,
        'message'=>$message,
        'data'=>$data
    ];
    return json($data,$httpCode);
}
