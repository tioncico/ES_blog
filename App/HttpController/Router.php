<?php
/**
 * Created by PhpStorm.
 * User: eValor
 * Date: 2018/11/12
 * Time: 下午1:26
 */

namespace App\HttpController;

use EasySwoole\EasySwoole\Config;
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
        $homeRoute = Config::getInstance()->getConf('homeroute');
        foreach ($homeRoute as $route){
            $routeCollector->addRoute($route[0],$route[1],$route[2]);
        }
    }
}