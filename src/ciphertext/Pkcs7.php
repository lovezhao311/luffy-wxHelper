<?php
namespace luffyzhao\wxhelper\ciphertext;

/**
 * 对称加解密使用的算法为 AES-128-CBC，数据采用PKCS#7填充
 */
class Pkcs7
{
    protected static $blockSize = 16;
    /**
     * 对需要加密的明文进行填充补位
     * @param $text 需要进行填充补位操作的明文
     * @return 补齐明文字符串
     */
    public function encode(string $text)
    {
        $textLength = strlen($text);
        //计算需要填充的位数
        $amountToPad = Pkcs7::$blockSize - ($textLength % Pkcs7::$blockSize);
        if ($amountToPad == 0) {
            $amountToPad = Pkcs7::$blockSize;
        }
        //获得补位所用的字符
        $padChr = chr($amountToPad);
        $tmp = "";
        for ($index = 0; $index < $amountToPad; $index++) {
            $tmp .= $padChr;
        }
        return $text . $tmp;
    }

    /**
     * 对解密后的明文进行补位删除
     * @param decrypted 解密后的明文
     * @return 删除填充补位后的明文
     */
    public function decode(string $text)
    {
        $pad = ord(substr($text, -1));
        if ($pad < 1 || $pad > 32) {
            $pad = 0;
        }
        return substr($text, 0, (strlen($text) - $pad));
    }
}
