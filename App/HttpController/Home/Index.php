<?php
/**
 * Created by PhpStorm.
 * User: eValor
 * Date: 2018/10/26
 * Time: 下午3:09
 */

namespace App\HttpController\Home;

use App\HttpController\Base;
use App\Model\ConditionBean;
use EasySwoole\EasySwoole\FastCache\Cache;

class Index extends Base
{
    function index()
    {
        $logic = new \App\Logic\Home\Article();
        $articleList = $logic->getArticleListByHome(null, 1, 10);
        $categoryList = $logic->getCategoryListByHome(null, 1,30);
        $tagList = $logic->getTagList(null, 1,30);
        $topList = $logic->getTopArticleList(null, 1, 20);
        $newCommentList = $logic->getNewCommentList(null, 1, 10);
        $linkList = $logic->getLinkListByHome(null, 1, 30);
        $this->assign([
            'articleList'    => $articleList,
            'categoryList'   => $categoryList,
            'tagList'        => $tagList,
            'topList'        => $topList,
            'newCommentList' => $newCommentList,
            'linkList'       => $linkList,
        ]);
        $this->fetch('Home/index');
    }

}