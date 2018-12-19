<?php
/**
 * Created by PhpStorm.
 * User: Apple
 * Date: 2018/12/14 0014
 * Time: 9:52
 */

namespace App\Logic\Home;

use App\Model\Article\Category;
use App\Model\Article\Comment;
use App\Model\Article\Tag;
use App\Model\Chat;
use App\Model\ConditionBean;
use App\Utility\Pool\MysqlDbObject;
use App\Utility\Pool\MysqlPool;
use EasySwoole\Component\Singleton;

class Article
{
    use Singleton;
    function getChatList(ConditionBean $conditionBean = null, int $page = 1, int $limit = 20)
    {
        $field = '*';
        $conditionBean == null && $conditionBean = new ConditionBean();
        $conditionBean
            ->addWhere('is_show', 1)
            ->addWhere('is_delete', 0)
            ->addOrderBy('chid', 'desc');
        return $this->getPageList(Chat::class, $conditionBean, $page, $limit, $field);
    }

    function getCommentListForAid($aid, int $page = 1, int $limit = 20)
    {
        $field = '*';
        $conditionBean = new ConditionBean();
        $conditionBean->addWhere('aid', $aid);
        $conditionBean
            ->addWhere('is_delete', 0)
            ->addWhere('status', 1)
            ->addOrderBy('cmtid', 'desc');
        return $this->getPageList(Comment::class, $conditionBean, $page, $limit, $field);

    }


    function getLinkListByHome(ConditionBean $conditionBean = null, int $page = 1, int $limit = 20)
    {
        $field = 'lid,lname,url';
        $conditionBean == null && $conditionBean = new ConditionBean();
        $conditionBean
            ->addWhere('is_delete', 0)
            ->addWhere('is_show', 1)
            ->addOrderBy('sort', 'asc');
        return $this->getPageList(\App\Model\Link::class, $conditionBean, $page, $limit, $field);
    }

    function getNewCommentList(ConditionBean $conditionBean = null, int $page = 1, int $limit = 20)
    {
        $field = 'cmtid,type,aid,content,date';
        $conditionBean == null && $conditionBean = new ConditionBean();
        $conditionBean
            ->addWhere('status', 1)
            ->addWhere('is_delete', 0)
            ->addOrderBy('cmtid', 'desc');
        return $this->getPageList(\App\Model\Article\Comment::class, $conditionBean, $page, $limit, $field);
    }

    function getTopArticleList(ConditionBean $conditionBean = null, int $page = 1, int $limit = 20)
    {
        $field = 'aid,title';
        $conditionBean == null && $conditionBean = new ConditionBean();
        $conditionBean->addWhere('is_show', 1)
            ->addWhere('is_delete', 0)
            ->addWhere('is_top', 1)
            ->addOrderBy('aid', 'desc');
        return $this->getPageList(\App\Model\Article\Article::class, $conditionBean, $page, $limit, $field);
    }

    function getArticleListByHome(ConditionBean $conditionBean = null, int $page = 1, int $limit = 20)
    {
        $field = 'xsk_article.aid,xsk_article.title,xsk_article.author,xsk_article.keywords,xsk_article.description,xsk_article.click,xsk_article.addtime,(select path from xsk_article_pic where aid=xsk_article.aid order by ap_id limit 1) as pic_path,xsk_category.cname as cname,xsk_category.cid';
        $conditionBean == null && $conditionBean = new ConditionBean();
        $conditionBean->addWhere('is_show', 1)
            ->addWhere('is_delete', 0)
            ->addOrderBy('aid', 'desc');
        $conditionBean->addJoin('xsk_category','xsk_category.cid = xsk_article.cid');
        return $this->getPageList(\App\Model\Article\Article::class, $conditionBean, $page, $limit, $field);
    }

    function getArticleInfoForAid(int $aid)
    {
        $field = '*,xsk_category.cname as cname';
        $conditionBean = new ConditionBean();
        $conditionBean->addWhere('aid', $aid);
        $conditionBean->addJoin('xsk_category','xsk_category.cid = xsk_article.cid');
        $info = $this->getOne(\App\Model\Article\Article::class, $conditionBean, $field);
        return $info;
    }


    function getCategoryListByHome(ConditionBean $conditionBean = null, int $page = 1, int $limit = 20)
    {
        $field = '*';
        $conditionBean == null && $conditionBean = new ConditionBean();
        $conditionBean->addOrderBy('sort', 'asc');
        return $this->getPageList(Category::class, $conditionBean, $page, $limit, $field);
    }

    function getTagList(ConditionBean $conditionBean = null, int $page = 1, int $limit = 20)
    {
        $field = '*';
        $conditionBean == null && $conditionBean = new ConditionBean();
        return $this->getPageList(Tag::class, $conditionBean, $page, $limit, $field);
    }

    function getPageList(String $modelName, ConditionBean $conditionBean = null, int $page = 1, int $limit = 20, $filed = '*')
    {
        $data = MysqlPool::invoke(function (MysqlDbObject $mysqlDbObject) use ($modelName, $conditionBean, $page, $limit, $filed) {
            $model = new $modelName($mysqlDbObject);
            $data = $model->conditionBuild($conditionBean)->getAll($page, $limit, $filed);
            return $data;
        });
        return $data;
    }

    function getOne(String $modelName, ConditionBean $conditionBean = null, $filed = '*')
    {
        $data = MysqlPool::invoke(function (MysqlDbObject $mysqlDbObject) use ($modelName, $conditionBean, $filed) {
            $model = new $modelName($mysqlDbObject);
            $data = $model->conditionBuild($conditionBean)->getOne($filed);
            return $data;
        });
        return $data;
    }


}