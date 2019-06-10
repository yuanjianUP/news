<?php
/**
 * Created by PhpStorm.
 * User: jian
 * Date: 2019/2/28
 * Time: 17:42
 */
namespace app\admin\controller;
use phpDocumentor\Reflection\DocBlock\Tags\Example;
use think\Controller;
class Base extends Controller
{
    public $page;//当前页
    public $size;//一页显示多少条
    public $from=0;
    public $model='';
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
        $this -> from = ($this -> page-1) * $this -> size;
    }

    public function delete($id=0){

        if(!intval($id)){
            return $this -> result('',0,'ID不合法');
        }
        $model = $this->model ? $this->model : request()->controller();
        try{
            $res = model($model)->save(['status'=>-1],['id'=>$id]);
        }catch (\Exception $e){
           return $this -> result('',0,$e->getMessage());
        }
        if ($res){
            return $this -> result(['jump_url'=>$_SERVER['HTTP_REFERER']],1,'ok');
        }
        return $this -> result('',0,'删除失败');
    }
}