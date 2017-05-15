<?php
namespace luffyzhao\wxhelper\request;

/**
 *
 */
class SessionKey
{
    /**
     * 请求uri
     * @var string
     */
    protected $uri = "https://api.weixin.qq.com/sns/jscode2session";
    /**
     * 请求参数
     * @var [type]
     */
    protected $params = [
        'grant_type' => 'authorization_code',
    ];
    /**
     * 请求方式
     * @var string
     */
    protected $method = 'GET';

    public function __construct(string $appid, string $secret)
    {
        parent::__construct($appid, $secret);
        $this->params['appid'] = $appid;
        $this->params['secret'] = $secret;
    }
    /**
     * 设置js_code参数
     * @method   setJsCode
     * @DateTime 2017-05-15T13:28:41+0800
     * @param    [type]                   $code [description]
     */
    public function setJsCode($code)
    {
        $this->params['js_code'] = $code;
    }
}
