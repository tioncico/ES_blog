<?php
/**
 * Created by PhpStorm.
 * User: evalor
 * Date: 2018-11-22
 * Time: 14:28
 */

namespace App\Utility\Wechat\Base;

use App\Utility\Pool\RedisObject;
use App\Utility\Pool\RedisPool;
use App\Utility\Wechat\AccessToken;
use EasySwoole\Component\Pool\PoolManager;
use EasySwoole\EasySwoole\Config;
use EasySwoole\Spl\SplBean;

/**
 * 微信公众号账户
 * Class AccountBean
 * @package App\Utility\Wechat
 */
class AccountBean extends SplBean
{
    protected $appId;
    protected $appSecret;
    protected $accessToken;
    protected $mchId;
    protected $apiTicket;
    protected $apiPaymentSecret;
    protected $apiClientKeyPath;
    protected $apiClientCertPath;

    function initialize(): void
    {
        $this->initWechatAccessToken();
        parent::initialize();
    }

    /**
     * 初始化当前配置的AccessToken
     * @throws \Exception
     */
    private function initWechatAccessToken()
    {
        $wechatAppId = $this->getAppId();
        if (!empty($wechatAppId)) {
            $accessTokenKey = "accessToken:{$wechatAppId}";
            $timeout = Config::getInstance()->getConf('REDIS.POOL_TIME_OUT');
            /** @var RedisObject $redis */
            $redis = PoolManager::getInstance()->getPool(RedisPool::class)->getObj($timeout);
            if ($redis) {
                $accessToken = $redis->get($accessTokenKey);
                if (!$accessToken) {
                    $access = new AccessToken($this);
                    $token = $access->requestAccessToken();
                    if ($token) {
                        $this->setAccessToken($token);
                        $redis->setex($accessTokenKey, 7000, $token);
                        PoolManager::getInstance()->getPool(RedisPool::class)->recycleObj($redis);
                    } else {
                        PoolManager::getInstance()->getPool(RedisPool::class)->recycleObj($redis);
                        throw new \Exception('Get accessToken failed :' . $access->getLastError(), $access->getLastErrno());
                    }
                } else {
                    $this->setAccessToken($accessToken);
                }
            } else {
                throw new \Exception('Redis pool was empty in function redisGetAccessToken');
            }
        }
    }

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

    /**
     * @return mixed
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     * @param mixed $accessToken
     */
    public function setAccessToken($accessToken): void
    {
        $this->accessToken = $accessToken;
    }

    /**
     * @return mixed
     */
    public function getMchId()
    {
        return $this->mchId;
    }

    /**
     * @param mixed $mchId
     */
    public function setMchId($mchId): void
    {
        $this->mchId = $mchId;
    }

    /**
     * @return mixed
     */
    public function getApiTicket()
    {
        return $this->apiTicket;
    }

    /**
     * @param mixed $apiTicket
     */
    public function setApiTicket($apiTicket): void
    {
        $this->apiTicket = $apiTicket;
    }

    /**
     * @return mixed
     */
    public function getApiPaymentSecret()
    {
        return $this->apiPaymentSecret;
    }

    /**
     * @param mixed $apiPaymentSecret
     */
    public function setApiPaymentSecret($apiPaymentSecret): void
    {
        $this->apiPaymentSecret = $apiPaymentSecret;
    }

    /**
     * @return mixed
     */
    public function getApiClientKeyPath()
    {
        return $this->apiClientKeyPath;
    }

    /**
     * @param mixed $apiClientKeyPath
     */
    public function setApiClientKeyPath($apiClientKeyPath): void
    {
        $this->apiClientKeyPath = $apiClientKeyPath;
    }

    /**
     * @return mixed
     */
    public function getApiClientCertPath()
    {
        return $this->apiClientCertPath;
    }

    /**
     * @param mixed $apiClientCertPath
     */
    public function setApiClientCertPath($apiClientCertPath): void
    {
        $this->apiClientCertPath = $apiClientCertPath;
    }
}