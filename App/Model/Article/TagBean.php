<?php

namespace App\Model\Article;

/**
 * Class TagBean
 * Create With Automatic Generator
 * @property int tid | 标签主键
 * @property string tag_name | 标签名
 * @property int num | 文章数
 */
class TagBean
{
    protected $tid;
    protected $tag_name;
    protected $num;


    public function setTid($tid)
    {
        $this->tid = $tid;
    }


    public function getTid()
    {
        return $this->tid;
    }


    public function setTagName($tagName)
    {
        $this->tag_name = $tagName;
    }


    public function getTagName()
    {
        return $this->tag_name;
    }

    /**
     * @return mixed
     */
    public function getNum()
    {
        return $this->num;
    }

    /**
     * @param mixed $num
     */
    public function setNum($num): void
    {
        $this->num = $num;
    }
}

