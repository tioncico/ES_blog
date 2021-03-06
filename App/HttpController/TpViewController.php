<?php
namespace App\HttpController;
use EasySwoole\Http\AbstractInterface\Controller;
use think\Template;
/**
 * 视图控制器
 * Class ViewController
 * @author  : evalor <master@evalor.cn>
 * @package App
 */
abstract class TpViewController extends Controller
{
    protected $view;
    public function onRequest(?string $action): ?bool
    {
        $this->view = new Template();
        $tempPath = \EasySwoole\EasySwoole\Config::getInstance()->getConf('TEMP_DIR');     # 临时文件目录
        $this->view->config([
            'view_path'  => EASYSWOOLE_ROOT . '/Static/Views/',              # 模板文件目录
            'cache_path' => "{$tempPath}/templates_c/",               # 模板编译目录
            'default_return_type' => "html",               # 模板编译目录
        ]);
        return parent::onRequest($action); // TODO: Change the autogenerated stub
    }
    public function afterAction(?string $actionName): void
    {
        $this->view = null;
        parent::afterAction($actionName); // TODO: Change the autogenerated stub
    }
    /**
     * 输出模板到页面
     * @param  string|null $template 模板文件
     * @param array $vars 模板变量值
     * @param array $config 额外的渲染配置
     * @author : evalor <master@evalor.cn>
     */
    public function fetch($template, $vars = [], $config = [])
    {
        ob_start();
        $this->view->fetch($template, $vars, $config);
        $content = ob_get_clean();
        //批量替换模板资源文件内容
        $content =  str_replace(['<img src="/Upload/image/ueditor/',],['<img src="http://image.php20.cn/Upload/image/ueditor/'],$content);
        $this->response()->write(html_entity_decode($content));
    }
    /**
     * 模板变量赋值
     * @access public
     * @param mixed $name
     * @param mixed $value
     * @return void
     */
    public function assign($name, $value = '')
    {
        $this->view->assign($name, $value);
    }
}