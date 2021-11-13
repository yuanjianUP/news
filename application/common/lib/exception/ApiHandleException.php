<?php
/**
 * Created by PhpStorm.
 * User: jian
 * Date: 2019/6/13
 * Time: 18:02
 */

namespace app\common\lib\exception;
use Exception;
use think\exception\Handle;

class ApiHandleException extends Handle
{
    public $httpCode = 500;
    public function render(\Exception $e)
    {
        if(config('app_debug') == true){
            return parent::render($e);
        }
        if($e instanceof ApiException){
            $this -> httpCode;
        }
        return show(0,$e->getMessage(),[],$this -> httpCode);
    }
}