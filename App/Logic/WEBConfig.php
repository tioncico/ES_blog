<?php
/**
 * Created by PhpStorm.
 * User: Apple
 * Date: 2018/12/14 0014
 * Time: 15:27
 */

namespace App\Logic;


use App\Model\ConditionBean;
use App\Model\Config;
use App\Utility\Pool\MysqlDbObject;
use App\Utility\Pool\MysqlPool;
use EasySwoole\Component\Singleton;

class WEBConfig
{
    use Singleton;

    function getConfig(){
        $list = $this->getPageList(Config::class,new ConditionBean(),-1);
        $config=[];
        foreach ($list as $value){
            $config[$value['name']] = $value['value'];
        }
        return $config;
    }

    function getPageList(String $modelName, ConditionBean $conditionBean = null, int $page = 1, int $limit = 20, $filed = '*')
    {
        $data = MysqlPool::invoke(function (MysqlDbObject $mysqlDbObject) use ($modelName, $conditionBean, $page, $limit, $filed) {
            $model = new $modelName($mysqlDbObject);
            $data = $model->conditionBuild($conditionBean)->getAll($page, $limit, $filed);
//            var_dump($mysqlDbObject->getLastQuery());
            return $data;
        });
        return $data;
    }

}