<?php

namespace App\Model\Article;

use App\Model\BaseModel;

/**
 * Class Tag
 * Create With Automatic Generator
 * @property int tid | 标签主键
 * @property string tag_name | 标签名
 * @property int num | 标签文章数
 */
class Tag extends BaseModel
{
	public $table = 'xsk_tag';
}

