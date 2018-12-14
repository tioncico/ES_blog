<?php

namespace App\Model;

/**
 * Class Link
 * Create With Automatic Generator
 * @property int lid | 主键id
 * @property string lname | 链接名
 * @property string url | 链接地址
 * @property int sort | 排序
 * @property int is_show | 文章是否显示 1是 0否
 * @property int is_delete | 是否删除 1是 0否
 */
class Link extends BaseModel
{
	public $table = 'xsk_link';
}

