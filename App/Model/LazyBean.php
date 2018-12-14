<?php
/**
 * Created by PhpStorm.
 * User: yangzhenyu
 * Date: 2018/11/27
 * Time: 下午1:41
 */

namespace App\Model;


use EasySwoole\Spl\SplBean;


class LazyBean extends SplBean
{
    protected $a;
    public function __call($method, $args) {
        if(substr($method,0,3)=='set'){
            $param = (substr($method,3,strlen($method)));
            if(isset($this->$param)) $this->$param = $args[0];
        }
        if(substr($method,0,3)=='get'){
            $param = (substr($method,3,strlen($method)));
            if(isset($this->$param)) return $this->$param ;
            return null;
        }
    }

    public function __construct(array $data = null, bool $autoCreateProperty = false)
    {
        foreach ($data as $k=>$v){
            $func = 'set' . ucfirst($k);
            $this->$func($v);
        }
        $this->initialize();
    }
}