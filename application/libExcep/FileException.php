<?php
/**
 * Created by PhpStorm.
 * User: Lich
 * Date: 2018/12/24
 * Time: 16:42
 */

namespace app\libExcep;


use app\libExcep\base\BaseException;

class FileException extends BaseException
{
    public $code=500;
    public $msg='文件错误';
    public $errorCode=50000;

}