<?php

/**
 * Created by PhpStorm.
 * User: ikirab
 * Date: 06.11.16
 * Time: 9:07
 */
class Crypt
{
    private static $_instance = null;
    private $salt = "$789we!{r4re$";
    private $key = '';

    private function __construct(){}


    public static function getInstance() {
        if (self::$_instance === null) {
            self::$_instance = new self;
        }
        return self::$_instance;
    }


    public function getKey($email){
        $this->key = md5($this->encodeEmail($email) . md5($email));
        return $this->key;
    }

    public function encodeEmail($email = ''){
        return md5($email.$this->salt);
    }

    public function encodePhone($phone = ''){
        return base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $this->key, $phone, MCRYPT_MODE_CBC, md5($this->key)));
    }

    public function decodePhone($phone = ''){
        return rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $this->key, base64_decode($phone), MCRYPT_MODE_CBC, md5($this->key)), "\0");
    }


    protected function __clone(){}
}