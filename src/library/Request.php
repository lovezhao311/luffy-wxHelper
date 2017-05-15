<?php
namespace luffyzhao\wxhelper\library;

use luffyzhao\wxhelper\exception\ClientException;
use luffyzhao\wxhelper\exception\NetworkException;
use luffyzhao\wxhelper\exception\RequestException;
use luffyzhao\wxhelper\exception\ServerException;

/**
 *
 */
abstract class Request
{
    /**
     * 第三方用户唯一凭证
     * @var [type]
     */
    protected $appid;
    /**
     * 第三方用户唯一凭证密钥 即appsecret
     * @var [type]
     */
    protected $secret;
    /**
     * 请求uri
     * @var [type]
     */
    protected $uri;
    /**
     * 请求参数
     * @var array
     */
    protected $params = [];
    /**
     * 请求方式
     * @var [type]
     */
    protected $method = 'GET';

    /**
     * @var boolean
     */
    protected $failOnError;

    /**
     * 构造函数
     * @method   __construct
     * @DateTime 2017-05-15T13:19:19+0800
     * @param    array                    $config [description]
     */
    public function __construct(string $appid, string $secret)
    {
        $this->appid = $appid;
        $this->secret = $secret;
    }
    /**
     * 发送请求
     * @method   run
     * @DateTime 2017-05-15T14:02:10+0800
     * @throw RequestException
     * @return   [type]                   [description]
     */
    public function run()
    {
        $http = new Http;
        try {
            switch ($this->method) {
                case 'POST':
                    $http->post($this->uri, $this->params);
                    break;
                case 'GET':
                    $http->get($this->uri, $this->params);
                    break;
                default:
                    throw new ClientException('未知的请求方式', 405);
                    break;
            }
        } catch (ClientException $e) {
            throw new RequestException($e->getMessage(), $e->getStatus());
        } catch (NetworkException $e) {
            throw new RequestException($e->getMessage(), $e->getCode());
        } catch (ServerException $e) {
            throw new RequestException($e->getMessage(), $e->getStatus());
        }
        $body = $http->getBody();
        $response = json_decode($body, true);
        if ($response === false || $response === null) {
            throw new RequestException('数据不正确', 500);
        }

        if (isset($response['errcode'])) {
            throw new RequestException($response['errmsg'], $response['errcode']);
        }

        return $response;
    }

}
