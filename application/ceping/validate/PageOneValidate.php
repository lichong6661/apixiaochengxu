<?php
/**
 * Created by PhpStorm.
 * User: Lich
 * Date: 2018/12/20
 * Time: 13:44
 */

namespace app\ceping\validate;


use app\ceping\validate\base\BaseValidate;

class PageOneValidate extends BaseValidate
{
    protected $regex = [ 'zip' => '/^1[3|4|5|8|7][0-9]{9}$/'];
    public $rule=[
        'pages'=>'require|isNotEmpty',
        'name'=>'require|isNotEmpty',
        'sex'=>'require|isPositiveInter',
        'age'=>'require|isPositiveInter|isNotEmpty',
        'tel'=>'require|regex:zip',
        'wechat'=>'require|isNotEmpty'

    ];

    public $message=[
        'pages'=>'标志性错误',
        'name'=>'姓名错误',
        'sex'=>'性别错误',
        'age'=>'年龄错误',
        'tel.regex'=>'联系方式格式不正确',
        'wechat'=>'微信号错误'
    ];
}