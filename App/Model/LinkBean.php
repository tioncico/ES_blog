<?php

namespace App\Model;

/**
 * Class LinkBean
 * Create With Automatic Generator
 * @property int lid | 主键id
 * @property string lname | 链接名
 * @property string url | 链接地址
 * @property int sort | 排序
 * @property int is_show | 文章是否显示 1是 0否
 * @property int is_delete | 是否删除 1是 0否
 */
class LinkBean extends BaseModel
{
	protected $lid;

	protected $lname;

	protected $url;

	protected $sort;

	protected $is_show;

	protected $is_delete;


	public function setLid($lid){$this->lid=$lid;}


	public function getLid(){ return $this->lid;}


	public function setLname($lname){$this->lname=$lname;}


	public function getLname(){ return $this->lname;}


	public function setUrl($url){$this->url=$url;}


	public function getUrl(){ return $this->url;}


	public function setSort($sort){$this->sort=$sort;}


	public function getSort(){ return $this->sort;}


	public function setIsShow($isShow){$this->is_show=$isShow;}


	public function getIsShow(){ return $this->is_show;}


	public function setIsDelete($isDelete){$this->is_delete=$isDelete;}


	public function getIsDelete(){ return $this->is_delete;}
}

