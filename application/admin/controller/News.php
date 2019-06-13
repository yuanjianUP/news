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
        $this -> model = "news";
        $data = input();
        $query = http_build_query($data);
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
        //获取分页信息
        $this ->getPageAndSize($data);
        $news = model('news')->getNews($whereDate,$this -> from,$this -> size);
//        halt($news);exit;
        $total = model('news')->getNewsTotal($whereDate);
        $pageTotal = ceil($total/$this->size);



        return $this -> fetch('',
            [
                'news'=>$news,
                'cats'=>config('cat.lists'),
                'curr'=>$this -> page,
                'pageTotal'=>$pageTotal,
                'total'=>$total,
                'start_time' => empty($data['start_time']) ? '' : $data['start_time'],
                'end_time' => empty($data['end_time']) ? '' : $data['end_time'],
                'title' => empty($data['title']) ? '' : $data['title'],
                'catid' => empty($data['catid']) ? '' : $data['catid'],
                'query' => $query,
            ]);
    }
    public function add(){
        if(request()->isPost()){
            $data = input('post.');
            $res = model('news')->add($data);
//            dump(model('news')->getLastSql());exit;
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