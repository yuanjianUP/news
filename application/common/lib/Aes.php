<?php
namespace app\common\lib;

/**
 * aes 加密 解密类库
 * @by singwa
 * Class Aes
 * @package app\common\lib
 */
class Aes {

    private $key = null;

    /**
     *
     * @param $key 		密钥
     * @return String
     */
    public function __construct() {
        // 需要小伙伴在配置文件app.php中定义aeskey
        $this->key = config('app.aeskey');
    }

    /**
     * 加密
     * @param String input 加密的字符串
     * @param String key   解密的key
     * @return HexString
     */
    public function encrypt($string) {
        $iv= md5($this->key,true);
        $strEncode= base64_encode(openssl_encrypt($string, 'AES-128-CBC',$this->key, OPENSSL_RAW_DATA , $iv));
        return $strEncode;
    }
    /**
     * 填充方式 pkcs5
     * @param String text 		 原始字符串
     * @param String blocksize   加密长度
     * @return String
     */
    private function pkcs5_pad($text, $blocksize) {
        $pad = $blocksize - (strlen($text) % $blocksize);
        return $text . str_repeat(chr($pad), $pad);
    }

    /**
     * 解密
     * @param String input 解密的字符串
     * @param String key   解密的key
     * @return String
     */
    public function decrypt($string) {
        $iv= md5($this->key,true);
        $decrypted_string = openssl_decrypt(base64_decode($string), 'AES-128-CBC', $this->key, OPENSSL_RAW_DATA, $iv);
        return $decrypted_string;
    }

}