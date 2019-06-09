<?php
/**
 * Created by PhpStorm.
 * User: jian
 * Date: 2019/2/28
 * Time: 17:42
 */

namespace app\admin\controller;


use think\Controller;

class Base extends Controller
{
    public $page;//当前页
    public $size;//一页显示多少条
    public function _initialize()
    {
        $isLogin = $this -> isLogin();
        if(!$isLogin){
            $this -> redirect('login/index');
        }
    }
    public function isLogin(){
        $user = session(config('admin.session_user'),'',config('admin.session_user_scope'));
        if($user && $user->id){
            return true;
        }
        return false;
    }
    public function getPageAndSize($data){
        $this -> page = !empty($data['page'])?$data['page']:1;
        $this -> size = !empty($data['size'])?$data['size']:config('paginate.list_rows');
    }
}