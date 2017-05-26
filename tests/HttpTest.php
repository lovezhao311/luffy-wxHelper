<?php
use luffyzhao\wxhelper\library\Http;
use PHPUnit\Framework\TestCase;

/**
 *
 */
class HttpTest extends TestCase
{
    protected $request;
    public function setUp()
    {
        $this->request = new Http;
    }

    public function testGet()
    {
        $this->request->failOnError();
        $this->request->get("http://www.baidu.com/");
        $body = $this->request->getBody();
        $contentType = $this->request->getHeader("Content-Type");

        print $this->request->getStatus();
    }
}
