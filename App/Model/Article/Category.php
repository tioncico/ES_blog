<?php

namespace App\Model\Article;

use App\Model\BaseModel;

/**
 * Class Category
 * Create With Automatic Generator
 * @property int cid | 分类主键id
 * @property string cname | 分类名称
 * @property string keywords | 关键词
 * @property string description | 描述
 * @property int sort | 排序
 * @property int pid | 父级栏目id
 */
class Category extends BaseModel
{
	public $table = 'xsk_category';

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
        $list = $this->getDbConnection()
            ->withTotalCount()
            ->get($this->table, [$pageSize * ($page - 1), $pageSize], $field);
        $total = $this->getDbConnection()->getTotalCount();
        return ['total' => $total, 'list' => $list];
    }

}

