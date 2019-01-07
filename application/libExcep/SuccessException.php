<?php
/**
 * Created by PhpStorm.
 * User: Lich
 * Date: 2018/12/20
 * Time: 15:25
 */

namespace app\libExcep;


use app\libExcep\base\BaseException;

class SuccessException extends BaseException
{
    public $code=200;
    public $msg='添加或保存成功';
    public $errorCode='';
    public $data=[];
}