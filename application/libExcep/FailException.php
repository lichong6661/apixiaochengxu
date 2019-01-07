<?php
/**
 * Created by PhpStorm.
 * User: Lich
 * Date: 2018/12/20
 * Time: 15:33
 */

namespace app\libExcep;


use app\libExcep\base\BaseException;

class FailException extends BaseException
{
    public $code=500;
    public $msg='更新或保存失败';
    public $errorCode='';
}