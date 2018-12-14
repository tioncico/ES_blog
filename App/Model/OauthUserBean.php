<?php

namespace App\Model;

/**
 * Class OauthUserBean
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
class OauthUserBean extends BaseModel
{
	protected $id;

	protected $uid;

	protected $type;

	protected $nickname;

	protected $head_img;

	protected $openid;

	protected $access_token;

	protected $create_time;

	protected $last_login_time;

	protected $last_login_ip;

	protected $login_times;

	protected $status;

	protected $email;

	protected $is_admin;


	public function setId($id){$this->id=$id;}


	public function getId(){ return $this->id;}


	public function setUid($uid){$this->uid=$uid;}


	public function getUid(){ return $this->uid;}


	public function setType($type){$this->type=$type;}


	public function getType(){ return $this->type;}


	public function setNickname($nickname){$this->nickname=$nickname;}


	public function getNickname(){ return $this->nickname;}


	public function setHeadImg($headImg){$this->head_img=$headImg;}


	public function getHeadImg(){ return $this->head_img;}


	public function setOpenid($openid){$this->openid=$openid;}


	public function getOpenid(){ return $this->openid;}


	public function setAccessToken($accessToken){$this->access_token=$accessToken;}


	public function getAccessToken(){ return $this->access_token;}


	public function setCreateTime($createTime){$this->create_time=$createTime;}


	public function getCreateTime(){ return $this->create_time;}


	public function setLastLoginTime($lastLoginTime){$this->last_login_time=$lastLoginTime;}


	public function getLastLoginTime(){ return $this->last_login_time;}


	public function setLastLoginIp($lastLoginIp){$this->last_login_ip=$lastLoginIp;}


	public function getLastLoginIp(){ return $this->last_login_ip;}


	public function setLoginTimes($loginTimes){$this->login_times=$loginTimes;}


	public function getLoginTimes(){ return $this->login_times;}


	public function setStatus($status){$this->status=$status;}


	public function getStatus(){ return $this->status;}


	public function setEmail($email){$this->email=$email;}


	public function getEmail(){ return $this->email;}


	public function setIsAdmin($isAdmin){$this->is_admin=$isAdmin;}


	public function getIsAdmin(){ return $this->is_admin;}
}

