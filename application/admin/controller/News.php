<?php
/**
 * Created by PhpStorm.
 * User: jian
 * Date: 2019/3/5
 * Time: 22:37
 */

namespace app\admin\controller;


use think\Config;

class News extends Base
{
    public function index(){
        $data = input();
//        halt($data);
        $whereDate = [];
        if(!empty($data['start_time']) && !empty($data['end_time']) && $data['start_time'] > $data['end_time']){
            $whereDate['create_time'] = [
                ['gt',strtotime($data['start_time'])],
                ['lt',strtotime($data['end_time'])]
            ];
        }
        if(!empty($data['catid'])){
            $whereDate['catid'] = intval($data['catid']);
        }
        if(!empty($data['title'])){
            $whereDate['title'] = ['like','%'.$data['title'].'%'];
        }
        $news = model('news')->getNews($whereDate,$this -> from,$this -> size);
//        halt($news);exit;
        $this ->getPageAndSize($data);
        $total = model('news')->getNewsTotal();
        $pageTotal = ceil($total/$this->size);
        return $this -> fetch('',
            [
                'news'=>$news,
                'cats'=>config('cat.lists'),
                'curr'=>$this -> page,
                'pageTotal'=>$pageTotal,
                'total'=>$total
            ]);
    }
    public function add(){
        if(request()->isPost()){
            $data = input('post.');
            $res = model('news')->add($data);
            if($res){
                return $this->result(['jump_url'=>url('news/index')],1,'ok');
            }
            return $this->result('',0,'上传错误');
        }else{
            $this->assign('cat',config('cat.lists'));
            return $this -> fetch();
        }
    }
}