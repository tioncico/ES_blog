<?php
/**
 * Created by PhpStorm.
 * User: evalor
 * Date: 2018-11-22
 * Time: 17:12
 */

namespace App\Utility\Wechat\Base;

use EasySwoole\Spl\SplBean;

/**
 * 开放平台账号
 * Class OpenAccountBean
 * @package App\Utility\Wechat\Base
 */
class OpenAccountBean extends SplBean
{
    protected $appId;
    protected $appSecret;

    /**
     * @return mixed
     */
    public function getAppId()
    {
        return $this->appId;
    }

    /**
     * @param mixed $appId
     */
    public function setAppId($appId): void
    {
        $this->appId = $appId;
    }

    /**
     * @return mixed
     */
    public function getAppSecret()
    {
        return $this->appSecret;
    }

    /**
     * @param mixed $appSecret
     */
    public function setAppSecret($appSecret): void
    {
        $this->appSecret = $appSecret;
    }
}