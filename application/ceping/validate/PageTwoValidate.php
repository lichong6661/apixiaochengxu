<?php
/**
 * Created by PhpStorm.
 * User: Lich
 * Date: 2018/12/20
 * Time: 13:44
 */

namespace app\ceping\validate;


use app\ceping\validate\base\BaseValidate;

class PageTwoValidate extends BaseValidate
{
    //protected $regex = [ 'zip' => '/^1[3|4|5|8|7][0-9]{9}$/'];
    public $rule=[
        'pages'=>'require|isNotEmpty',
        'height'=>'require|isNotEmpty',
        'weight'=>'require|isNotEmpty',
        'chest'=>'require|isNotEmpty',
        'waist'=>'require|isNotEmpty',
        'hip'=>'require|isNotEmpty',
        'user_id'=>'require|isPositiveInter'

    ];

    public $message=[
        'pages'=>'标志性错误',
        'hight'=>'请填写身高',
        'weight'=>'请填写体重',
        'chest'=>'请填写胸围',
        'waist'=>'请填写腰围',
        'hip'=>'请填写臀围',
        'user_id'=>'未知错误'
    ];
}