<?php
/**
 * Created by PhpStorm.
 * User: Apple
 * Date: 2018/12/14 0014
 * Time: 9:52
 */

namespace App\Logic\Home;

use App\Model\Article\Category;
use App\Model\Article\Tag;
use App\Model\ConditionBean;
use App\Utility\Pool\MysqlDbObject;
use App\Utility\Pool\MysqlPool;

class Article
{

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
        $field = 'cmtid,type,aid,content,oauth_user_name,article_title,date';
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
        $field = 'xsk_article.aid,xsk_article.title,xsk_article.author,xsk_article.keywords,xsk_article.description,xsk_article.click,xsk_article.add_time,xsk_article.update_time,xsk_article.c_name,(select path from xsk_article_pic where aid=xsk_article.aid order by ap_id limit 1) as pic_path';
        $conditionBean == null && $conditionBean = new ConditionBean();
        $conditionBean->addWhere('is_show', 1)
            ->addWhere('is_delete', 0)
            ->addOrderBy('aid', 'desc');
        return $this->getPageList(\App\Model\Article\Article::class, $conditionBean, $page, $limit, $field);
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
//            var_dump($mysqlDbObject->getLastQuery());
            return $data;
        });
        return $data;
    }


}