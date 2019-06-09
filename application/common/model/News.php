<?php
/**
 * Created by PhpStorm.
 * User: jian
 * Date: 2019/3/14
 * Time: 23:28
 */

namespace app\common\model;


use think\Model;

class News extends Model
{
    public function getNews($data=[]){
        $data['status'] = ['eq',1];
        $order = ['id'=>'desc'];
        $result = $this->where($data)
            ->order($order)
            ->paginate();
        return $result;
    }
    public function add($data){
        $res = $this->allowField(true)->save($data);
        return $this -> id;

    }
    public function getNewsTotal($condition=[]){
        if(!isset($condition['status'])){
            $condition['status'] = [
                'neq',0
            ];
        }
        return $this -> where($condition)
            ->count();
    }
}