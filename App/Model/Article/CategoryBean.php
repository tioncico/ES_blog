<?php

namespace App\Model\Article;

/**
 * Class CategoryBean
 * Create With Automatic Generator
 * @property int cid | 分类主键id
 * @property string cname | 分类名称
 * @property string keywords | 关键词
 * @property string description | 描述
 * @property int sort | 排序
 * @property int pid | 父级栏目id
 */
class CategoryBean extends BaseModel
{
	protected $cid;

	protected $cname;

	protected $keywords;

	protected $description;

	protected $sort;

	protected $pid;


	public function setCid($cid){$this->cid=$cid;}


	public function getCid(){ return $this->cid;}


	public function setCname($cname){$this->cname=$cname;}


	public function getCname(){ return $this->cname;}


	public function setKeywords($keywords){$this->keywords=$keywords;}


	public function getKeywords(){ return $this->keywords;}


	public function setDescription($description){$this->description=$description;}


	public function getDescription(){ return $this->description;}


	public function setSort($sort){$this->sort=$sort;}


	public function getSort(){ return $this->sort;}


	public function setPid($pid){$this->pid=$pid;}


	public function getPid(){ return $this->pid;}
}

