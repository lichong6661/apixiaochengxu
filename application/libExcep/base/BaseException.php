<?php
/**
 * Created by PhpStorm.
 * User: Lich
 * Date: 2018/12/20
 * Time: 11:59
 */

namespace app\libExcep\base;


use think\Exception;

class BaseException extends Exception
{
    public $code=400;
    public $msg='参数错误';
    public $errorCode=100000;
    public $data=[];

    public function __construct($param=[])
    {
        //parent::__construct($message, $code, $previous);

        if(!is_array($param))
        {
            return ;
            //throw new Exception('必须是正整数');
        }

        if(array_key_exists('code',$param))
        {
            $this->code=$param['code'];
        }

        if(array_key_exists('msg',$param))
        {
            $this->msg=$param['msg'];
        }

        if(array_key_exists('errorCode',$param))
        {
            $this->errorCode=$param['errorCode'];
        }

        if(array_key_exists('data',$param))
        {
            $this->data=$param['data'];
        }

    }
}