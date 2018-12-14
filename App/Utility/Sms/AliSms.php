<?php
/**
 * Created by PhpStorm.
 * User: evalor
 * Date: 2018-11-22
 * Time: 18:03
 */

namespace App\Utility\Sms;

class AliSms extends BaseApiRequest
{
    protected $accessKeyId, $accessKeySecret;

    function __construct($accessKeyId, $accessKeySecret)
    {
        $this->accessKeyId = $accessKeyId;
        $this->accessKeySecret = $accessKeySecret;
    }

    /**
     * 发送一条短信
     * @param string $mobileNumbers 需要发送的手机号码，多个号码可以英文逗号隔开
     * @param string $signName 短信签名 必须是已有的签名
     * @param string $templateCode 短信模板ID
     * @param array $templateParam 短信模板参数 某些模板可空
     * @param string $outId 外部流水号 可空
     * @return bool|mixed
     */
    function sendSms($mobileNumbers, $signName, $templateCode, $templateParam = [], $outId = '')
    {
        $params = array();
        $params['RegionId'] = "cn-hangzhou";
        $params['Action'] = "SendSms";
        $params['Version'] = "2017-05-25";
        $params["PhoneNumbers"] = $mobileNumbers;
        $params["SignName"] = $signName;
        $params["TemplateCode"] = $templateCode;
        if (!empty($templateParam)) $params["TemplateParam"] = json_encode($templateParam, JSON_UNESCAPED_UNICODE);
        if (!empty($outId)) $params["OutId"] = $outId;
        $helper = new AliSignatureHelper;
        $requestUriParam = $helper->makeUrlParam($params, $this->accessKeyId, $this->accessKeySecret);
        $response = $this->_requestGet("/?{$requestUriParam}");
        $data = $this->parserJsonResponse($response);
        if ($data && !isset($data['errcode']) && isset($data['ticket'])) {
            return $data;
        } else {
            $this->lastErrno = $data['Code'];
            $this->lastError = $data['Message'];
            return false;
        }
    }
}