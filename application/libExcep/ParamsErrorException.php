<?php
/**
 * Created by PhpStorm.
 * User: Lich
 * Date: 2018/12/20
 * Time: 13:39
 */

namespace app\libExcep;


use app\libExcep\base\BaseException;

class ParamsErrorException extends BaseException
{
    public $code=400;
    public $msg='参数错误';
    public $errorCode=10001;
}