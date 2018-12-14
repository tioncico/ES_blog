<?php
/**
 * Created by PhpStorm.
 * User: evalor
 * Date: 2018-11-22
 * Time: 14:33
 */

namespace App\Utility\Wechat\Base;

use EasySwoole\Curl\Field;
use EasySwoole\Curl\Request;
use EasySwoole\Curl\Response;

abstract class BaseApiRequest
{
    protected $baseApiPath = 'https://api.weixin.qq.com/cgi-bin';
    protected $lastErrno;
    protected $lastError;

    /**
     * 处理一个GET请求
     * @param string $uri
     * @param array $requestParam
     * @return Response
     */
    protected function _requestGet($uri, $requestParam = [])
    {
        return $this->_request($this->baseApiPath . $uri, $requestParam);
    }

    /**
     * 处理一个POST请求
     * @param string $uri
     * @param array $requestData
     * @param array $requestParam
     * @return Response
     */
    protected function _requestPost($uri, $requestData = [], $requestParam = [])
    {
        return $this->_request($this->baseApiPath . $uri, $requestParam, $requestData);
    }

    /**
     * 处理一个POST请求
     * @param string $uri
     * @param array $requestData
     * @param array $requestParam
     * @return Response
     */
    protected function _requestPostJson($uri, $requestData = [], $requestParam = [])
    {
        $dataJson = json_encode($requestData);
        $requestOpt = [
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $dataJson
        ];
        return $this->_request($this->baseApiPath . $uri, $requestParam, [], [], $requestOpt);
    }

    /**
     * 发起一次请求
     * @param string $url 请求路径
     * @param array $requestParam Get参数
     * @param array $requestData Post参数
     * @param array $requestCookies 携带Cookie
     * @param array $extraOpt 额外配置
     * @return \EasySwoole\Curl\Response 响应Response
     */
    protected function _request($url, $requestParam = [], $requestData = [], $requestCookies = [], $extraOpt = [])
    {
        $request = new Request($url);
        if (!empty($requestParam)) {
            foreach ($requestParam as $requestParamName => $requestParamValue) {
                $request->addGet((new Field($requestParamName, $requestParamValue)));
            }
        }
        if (!empty($requestData)) {
            foreach ($requestData as $requestDataName => $requestDataValue) {
                $request->addPost((new Field($requestDataName, $requestDataValue)));
            }
        }
        if (!empty($requestCookies)) {
            foreach ($requestCookies as $requestCookie) {
                $request->addCookie($requestCookie);
            }
        }
        if (!empty($extraOpt)) {
            $request->setUserOpt($extraOpt);
        }
        $response = $request->exec();
        return $response;
    }

    /**
     * 获取Json响应内容
     * @param Response $response
     * @return bool|mixed
     */
    protected function parserJsonResponse(Response $response)
    {
        if ($response->getErrorNo()) {
            $this->lastErrno = $response->getErrorNo();
            $this->lastError = $response->getError();
            return false;
        } else {
            $responseContent = $response->getBody();
            $content = json_decode($responseContent, true);
            if (json_last_error()) {
                $this->lastErrno = json_last_error();
                $this->lastError = json_last_error_msg();
                return false;
            }
            return $content;
        }
    }

    /**
     * 获取最后的错误代码
     * @return mixed
     */
    public function getLastErrno()
    {
        return $this->lastErrno;
    }

    /**
     * 获取最后的错误消息
     * @return mixed
     */
    public function getLastError()
    {
        return $this->lastError;
    }

}