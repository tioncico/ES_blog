<?php
/**
 * Created by PhpStorm.
 * User: evalor
 * Date: 2018-11-22
 * Time: 17:11
 */

namespace App\Utility\Wechat;

use App\Utility\Wechat\Base\BaseApiRequest;
use App\Utility\Wechat\Base\OpenAccountBean;

class OpenAuth extends BaseApiRequest
{
    protected $openAccountBean;
    protected $baseApiPath = 'https://api.weixin.qq.com/sns';

    function __construct(OpenAccountBean $openAccountBean)
    {
        $this->openAccountBean = $openAccountBean;
    }

    /**
     * 获取跳转链接
     * @param string $redirectUri 跳转到目标
     * @param string $state 携带的数据
     * @return string
     */
    function getRedirectUri($redirectUri = '', $state = '')
    {
        $appId = $this->openAccountBean->getAppId();
        $redirectUri = urlencode($redirectUri);
        return "https://open.weixin.qq.com/connect/qrconnect?appid={$appId}&redirect_uri={$redirectUri}&response_type=code&scope=snsapi_login&state={$state}#wechat_redirect";
    }

    /**
     * 使用code换取用户AccessToken
     * @param string $code
     * @return bool|mixed
     */
    function codeToAccessToken($code)
    {
        $appId = $this->openAccountBean->getAppId();
        $appSecret = $this->openAccountBean->getAppSecret();
        $requestData = ['appid' => $appId, 'secret' => $appSecret, 'code' => $code, 'grant_type' => 'authorization_code'];
        $response = $this->_requestGet('/oauth2/access_token', $requestData);
        $data = $this->parserJsonResponse($response);
        if ($data && !isset($data['errcode']) && isset($data['access_token'])) {
            return $data;
        } else {
            $this->lastErrno = $data['errcode'];
            $this->lastError = $data['errmsg'];
            return false;
        }
    }

    /**
     * 获取用户信息
     * @param string $openId
     * @param string $accessToken
     * @return bool|mixed
     */
    function getUserInfo($openId, $accessToken)
    {
        $requestData = ['access_token' => $accessToken, 'openid' => $openId, 'lang' => 'zh_CN'];
        $response = $this->_requestGet('/userinfo', $requestData);
        $data = $this->parserJsonResponse($response);
        if ($data && !isset($data['errcode']) && isset($data['openid'])) {
            return $data;
        } else {
            $this->lastErrno = $data['errcode'];
            $this->lastError = $data['errmsg'];
            return false;
        }
    }

}