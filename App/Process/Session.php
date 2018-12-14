<?php
/**
 * Created by PhpStorm.
 * User: yzy
 * Date: 2018/10/31
 * Time: 17:08
 */

namespace App\Process;

use EasySwoole\EasySwoole\Config;
use EasySwoole\EasySwoole\Swoole\Process\AbstractProcess;
use Swoole\Process;
use EasySwoole\EasySwoole\Swoole\Time\Timer;
use App\Utility\Pool\RedisPool;
use EasySwoole\Component\Pool\PoolManager;

class Session extends AbstractProcess
{

    public function run(Process $process)
    {
        // TODO: Implement run() method.
        Timer::loop(60 * 1000, function () {
            go(function (){
                $redis = PoolManager::getInstance()->getPool(RedisPool::class)->getObj(Config::getInstance()->getConf('REDIS.POOL_TIME_OUT'));
                // 清除管理员过期
                $list = $redis->hKeys('AdminSession');
                $this->killOverSession($list,'AdminSession',$redis);
                // 清除过期的商户session
                $shopSessions = $redis->hKeys('ShopSession');
                $this->killOverSession($shopSessions,'ShopSession',$redis);
                PoolManager::getInstance()->getPool(RedisPool::class)->recycleObj($redis);
            });
        });
    }

     private function killOverSession($list,$key,$redis){
        $time = time();
        foreach ($list as $v){
            $rs = $redis->hGet($key, $v);
            $rs = json_decode($rs,true);
            $ttl =  isset($rs['ttl'])?$rs['ttl']:null;
            if(empty($ttl)){
                $redis->hDel($key, $v);
                continue ;
            }
            if($ttl < $time){
                if(!empty($rs)){
                    $redis->hDel($key, $v);
                }
            }
        }
    }
    public function onShutDown()
    {
        // TODO: Implement onShutDown() method.
    }

    public function onReceive(string $str)
    {
        // TODO: Implement onReceive() method.
    }
}