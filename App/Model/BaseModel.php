<?php
/**
 * Created by PhpStorm.
 * User: yf
 * Date: 2018/10/26
 * Time: 4:07 PM
 */

namespace App\Model;


use App\Utility\Pool\MysqlDbObject;
use EasySwoole\Spl\SplBean;

class BaseModel
{
    private $db;

    function __construct(MysqlDbObject $dbObject)
    {
        $this->db = $dbObject;
    }

    function getDbConnection(): MysqlDbObject
    {
        return $this->db;
    }

    function add(SplBean $bean): bool
    {
        return $this->getDbConnection()->insert($this->table, $bean->toArray(null, SplBean::FILTER_NOT_NULL));
    }

    function conditionBuild(ConditionBean $condition)
    {
        $condition=$condition->toArray();
        $allow = ['where', 'orWhere', 'join', 'orderBy', 'groupBy'];
        foreach ($condition as $k => $v) {
            if (in_array($k, $allow)) {
                foreach ($v as $item) {
                    $this->getDbConnection()->$k(...$item);
                }
            }
        }
        return $this;
    }

    /**
     * 获取数据列表
     * @param array $condition
     * @param int   $page
     * @param int   $pageSize
     * @return array
     * @throws \EasySwoole\Mysqli\Exceptions\OrderByFail
     */
    function getAll(int $page = 1, int $pageSize = 10, $field = '*'): array
    {
        if($page>=0){
            $list = $this->getDbConnection()
                ->withTotalCount()
                ->get($this->table, [$pageSize * ($page - 1), $pageSize], $field);
            $total = $this->getDbConnection()->getTotalCount();
            return ['total' => $total, 'list' => $list];
        }else{
            return $this->getDbConnection()->get($this->table,null,$field);
        }
    }

    function getOne($field="*"){
        return $this->getDbConnection()->getOne($this->table,$field);
    }

}