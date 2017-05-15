<?php
include '../vendor/autoload.php';

use luffyzhao\wxhelper\exception\ClientError;
use luffyzhao\wxhelper\exception\NetworkError;
use luffyzhao\wxhelper\exception\ServerError;
use luffyzhao\wxhelper\library\Http;

$request = new Http;

try {

    $request->failOnError();
    $request->get("http://www.baidu.com/");
    $body = $request->getBody();
    $contentType = $request->getHeader("Content-Type");

    echo $body;
} catch (NetworkError $e) {
    echo $e->getMessage();
} catch (ClientError $e) {
    echo $e->getMessage();
} catch (ServerError $e) {
    echo $e->getMessage();
}
