<?php
/**
 * Created by PhpStorm.
 * User: jian
 * Date: 2019/5/3
 * Time: 14:47
 */

namespace app\common\lib;
use Qiniu\Auth;
use Qiniu\Storage\UploadManager;

/**
 * 七牛图片基础类
 * @package app\common\lib
 */
class Upload
{
    /**
     * 七牛上传图片方法
     */
    public static function image(){
        if(empty($_FILES['file']['tmp_name'])){
            exception('上传文件不合法',404);
        }
        $file = $_FILES['file']['tmp_name'];
        $pathinfo = $_FILES['file']['name'];
        $ext = pathinfo($pathinfo)['extension'];
        $config = config('qiniu');
        $auth = new Auth($config['ak'],$config['sk']);
        //生成上传token
        $token = $auth->uploadToken($config['name']);
        $key = date('Y').'/'.date('M').'/'.uniqid().'.'.$ext;
        $uploadMgr = new UploadManager();
        list($ret,$err) = $uploadMgr -> putFile($token,$key,$file);
        if($err !== null){
            return null;
        }else{
            return $key;
        }
    }
}