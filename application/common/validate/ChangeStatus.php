<?php
/**
 * Created by PhpStorm.
 * User: jian
 * Date: 2019/6/11
 * Time: 22:09
 */

namespace app\common\validate;

use think\Validate;
class ChangeStatus extends Validate
{
    protected $rule = [
        'id'          => 'require',
        'status'      => 'number',
    ];
}