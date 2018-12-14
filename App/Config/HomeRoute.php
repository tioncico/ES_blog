<?php
/**
 * Created by PhpStorm.
 * User: Apple
 * Date: 2018/12/14 0014
 * Time: 15:01
 */
return [
    ['GET','/index/[{page:\d+}]','/Home/Index/index'],
    ['GET','/Index/[{page:\d+}]','/Home/Index/index'],
    ['GET','/article/[{aid:\d+}]','/Home/Index/article'],
    ['GET','/Article/[{aid:\d+}]','/Home/Index/article'],
    ['GET','/','/Home/Index'],
];