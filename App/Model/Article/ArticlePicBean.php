<?php

namespace App\Model\Article;

/**
 * Class ArticlePicBean
 * Create With Automatic Generator
 * @property int ap_id | 主键
 * @property string path | 图片路径
 * @property int aid | 所属文章id
 */
class ArticlePicBean
{
	protected $ap_id;

	protected $path;

	protected $aid;


	public function setApId($apId){$this->ap_id=$apId;}


	public function getApId(){ return $this->ap_id;}


	public function setPath($path){$this->path=$path;}


	public function getPath(){ return $this->path;}


	public function setAid($aid){$this->aid=$aid;}


	public function getAid(){ return $this->aid;}
}

