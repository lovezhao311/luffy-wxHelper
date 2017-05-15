<?php
namespace luffyzhao\wxhelper\validate;

/**
 * 小程序-用户数据的签名
 */
class Applet
{
    /**
     * [$sessionKey description]
     * @var [type]
     */
    protected $sessionKey;
    /**
     * 构造函数
     * @method   __construct
     * @DateTime 2017-05-15T14:09:41+0800
     * @param    string                   $sessionKey [description]
     */
    public function __construct(string $sessionKey)
    {
        $this->sessionKey = $sessionKey;
    }
    /**
     * 验证
     * @method   validate
     * @DateTime 2017-05-15T14:10:39+0800
     * @param    [type]                   $rawData   [description]
     * @param    [type]                   $signature [description]
     * @return   [type]                              [description]
     */
    public function validate(string $rawData, string $signature)
    {
        $mysign = sha1($rawData . $this->sessionKey);
        return ($mysign === $signature) ? true : false;
    }
}
