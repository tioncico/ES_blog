<?php
/**
 * Created by PhpStorm.
 * User: Apple
 * Date: 2018/12/13 0013
 * Time: 11:32
 */
include "./vendor/autoload.php";
\EasySwoole\EasySwoole\Core::getInstance()->initialize();
go(function () {
    $dbConnect = \EasySwoole\Component\Pool\PoolManager::getInstance()->getPool(\App\Utility\Pool\MysqlPool::class)->getObj();
    $model = new \App\Model\BaseModel($dbConnect);
    $data = $model->getDbConnection()->where('aid',[100,103,3],'in')->get('xsk_article');
    var_dump($data);


});