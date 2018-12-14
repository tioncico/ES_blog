<?php

namespace App\Model;

/**
 * Class ArticleTagBean
 * Create With Automatic Generator
 * @property int aid | 文章id
 * @property int tid | 标签id
 */
class ArticleTagBean extends BaseModel
{
	protected $aid;

	protected $tid;


	public function setAid($aid){$this->aid=$aid;}


	public function getAid(){ return $this->aid;}


	public function setTid($tid){$this->tid=$tid;}


	public function getTid(){ return $this->tid;}
}

