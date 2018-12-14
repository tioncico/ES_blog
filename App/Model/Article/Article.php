<?php

namespace App\Model\Article;

use App\Model\BaseModel;

/**
 * Class Article
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
class Article extends BaseModel
{
    public $table = 'xsk_article';


    /**
     * 用Id作为条件更新数据
     * @param ArticleBean $bean
     * @param array       $data
     * @return bool
     * @throws \Exception
     */
    function update(ArticleBean $bean, array $data): bool
    {
        if (empty($data)) {
            return false;
        }
        return $this->getDbConnection()->where('aid', $bean->getAid())->update($this->table, $data);
    }

    /**
     * 删除一条数据
     * @param ArticleBean $bean
     * @return bool|void
     * @throws \Exception
     */
    function delete(ArticleBean $bean)
    {
        return $this->getDbConnection()->where('aid', $bean->getAid())->delete($this->table);
    }

}

