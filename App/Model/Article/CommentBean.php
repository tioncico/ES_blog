<?php

namespace App\Model\Article;

/**
 * Class CommentBean
 * Create With Automatic Generator
 * @property int cmtid | 主键id
 * @property int ouid | 评论用户id 关联oauth_user表的id
 * @property int type | 1：文章评论
 * @property int pid | 父级id
 * @property int aid | 文章id
 * @property string content | 内容
 * @property string oauth_user_name | 评论用户名
 * @property string article_title | 文章名
 * @property int date | 评论日期
 * @property int status | 1:已审核 0：未审核
 * @property int is_delete | 是否删除
 */
class CommentBean
{
    protected $cmtid;

    protected $ouid;

    protected $type;

    protected $pid;

    protected $aid;

    protected $content;
    protected $oauth_user_name;
    protected $article_title;

    protected $date;

    protected $status;

    protected $is_delete;


    public function setCmtid($cmtid)
    {
        $this->cmtid = $cmtid;
    }


    public function getCmtid()
    {
        return $this->cmtid;
    }


    public function setOuid($ouid)
    {
        $this->ouid = $ouid;
    }


    public function getOuid()
    {
        return $this->ouid;
    }


    public function setType($type)
    {
        $this->type = $type;
    }


    public function getType()
    {
        return $this->type;
    }


    public function setPid($pid)
    {
        $this->pid = $pid;
    }


    public function getPid()
    {
        return $this->pid;
    }


    public function setAid($aid)
    {
        $this->aid = $aid;
    }


    public function getAid()
    {
        return $this->aid;
    }


    public function setContent($content)
    {
        $this->content = $content;
    }


    public function getContent()
    {
        return $this->content;
    }


    public function setDate($date)
    {
        $this->date = $date;
    }


    public function getDate()
    {
        return $this->date;
    }


    public function setStatus($status)
    {
        $this->status = $status;
    }


    public function getStatus()
    {
        return $this->status;
    }


    public function setIsDelete($isDelete)
    {
        $this->is_delete = $isDelete;
    }


    public function getIsDelete()
    {
        return $this->is_delete;
    }

    /**
     * @return mixed
     */
    public function getArticleTitle()
    {
        return $this->article_title;
    }

    /**
     * @param mixed $article_title
     */
    public function setArticleTitle($article_title): void
    {
        $this->article_title = $article_title;
    }

    /**
     * @return mixed
     */
    public function getOauthUserName()
    {
        return $this->oauth_user_name;
    }

    /**
     * @param mixed $oauth_user_name
     */
    public function setOauthUserName($oauth_user_name): void
    {
        $this->oauth_user_name = $oauth_user_name;
    }


}

