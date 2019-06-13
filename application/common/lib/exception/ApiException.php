<?php
/**
 * Created by PhpStorm.
 * User: jian
 * Date: 2019/6/13
 * Time: 18:06
 */

namespace app\common\lib\exception;
use think\Exception;
use Throwable;

class ApiException extends Exception
{
    public $message;
    public $httpCode;
    public $code;
    public function __construct($message = "", $httpCode=0,$code = 0)
    {
        $this -> message = $message;
        $this -> httpCode = $httpCode;
        $this -> code = $code;
    }
}