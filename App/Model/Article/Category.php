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
}

