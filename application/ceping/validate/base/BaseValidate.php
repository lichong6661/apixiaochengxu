<?php
/**
 * Created by PhpStorm.
 * User: Lich
 * Date: 2018/12/20
 * Time: 11:33
 */

namespace app\ceping\validate\base;



use app\libExcep\MissException;
use app\libExcep\ParamsErrorException;
use think\Request;
use think\Validate;

class BaseValidate extends Validate
{
    public function goCheck()
    {
        $params=Request::instance()->param();

        if(!$params)
        {
            throw new MissException([
                'msg'=>'参数传入错误'
            ]);
        }

        $result= $this->batch()->check($params);
        if(!$result)
        {
            throw new ParamsErrorException([
                'msg'=>$this->getError()
            ]);
        }
    }

    //验证 value 是正整数
    public function isPositiveInter($value,$rule='',$data='',$field='')
    {
        if(is_numeric($value) && is_int($value + 0) && ($value+0) >0 )
        {
            return true;
        }else{
            //返回错误的信息定义
            return false;
        }
    }

    //验证是否为空
    public function isNotEmpty($value,$rule='',$data='',$field='')
    {
        if( empty($value) )
        {
            return false;
        }else{

            return true;
        }
    }
}