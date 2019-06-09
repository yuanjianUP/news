<?php
/**
 * Created by PhpStorm.
 * User: jian
 * Date: 2019/2/28
 * Time: 12:26
 */

namespace app\admin\controller;


use app\common\model\AdminUser;
use think\Controller;
use app\common\lib\IAuth;
class Login extends Base
{
    public function _initialize(){}

    public function index(){
        if($this->isLogin()){
            $this -> redirect('index/index');
        }else{
            return $this -> fetch();
        }
    }
    public function check(){
        if(request()->isPost()){
            $data = input('post.');
            if(!captcha_check($data['code'])){
                $this -> error('验证码错误');
            }
            try{
                $user = model('AdminUser')->get(['username'=>$data['username']]);
            }catch (\Exception $e){
                $this -> error($e->getMessage());
            }

            if(!$user){
                $this -> error('用户名不存在');
            }
            if(IAuth::setPassword($data['password'])!=$user['password']){
                $this->error('密码错误');
            }
            $uInfo = [
                'last_login_time'=>time(),
                'last_login_ip'=>request()->ip(),
            ];
            try{
                model('AdminUser')->save($uInfo,['id'=>$user->id]);
            }catch (\Exception $e){
                $this -> error($e->getMessage());
            }
            session(config('admin.session_user'),$user,config('admin.session_user_scope'));
            $this -> success('登陆成功','index/index');
        }else{
            $this -> error('非法访问');
        }

    }

    public function logout(){
        session(null,config('admin.session_user_scope'));
        $this -> redirect('login/index');
    }
}