<?php

namespace App\Model\Article;

/**
 * Class TagBean
 * Create With Automatic Generator
 * @property int tid | 标签主键
 * @property string tname | 标签名
 */
class TagBean
{
	protected $tid;

	protected $tname;


	public function setTid($tid){$this->tid=$tid;}


	public function getTid(){ return $this->tid;}


	public function setTname($tname){$this->tname=$tname;}


	public function getTname(){ return $this->tname;}
}

