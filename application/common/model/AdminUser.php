<?php
/**
 * Created by PhpStorm.
 * User: jian
 * Date: 2019/2/28
 * Time: 11:15
 */

namespace app\common\model;


use think\Model;

class AdminUser extends Model
{
    protected $autoWriteTimestamp=true;
    public function add($data){
        if(!is_array($data)){
            exception('数据不合法');
        }
        AdminUser::allowField(true)->save($data);
        return $this->id;
    }
}