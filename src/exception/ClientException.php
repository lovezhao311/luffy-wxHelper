<?php
namespace luffyzhao\wxhelper\exception;

/**
 * 请求发送者错误
 *
 * - 400 Bad Request
 * - 401 Unauthorized
 * - 402 Payment Required
 * - 403 Forbidden
 * - 404 Not Found
 * - 405 Method Not Allowed
 * - 406 Not Acceptable
 * - 407 Proxy Authentication Required4
 * - 408 Request Time-Out
 * - 409 Conflict
 * - 410 Gone
 * - 411 Length Required
 * - 412 Precondition Failed
 * - 413 Request Entity Too Large
 * - 414 Request-URL Too Large
 * - 415 Unsupported Media Type
 * - 416 Requested Range not satisfiable
 * - 417 Expectation failed
 */
class ClientException extends ProtocolException
{}
