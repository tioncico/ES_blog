<?php
/**
 * Created by PhpStorm.
 * User: evalor
 * Date: 2018/7/7
 * Time: 下午7:52
 */

namespace App\HttpController;

use App\Utility\OssClient;
use EasySwoole\Http\Message\Status;
use EasySwoole\Utility\File;

/**
 * 文件上传管理
 * Class Upload
 * @author  : evalor <master@evalor.cn>
 * @package App\HttpController
 */
class Upload extends Base
{
    /**
     * 图片上传
     * @author : evalor <master@evalor.cn>
     */
    function image()
    {
        $filePath = $this->saveToLocal();
        if ($filePath) {
            var_dump($this->request()->getUploadedFiles());
            $result = $this->saveToOss($filePath);
            unlink($filePath);
            $this->writeJson($result ? 0 : Status::CODE_BAD_REQUEST, [ 'src' => $result ], $result ? '上传成功' : '文件上传失败');
        } else {
            $this->writeJson(Status::CODE_BAD_REQUEST, false, '文件上传失败');
        }
    }

    /**
     * ueditor 专用上传
     * @author : evalor <master@evalor.cn>
     */
    function ueditor()
    {
        $filePath = $this->saveToLocal();
        if ($filePath) {
            $result = $this->saveToOss($filePath);
            unlink($filePath);
            $ueUploadResult = [
                "code" => $result?0:400,
                "msg"         => $result?:'bad',
                "data"          => [
                    "src"=>$result,
                    "title"=>""
                ]

            ];
            $this->response()->write(json_encode($ueUploadResult));
        } else {
            $this->writeJson(Status::CODE_BAD_REQUEST, false, '文件上传失败');
        }
    }

    /**
     * 上传到本地
     * TODO 如果仅本地上传 此方法需要做后缀检测等安全判断
     * @author : evalor <master@evalor.cn>
     * @return bool
     */
    private function saveToLocal()
    {
        try {
            $file = $this->request()->getUploadedFile('file');
            if (!$file) $file = $this->request()->getUploadedFile('upload');
            $extensionName = substr(strrchr($file->getClientFilename(), '.'), 1);
            $fileName = date('ymdHis') . rand(1000, 9999);
            $savePath = EASYSWOOLE_ROOT . '/Temp/';
            $saveFullPath = $savePath . '/' . $fileName . '.' . $extensionName;
            File::moveFile($file->getTempName(),$saveFullPath);
            //$file->moveTo($saveFullPath);
            return $saveFullPath;
        } catch (\Throwable $throwable) {
            return false;
        }
    }

    /**
     * 本地文件路径
     * @param $filePath
     * @author : evalor <master@evalor.cn>
     * @return bool|string
     */
    private function saveToOss($filePath,$isPrivate=true)
    {
        try {
            $oss = new OssClient;
            $ossClient = $oss->aliOssClient();
            $ossBucket = $oss->getOssBucket();
            $fileName = basename($filePath);
            $ossClient->uploadFile($ossBucket, $fileName, $filePath);
            $ossClient->putObjectAcl($ossBucket, $fileName, $ossClient::OSS_ACL_TYPE_PUBLIC_READ);
            $conf = \EasySwoole\EasySwoole\Config::getInstance()->getConf('ALI_OSS');
            return  "http://".$conf['BUCKET'].'.'.$conf['END_POINT'] .'/'. $fileName;
        } catch (\Throwable $e) {
            return false;
        }
    }
}