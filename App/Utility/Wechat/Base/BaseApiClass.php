<?php
/**
 * Created by PhpStorm.
 * User: evalor
 * Date: 2018-11-22
 * Time: 17:19
 */

namespace App\Utility\WeChat\Base;

abstract class BaseApiClass extends BaseApiRequest
{
    protected $accountBean;

    function __construct(AccountBean $accountBean)
    {
        $this->accountBean = $accountBean;
    }
}