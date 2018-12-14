<?php
/**
 * Created by PhpStorm.
 * User: evalor
 * Date: 2018-11-22
 * Time: 16:55
 */

namespace App\Utility\Wechat;

use App\Utility\Wechat\Base\BaseApiClass;

/**
 * 网页授权
 * Class Auth
 * @package App\Utility\Wechat
 */
class Auth extends BaseApiClass
{
    protected $baseApiPath = 'https://api.weixin.qq.com/sns';

    const SCOPE_SNSAPI_BASE = 'snsapi_base';
    const SCOPE_SNSAPI_USER_INFO = 'snsapi_userinfo';

    /**
     * 获取跳转链接
     * @param string $redirectUri 跳转到目标
     * @param string $scope 可选 SCOPE_SNSAPI_BASE|SCOPE_SNSAPI_USER_INFO
     * @param string $state 携带的数据
     * @return string
     */
    function getRedirectUri($redirectUri = '', $scope = Auth::SCOPE_SNSAPI_BASE, $state = '')
    {
        $appId = $this->accountBean->getAppId();
        $redirectUri = urlencode($redirectUri);
        return "https://open.weixin.qq.com/connect/oauth2/authorize?appid={$appId}&redirect_uri={$redirectUri}&response_type=code&scope={$scope}&state={$state}#wechat_redirect";
    }

    /**
     * 使用code换取用户AccessToken
     * @param string $code
     * @return bool|mixed
     */
    function codeToAccessToken($code)
    {
        $appId = $this->accountBean->getAppId();
        $appSecret = $this->accountBean->getAppSecret();
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