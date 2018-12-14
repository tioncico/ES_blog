<?php

namespace App\Model\Article;

/**
 * Class ArticleBean
 * Create With Automatic Generator
 * @property int aid | 文章表主键
 * @property string title | 标题
 * @property string author | 作者
 * @property mixed content | 文章内容
 * @property string keywords | 关键字
 * @property string description | 描述
 * @property int is_show | 文章是否显示 1是 0否
 * @property int is_delete | 是否删除 1是 0否
 * @property int is_top | 是否置顶 1是 0否
 * @property int is_original | 是否原创
 * @property int click | 点击数
 * @property int add_time | 添加时间
 * @property int cid | 分类id
 * @property int update_time | 更新时间
 * @property string c_name | 分类名称
 */
class ArticleBean extends BaseModel
{
	protected $aid;

	protected $title;

	protected $author;

	protected $content;

	protected $keywords;

	protected $description;

	protected $is_show;

	protected $is_delete;

	protected $is_top;

	protected $is_original;

	protected $click;

	protected $add_time;

	protected $cid;

	protected $update_time;

	protected $c_name;


	public function setAid($aid){$this->aid=$aid;}


	public function getAid(){ return $this->aid;}


	public function setTitle($title){$this->title=$title;}


	public function getTitle(){ return $this->title;}


	public function setAuthor($author){$this->author=$author;}


	public function getAuthor(){ return $this->author;}


	public function setContent($content){$this->content=$content;}


	public function getContent(){ return $this->content;}


	public function setKeywords($keywords){$this->keywords=$keywords;}


	public function getKeywords(){ return $this->keywords;}


	public function setDescription($description){$this->description=$description;}


	public function getDescription(){ return $this->description;}


	public function setIsShow($isShow){$this->is_show=$isShow;}


	public function getIsShow(){ return $this->is_show;}


	public function setIsDelete($isDelete){$this->is_delete=$isDelete;}


	public function getIsDelete(){ return $this->is_delete;}


	public function setIsTop($isTop){$this->is_top=$isTop;}


	public function getIsTop(){ return $this->is_top;}


	public function setIsOriginal($isOriginal){$this->is_original=$isOriginal;}


	public function getIsOriginal(){ return $this->is_original;}


	public function setClick($click){$this->click=$click;}


	public function getClick(){ return $this->click;}


	public function setAddTime($addTime){$this->add_time=$addTime;}


	public function getAddTime(){ return $this->add_time;}


	public function setCid($cid){$this->cid=$cid;}


	public function getCid(){ return $this->cid;}


	public function setUpdateTime($updateTime){$this->update_time=$updateTime;}


	public function getUpdateTime(){ return $this->update_time;}


	public function setCName($cName){$this->c_name=$cName;}


	public function getCName(){ return $this->c_name;}
}

