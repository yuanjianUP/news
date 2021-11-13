<?php
/**
 * Created by PhpStorm.
 * User: jian
 * Date: 2019/2/28
 * Time: 16:33
 */
return [
    'password_salt'=>'_md6yuan',
    'aeskey' => 'gaofs12dfa1251', //aes 秘钥
    'apptypes' => [
        'ios',
        'android',
    ],
    'app_sign_time' => 10, //失效时间
    'app_sign_cache_time' => 20, //sign缓存失效时间
];