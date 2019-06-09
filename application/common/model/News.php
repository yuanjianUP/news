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
    /**获取数据
     * @param array $data
     * @param $from
     * @param $size
     * @return false|\PDOStatement|string|\think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getNews($data=[],$from,$size=5){
        $data['status'] = ['eq',1];
        $order = ['id'=>'desc'];
        $result = $this->where($data)
            ->order($order)
            ->limit($from,$size)
            ->select();
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