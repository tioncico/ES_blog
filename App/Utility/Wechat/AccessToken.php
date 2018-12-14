<?php
/**
 * Created by PhpStorm.
 * User: evalor
 * Date: 2018-11-22
 * Time: 14:32
 */

namespace App\Utility\Wechat;

use App\Utility\WeChat\Base\BaseApiClass;

class AccessToken extends BaseApiClass
{
    /**
     * 请求返回一个AccessToken
     * @example  https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=APPID&secret=APPSECRET
     */
    function requestAccessToken()
    {
        $appId = $this->accountBean->getAppId();
        $appSecret = $this->accountBean->getAppSecret();
        $requestParam = ['grant_type' => 'client_credential', 'appid' => $appId, 'secret' => $appSecret];
        $response = $this->_requestGet('/token', $requestParam);
        $data = $this->parserJsonResponse($response);
        if ($data && !isset($data['errcode']) && isset($data['access_token'])) {
            return $data['access_token'];
        } else {
            $this->lastErrno = $data['errcode'];
            $this->lastError = $data['errmsg'];
            return false;
        }
    }
}