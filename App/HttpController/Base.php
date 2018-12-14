<?php
/**
 * Created by PhpStorm.
 * User: yf
 * Date: 2018/10/26
 * Time: 5:14 PM
 */

namespace App\HttpController;


use EasySwoole\EasySwoole\ServerManager;
use EasySwoole\EasySwoole\Trigger;
use EasySwoole\Http\AbstractInterface\Controller;
use EasySwoole\Http\Message\Status;
use EasySwoole\Spl\SplBean;
use EasySwoole\Validate\Validate;

abstract class Base extends TpViewController
{
    function index()
    {
        // TODO: Implement index() method.
        $this->actionNotFound('index');
    }

    /**
     * 过滤Html代码
     * @param  mixed $param (需要过滤的部分) string|SplBean|array
     * @param array  $unFilter （排除过滤的部分|当$param 为String时无效） array  [fieldName,fieldName,...]
     * @return \Closure|string   array or SplBean orString
     * dome :
     * $this->filter(new SplBean( $this->request()->getQueryParams(),['id']));
     */
    protected function filter($param, $unFilter = [])
    {
        if (is_array($param)) {
            $returnList = (function () use ($param, $unFilter) {
                foreach ($param as $k => $v) {
                    if (!in_array($k, $unFilter))
                        $returnList[$k] = htmlspecialchars($v);
                }
            });
        } else if ($param instanceof SplBean) {
            $list = $param->toArray([], $param::FILTER_NOT_EMPTY);
            foreach ($list as $k => $v) {
                $func = 'set' . ucfirst($k);
                if (!in_array($k, $unFilter))
                    $param->$func(htmlspecialchars($v));
            }
            return $param;
        } else {
            $returnList = htmlspecialchars($param);
        }
        return $returnList;
    }

    protected function actionNotFound(?string $action): void
    {
        $this->writeJson(404);
    }

    protected function onException(\Throwable $throwable): void
    {
        Trigger::getInstance()->throwable($throwable);
        $this->writeJson(500, null, $throwable->getMessage() . " at file {$throwable->getFile()} line {$throwable->getLine()}");
    }

    /**
     * 接口返回一个数据(layui格式)
     * @param string $msg 返回给前端的消息
     * @param mixed  $data 返回给前端的数据
     * @param int    $code 操作状态码 成功统一返回0
     * @return bool
     * @author: eValor < master@evalor.cn >
     */
    function writeJson($msg = null, $data = null, $code = 0)
    {
        if (!$this->response()->isEndResponse()) {
            $data = Array(
                "code" => $code,
                "data" => $data,
                "msg"  => $msg
            );
            $this->response()->write(json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
            $this->response()->withHeader('Content-type', 'application/json;charset=utf-8');
            $this->response()->withStatus(Status::CODE_OK);
            return true;
        } else {
            return false;
        }
    }

    /**
     * 接口返回一个列表(layui表格使用)
     * @param string $msg 返回给前端的消息
     * @param array  $data 返回给前端的数据 [ [data1] , [data2] ]
     * @param int    $count 数据总条数(前端按该数字计算分页数量)
     * @param int    $code 操作状态码 成功统一返回0
     * @return bool
     * @author: eValor < master@evalor.cn >
     */
    function writeJsonList($msg = '', $data = [], $count = 0, $code = 0)
    {
        if (!$this->response()->isEndResponse()) {
            $data = Array(
                "code"  => $code,
                "msg"   => $msg,
                "count" => $count,
                "data"  => $data,
            );
            $this->response()->write(json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
            $this->response()->withHeader('Content-type', 'application/json;charset=utf-8');
            $this->response()->withStatus(Status::CODE_OK);
            return true;
        } else {
            return false;
        }
    }

    /**
     * 判断访问是否有传输参数
     * @param $rules
     * @return array|bool|mixed
     */
    protected function paramIsSet($rules)
    {
        if (!empty($rules)) {
            $validate = new Validate();
            foreach ($rules as $ruleName) {
                $validate->addColumn($ruleName)->required()->lengthMin(1);;
            }
            if ($this->validate($validate)) {
                return $this->request()->getRequestParam();
            } else {
                $this->writeJson('fail', $validate->getError()->__toString(), 400);
                return false;
            }
        } else {
            return $this->request()->getRequestParam();
        }
    }

    /**
     * 获取用户的真实IP
     * @param string $headerName 代理服务器传递的标头名称
     * @return string
     */
    protected function clientRealIP($headerName = 'x-real-ip')
    {
        $server = ServerManager::getInstance()->getSwooleServer();
        $client = $server->getClientInfo($this->request()->getSwooleRequest()->fd);
        $clientAddress = $client['remote_ip'];
        $xri = $this->request()->getHeader($headerName);
        $xff = $this->request()->getHeader('x-forwarded-for');
        if ($clientAddress === '127.0.0.1') {
            if (!empty($xri)) {  // 如果有xri 则判定为前端有NGINX等代理
                $clientAddress = $xri[0];
            } elseif (!empty($xff)) {  // 如果不存在xri 则继续判断xff
                $list = explode(',', $xff[0]);
                if (isset($list[0])) $clientAddress = $list[0];
            }
        }
        return $clientAddress;
    }
}