<?php

namespace App\Model;

/**
 * Class ConfigBean
 * Create With Automatic Generator
 * @property int id | 主键
 * @property string name | 配置项键名
 * @property string value | 配置项键值 1表示开启 0 关闭
 */
class ConfigBean extends BaseModel
{
	protected $id;

	protected $name;

	protected $value;


	public function setId($id){$this->id=$id;}


	public function getId(){ return $this->id;}


	public function setName($name){$this->name=$name;}


	public function getName(){ return $this->name;}


	public function setValue($value){$this->value=$value;}


	public function getValue(){ return $this->value;}
}

