<?php
/**
 * Created by PhpStorm.
 * User: evalor
 * Date: 2018-11-22
 * Time: 16:17
 */

namespace App\Utility\Wechat;

use App\Utility\WeChat\Base\BaseApiClass;

/**
 * 模板消息相关操作
 * Class TemplateMessage
 * @package App\Utility\Wechat
 */
class TemplateMessage extends BaseApiClass
{

    /**
     * 发送一条模板消息
     * @param string $toUser
     * @param string $templateId
     * @param array $data
     * @param string $url
     * @return array|bool|mixed
     */
    function sendTemplateMsg($toUser, $templateId, $data = [], $url = '')
    {
        $requestData = ['touser' => $toUser, 'template_id' => $templateId];
        if ($url) $requestData['url'] = $url;
        if ($data) $requestData['data'] = $data;
        $response = $this->_requestPostJson('/message/template/send', $requestData, ['access_token' => $this->accountBean->getAccessToken()]);
        $data = $this->parserJsonResponse($response);
        if ($data && $data['errcode'] == 0) {
            return $data['msgid'];
        } else {
            $this->lastErrno = $data['errcode'];
            $this->lastError = $data['errmsg'];
            return false;
        }
    }
}