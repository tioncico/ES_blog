<?php
/**
 * Created by PhpStorm.
 * User: evalor
 * Date: 2018-11-22
 * Time: 10:25
 */

namespace App\Utility;

use EasySwoole\EasySwoole\Config;

class Hashids
{
    /**
     * 编码商家ID
     * @param integer $id
     * @return string
     */
    static function encode($id)
    {
        $config = Config::getInstance()->getConf('HASHIDS');
        $hashids = new \Hashids\Hashids($config['salt'], $config['min_length']);
        return $hashids->encode($id);
    }

    /**
     * 解码商家ID
     * @param string $hash
     * @return mixed
     */
    static function decode($hash)
    {
        $config = Config::getInstance()->getConf('HASHIDS');
        $hashids = new \Hashids\Hashids($config['salt'], $config['min_length']);
        $id = $hashids->decode($hash);
        return $id ? $id[0] : false;
    }
}