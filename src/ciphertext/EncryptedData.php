<?php
namespace luffyzhao\wxhelper\ciphertext;

use luffyzhao\wxhelper\library\ErrorCode;

/**
 * 微信小程序-包括敏感数据在内的完整用户信息的加密数据
 */
class EncryptedData
{
    /**
     * 小程序 appid
     * @var [type]
     */
    private $appid;
    /**
     * session_key
     * @var [type]
     */
    private $sessionKey;
    /**
     * 错误
     * @var [type]
     */
    private $error;
    /**
     * 构造函数
     * @method   __construct
     * @DateTime 2017-05-15T10:46:22+0800
     * @param    [type]                   $appid      [description]
     * @param    [type]                   $sessionKey [description]
     */
    public function __construct(string $appid, string $sessionKey)
    {
        $this->appid = $appid;
        $this->sessionKey = $sessionKey;
    }
    /**
     * 验证
     * @method   vadidate
     * @DateTime 2017-05-15T10:48:39+0800
     * @param    [type]                   $encryptedData [description]
     * @param    [type]                   $iv            [description]
     * @return   [type]                                  [description]
     */
    public function decode(string $encryptedData, string $iv)
    {
        if (strlen($this->sessionKey) != 24) {
            $this->error = ErrorCode::$IllegalAesKey;
            return false;
        }
        $aesKey = base64_decode($this->sessionKey);

        if (strlen($iv) != 24) {
            $this->error = ErrorCode::$IllegalIv;
            return false;
        }
        $aesIV = base64_decode($iv);

        $aesCipher = base64_decode($encryptedData);

        $mcrypt = new Mcrypt($aesKey);
        if (($decrypted = $mcrypt->decode($aesCipher, $aesIV)) === false) {
            $this->error = ErrorCode::$IllegalBuffer;
            return false;
        }

        $pkcs7 = new Pkcs7();
        if (($result = $pkcs7->decode($decrypted)) === false) {
            $this->error = ErrorCode::$IllegalBuffer;
            return false;
        }

        return $result;
    }
    /**
     * 获取错误信息
     * @method   getError
     * @DateTime 2017-05-15T10:49:31+0800
     * @return   [type]                   [description]
     */
    public function getError()
    {
        return $this->error;
    }
}
