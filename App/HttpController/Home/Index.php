<?php
/**
 * Created by PhpStorm.
 * User: eValor
 * Date: 2018/10/26
 * Time: 下午3:09
 */

namespace App\HttpController\Home;


class Index extends HomeBase
{
    function index()
    {
        $data = $this->request()->getRequestParam();
        empty($data['page']) && $data['page'] = 1;
        $logic = new \App\Logic\Home\Article();
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
        $logic = new \App\Logic\Home\Article();
        $data = $this->request()->getRequestParam();
        $aid = $data['aid'];
        $info = $logic->getArticleInfoForAid($aid);

        $this->assign([
            'info'        => $info,
            'currPage'    => $data['page'],
            'title'       => $info['title'] . '-' . $this->WEBConfig['WEB_NAME'],
            'keywords'    => $this->WEBConfig['WEB_KEYWORDS'],
            'description' => $this->WEBConfig['WEB_DESCRIPTION'],
        ]);
        $this->fetch('Home/article');
    }

}