<?php
/**
 * Created by PhpStorm.
 * User: evalor
 * Date: 2018-11-22
 * Time: 15:52
 */

namespace App\Utility\Wechat;

use App\Utility\WeChat\Base\BaseApiClass;

/**
 * 二维码相关操作
 * Class QrCode
 * @package App\Utility\Wechat
 */
class QrCode extends BaseApiClass
{
    const ACTION_QR_SCENE = 'QR_SCENE';
    const ACTION_QR_STR_SCENE = 'QR_STR_SCENE';
    const ACTION_QR_LIMIT_SCENE = 'QR_LIMIT_SCENE';
    const ACTION_QR_LIMIT_STR_SCENE = 'QR_LIMIT_STR_SCENE';

    /**
     * 生成一个二维码
     * @param string|integer $scene 二维码携带的场景值
     * @param string $action 二维码类型
     * @param int $expire 过期时间
     * @return bool
     */
    function create($scene, $action = QrCode::ACTION_QR_STR_SCENE, $expire = 30)
    {
        $sceneType = ($action == QrCode::ACTION_QR_SCENE || $action == QrCode::ACTION_QR_LIMIT_SCENE) ? 'scene_id' : 'scene_str';
        $requestData = ['action_name' => $action, 'expire_seconds' => $expire, 'action_info' => [$sceneType => $scene]];
        $response = $this->_requestPostJson('/qrcode/create', $requestData, ['access_token' => $this->accountBean->getAccessToken()]);
        $data = $this->parserJsonResponse($response);
        if ($data && !isset($data['errcode']) && isset($data['ticket'])) {
            return $data;
        } else {
            $this->lastErrno = $data['errcode'];
            $this->lastError = $data['errmsg'];
            return false;
        }
    }
}