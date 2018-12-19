<?php
/**
 * Created by PhpStorm.
 * User: eValor
 * Date: 2018/10/26
 * Time: 下午3:09
 */

namespace App\HttpController\Home;


use App\Logic\Home\Article;
use App\Model\ConditionBean;

class Index extends HomeBase
{
    function index()
    {
        $data = $this->request()->getRequestParam();
        empty($data['page']) && $data['page'] = 1;
        $logic = Article::getInstance();
        $articleList = $logic->getArticleListByHome(null, $data['page'], 10);

        $this->assign([
            'articleList' => $articleList,
            'currPage'    => $data['page'],
            'title'       => $this->WEBConfig['WEB_NAME'],
            'keywords'    => $this->WEBConfig['WEB_KEYWORDS'],
            'description' => $this->WEBConfig['WEB_DESCRIPTION'],
        ]);
        $this->fetch('Home/index');
    }

    function article()
    {
        $logic = Article::getInstance();
        $data = $this->request()->getRequestParam();
        $aid = $data['aid'];
        $info = $logic->getArticleInfoForAid($aid);
        //获取该文章评论
        $commentList = $logic->getCommentListForAid($aid);

        $this->assign([
            'info'        => $info,
            'commentList' => $commentList,
            'title'       => $info['title'] . '-' . $this->WEBConfig['WEB_NAME'],
            'keywords'    => empty($info['keywords'])?$this->WEBConfig['WEB_KEYWORDS']:$info['keywords'].",".$this->WEBConfig['WEB_KEYWORDS'],
            'description' =>  empty($info['keywords'])?$this->WEBConfig['WEB_KEYWORDS']:$info['keywords'].",".$this->WEBConfig['WEB_KEYWORDS'],
        ]);
        $this->fetch('Home/article');
    }

    function category()
    {
        $data = $this->request()->getRequestParam();
        $categoryId = $data['category_id'];
        empty($data['page']) && $data['page'] = 1;
        $logic = Article::getInstance();
        $conditionBean = new ConditionBean();
        $conditionBean->addWhere('xsk_category.cid', $categoryId);
        $articleList = $logic->getArticleListByHome($conditionBean, $data['page'], 10);
        $this->assign([
            'articleList' => $articleList,
            'categoryId'  => $categoryId,
            'currPage'    => $data['page'],
            'title'       => $this->WEBConfig['WEB_NAME'],
            'keywords'    => $this->WEBConfig['WEB_KEYWORDS'],
            'description' => $this->WEBConfig['WEB_DESCRIPTION'],
        ]);
        $this->fetch('Home/category');
    }

    function about()
    {
        $logic = Article::getInstance();
        $this->assign([
//            'articleList' => $articleList,
//            'categoryId'=>$categoryId,
            'name'        => '仙士可',
            'age'         => date('Y') - 1997,
            'career'      => 'php苦工',
            'interest'    => '写博客,群里装逼',
            'navActive'      => 'about',
            'title'       => "个人介绍-" . $this->WEBConfig['WEB_NAME'],
            'keywords'    => $this->WEBConfig['WEB_KEYWORDS'],
            'description' => $this->WEBConfig['WEB_DESCRIPTION'],
        ]);
        $this->fetch('Home/about');
    }

    function whisper()
    {
        $data = $this->request()->getRequestParam();
        empty($data['page']) && $data['page'] = 1;
        $logic = Article::getInstance();
        $chatList = $logic->getChatList(null,$data['page']);

        $this->assign([
            'chatList' => $chatList,
//            'categoryId'=>$categoryId,
            'navActive'      => 'whisper',
            'title'       => "闲言碎语-" . $this->WEBConfig['WEB_NAME'],
            'keywords'    => $this->WEBConfig['WEB_KEYWORDS'],
            'description' => $this->WEBConfig['WEB_DESCRIPTION'],
        ]);
        $this->fetch('Home/whisper');
    }

}