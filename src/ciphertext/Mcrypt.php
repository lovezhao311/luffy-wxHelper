<?php
namespace luffyzhao\wxhelper\ciphertext;

use Exception;

/**
 * 对称加解密使用的算法为 AES-128-CBC，数据采用PKCS#7填充
 */
class Mcrypt
{
    protected $key = '';

    /**
     * [__construct description]
     * @method   __construct
     * @DateTime 2017-05-15T10:18:36+0800
     * @param    string                   $key 用于 mcrypt_generic_init
     */
    public function __construct(string $key = '')
    {
        $this->key = $key;
    }
    /**
     * 对明文进行加密
     * @param string $cipher 需要加密的明文
     * @param string $iv 加密的初始向量
     * @return 加密得到密文
     */
    public function encode(string $cipher, string $iv)
    {
        try {
            $module = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', MCRYPT_MODE_CBC, '');
            mcrypt_generic_init($module, $this->key, $iv);
            //解密
            $encode = mcrypt_generic($module, $cipher);
            mcrypt_generic_deinit($module);
            mcrypt_module_close($module);
        } catch (Exception $e) {
            return false;
        }

        return $encode;
    }
    /**
     * 对密文进行解密
     * @param string $cipher 需要解密的密文
     * @param string $iv 解密的初始向量
     * @return string 解密得到的明文
     */
    public function decode(string $cipher, string $iv)
    {
        try {
            $module = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', MCRYPT_MODE_CBC, '');
            mcrypt_generic_init($module, $this->key, $iv);
            //解密
            $decode = mdecrypt_generic($module, $cipher);
            mcrypt_generic_deinit($module);
            mcrypt_module_close($module);
        } catch (Exception $e) {
            return false;
        }
        return $decode;
    }
}
