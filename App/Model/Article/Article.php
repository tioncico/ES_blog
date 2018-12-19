<?php

namespace App\Model\Article;

use App\Model\BaseModel;

/**
 * Class Article
 * Create With Automatic Generator
 * @property int aid | 文章表主键
 * @property string title | 标题
 * @property string author | 作者
 * @property mixed content | 文章内容
 * @property string keywords | 关键字
 * @property string description | 描述
 * @property int is_show | 文章是否显示 1是 0否
 * @property int is_delete | 是否删除 1是 0否
 * @property int is_top | 是否置顶 1是 0否
 * @property int is_original | 是否原创
 * @property int click | 点击数
 * @property int addtime | 添加时间
 * @property int cid | 分类id
 */
class Article extends BaseModel
{
	public $table = 'xsk_article';
}

