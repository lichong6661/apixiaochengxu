<?php
/**
 * Created by PhpStorm.
 * User: Lich
 * Date: 2018/12/20
 * Time: 13:36
 */

namespace app\libExcep;


use app\libExcep\base\BaseException;

class MissException extends BaseException
{
    public $code=400;
    public $msg='参数丢失';
    public $errorCode=10000;
}