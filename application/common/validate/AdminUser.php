<?php
/**
 * Created by PhpStorm.
 * User: jian
 * Date: 2019/2/28
 * Time: 11:04
 */
namespace app\common\validate;
use think\Validate;

class AdminUser extends Validate
{
    protected $rule = [
        'username'=>'require|max:20',
        'password'=>'require|max:20',
    ];
}