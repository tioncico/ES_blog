<?php
/**
 * Created by PhpStorm.
 * User: yf
 * Date: 2018/5/28
 * Time: 下午6:33
 */

namespace EasySwoole\EasySwoole;


use App\Utility\Pool\MysqlPool;
use App\Utility\Pool\RedisPool;
use EasySwoole\Component\Pool\PoolManager;
use EasySwoole\EasySwoole\Swoole\EventRegister;
use EasySwoole\EasySwoole\AbstractInterface\Event;
use EasySwoole\Http\Request;
use EasySwoole\Http\Response;
use EasySwoole\Utility\File;

class EasySwooleEvent implements Event
{

    public static function initialize()
    {
        // TODO: Implement initialize() method.
        date_default_timezone_set('Asia/Shanghai');
        self::loadConf();

        //注册数据库、Redis连接
        PoolManager::getInstance()->register(MysqlPool::class, Config::getInstance()->getConf('MYSQL.POOL_MAX_NUM'));
        PoolManager::getInstance()->register(RedisPool::class, Config::getInstance()->getConf('REDIS.POOL_MAX_NUM'));

    }

    public static function mainServerCreate(EventRegister $register)
    {
        // TODO: Implement mainServerCreate() method.
    }

    public static function onRequest(Request $request, Response $response): bool
    {
        $response->withHeader('Content-type', 'text/html;charset=utf-8');
        // TODO: Implement onRequest() method.
        return true;
    }

    public static function afterRequest(Request $request, Response $response): void
    {
        // TODO: Implement afterAction() method.
    }

    public static function onReceive(\swoole_server $server, int $fd, int $reactor_id, string $data):void
    {

    }


    /**
     * 加载配置文件
     */
    public static function loadConf(){
        $files = File::scanDirectory(EASYSWOOLE_ROOT.'/App/Config');
        if(is_array($files)){
            foreach ($files['files'] as $file) {
                $fileNameArr= explode('.',$file);
                $fileSuffix = end($fileNameArr);
                if($fileSuffix=='php'){
                    Config::getInstance()->loadFile($file);
                }elseif($fileSuffix=='env'){
                    Config::getInstance()->loadEnv($file);
                }
            }
        }
    }
}