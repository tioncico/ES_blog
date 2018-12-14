<?php

namespace App\Model\Article;

use App\Model\BaseModel;

/**
 * Class ArticlePic
 * Create With Automatic Generator
 * @property int ap_id | 主键
 * @property string path | 图片路径
 * @property int aid | 所属文章id
 */
class ArticlePic extends BaseModel
{
	public $table = 'xsk_article_pic';
}

