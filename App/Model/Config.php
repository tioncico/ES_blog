<?php

namespace App\Model;

/**
 * Class Config
 * Create With Automatic Generator
 * @property int id | 主键
 * @property string name | 配置项键名
 * @property string value | 配置项键值 1表示开启 0 关闭
 */
class Config extends BaseModel
{
	public $table = 'xsk_config';
}

