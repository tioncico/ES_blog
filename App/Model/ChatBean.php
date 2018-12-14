<?php

namespace App\Model;

/**
 * Class ChatBean
 * Create With Automatic Generator
 * @property int chid | 碎言id
 * @property int date | 发表时间
 * @property string content | 内容
 * @property int is_show | 是否显示
 * @property int is_delete | 是否删除
 */
class ChatBean extends BaseModel
{
	protected $chid;

	protected $date;

	protected $content;

	protected $is_show;

	protected $is_delete;


	public function setChid($chid){$this->chid=$chid;}


	public function getChid(){ return $this->chid;}


	public function setDate($date){$this->date=$date;}


	public function getDate(){ return $this->date;}


	public function setContent($content){$this->content=$content;}


	public function getContent(){ return $this->content;}


	public function setIsShow($isShow){$this->is_show=$isShow;}


	public function getIsShow(){ return $this->is_show;}


	public function setIsDelete($isDelete){$this->is_delete=$isDelete;}


	public function getIsDelete(){ return $this->is_delete;}
}

