<?php
/**
 * Created by PhpStorm.
 * User: Apple
 * Date: 2018/12/14 0014
 * Time: 15:01
 */
return [
    ['GET','/index[/{page:\d+}]','/Home/Index/index'],
    ['GET','/chat[/{page:\d+}]','/Home/Index/chat'],
    ['GET','/about','/Home/Index/about'],
    ['GET','/whisper','/Home/Index/whisper'],
    ['GET','/category/{category_id:\d+}[/{page:\d+}]','/Home/Index/category'],
    ['GET','/article/[{aid:\d+}]','/Home/Index/article'],
    ['GET','/','/Home/Index'],
];