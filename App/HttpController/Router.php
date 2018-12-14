<?php
/**
 * Created by PhpStorm.
 * User: eValor
 * Date: 2018/11/12
 * Time: 下午1:26
 */

namespace App\HttpController;

use EasySwoole\Http\AbstractInterface\AbstractRouter;
use EasySwoole\Http\Request;
use EasySwoole\Http\Response;
use FastRoute\RouteCollector;

/**
 * 控制器路由定义
 * Class Router
 * @package App\HttpController
 */
class Router extends AbstractRouter
{
    /**
     * 注册路由
     * @param RouteCollector $routeCollector
     * @author: eValor < master@evalor.cn >
     */
    function initialize(RouteCollector $routeCollector)
    {
        $routeCollector->get('/index','/Home/index');
        $routeCollector->get('/','/Home/index');
        $routeCollector->get('/test','/Index/test');
        $routeCollector->get('/rpc','/Rpc/index');


    }
}