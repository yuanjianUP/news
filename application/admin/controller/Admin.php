<?php
/**
 * Created by PhpStorm.
 * User: jian
 * Date: 2019/2/28
 * Time: 10:34
 */

namespace app\admin\controller;


use think\Controller;

class Admin extends Base
{
    public function add(){
        if(request()->isPost()){
            $data = input('post.');
            $validate = validate('AdminUser');
            if(!$validate->check($data)){
                $this->error($validate->getError());
            }
            $data['password']  = md5($data['password'].'_md6yuan');
            $data['status'] = 1;
            try{
                 $id = model('AdminUser')->add($data);
            }catch (\Exception $e){
                $this -> error($e->getMessage());
            }
            if($id){
                $this -> success('id='.$id.'的用户添加成功');
            }else{
                $this -> error($e->getMessage());
            }

        }
        return $this -> fetch();
    }
}