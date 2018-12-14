<?php

namespace App\Model;

/**
 * Class OauthUser
 * Create With Automatic Generator
 * @property int id | 主键id
 * @property int uid | 关联的本站用户id
 * @property int type | 类型 1：QQ  2：新浪微博 3：豆瓣 4：人人 5：开心网
 * @property string nickname | 第三方昵称
 * @property string head_img | 头像
 * @property string openid | 第三方用户id
 * @property string access_token | access_token token
 * @property int create_time | 绑定时间
 * @property int last_login_time | 最后登录时间
 * @property string last_login_ip | 最后登录ip
 * @property int login_times | 登录次数
 * @property int status | 状态
 * @property string email | 邮箱
 * @property int is_admin | 是否是admin
 */
class OauthUser extends BaseModel
{
	public $table = 'xsk_oauth_user';
}

