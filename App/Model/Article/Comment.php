<?php

namespace App\Model\Article;

use App\Model\BaseModel;

/**
 * Class Comment
 * Create With Automatic Generator
 * @property int cmtid | 主键id
 * @property int ouid | 评论用户id 关联oauth_user表的id
 * @property int type | 1：文章评论
 * @property int pid | 父级id
 * @property int aid | 文章id
 * @property string content | 内容
 * @property string oauth_user_name | 评论用户名
 * @property string article_title | 文章名
 * @property int date | 评论日期
 * @property int status | 1:已审核 0：未审核
 * @property int is_delete | 是否删除
 */
class Comment extends BaseModel
{
	public $table = 'xsk_comment';
}

