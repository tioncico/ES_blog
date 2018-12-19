<?php
/**
 * Created by PhpStorm.
 * User: Apple
 * Date: 2018/12/13 0013
 * Time: 11:32
 */
include "./vendor/autoload.php";
\EasySwoole\EasySwoole\Core::getInstance()->initialize();
go(function (){
    $a = new \App\Utility\ModelBuilder('/www/wwwroot/es_blog/App/Model');
    $a->buildFromDbName('es_blog','App\Model','BaseModel','xsk_');
});