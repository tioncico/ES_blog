<?php

namespace App\Model;

/**
 * Class Chat
 * Create With Automatic Generator
 * @property int chid | 碎言id
 * @property int date | 发表时间
 * @property string content | 内容
 * @property int is_show | 是否显示
 * @property int is_delete | 是否删除
 */
class Chat extends BaseModel
{
	public $table = 'xsk_chat';
}

