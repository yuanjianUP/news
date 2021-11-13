<?php
/**
 * Created by PhpStorm.
 * User: jian
 * Date: 2019/3/14
 * Time: 14:25
 */

namespace app\admin\controller;

use app\common\lib\Upload;
class Image extends Base
{
    public function upload0(){
        $file = request()->file('file');
        $info = $file -> move(ROOT_PATH.'public'.DS.'uploads');
        if($info && $info->getSaveName()){
            $data = [
                'status' => 1,
                'message'=>'ok',
                'data'=>'/uploads/'.$info->getSaveName(),
            ];
            echo json_encode($data);exit;
        }
        echo json_encode(['status'=>0,'message'=>$file->getError()]);
    }

    /**
     * 上传七牛服务器
     */
    public function upload(){
        $upload = new Upload();
        try{
            $image = $upload::image();
        }catch (\Exception $e){
            echo json_encode(['status'=>0,'message'=>$e->getMessage()]);
        }
        if($image){
           $data = [
               'status'=>1,
               'message'=>'ok',
               'data'=> config('qiniu.url').'/'.$image
           ];
           echo json_encode($data);exit;
        }else{
            echo json_encode(['status'=>0,'message'=>'上传失败']);
        }

    }
}