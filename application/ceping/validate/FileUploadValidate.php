<?php
/**
 * Created by PhpStorm.
 * User: Lich
 * Date: 2018/12/27
 * Time: 11:31
 */

namespace app\ceping\validate;


use app\ceping\validate\base\BaseValidate;

class FileUploadValidate extends BaseValidate
{

    public $rule=[
        'bucket'=>'require',
        'user_id'=>'require|isPositiveInter',
        'type'=>'require|isAllowedString'
    ];

    public $message=[
        'bucket'=>'bucket不能为空',
        'user_id'=>'ID错误',
        'type'=>'缺少上传的类型，如：pic,vedio',
        'type.isAllowedString'=>' 必须是 pic,vedio 参数，请对号入座'
    ];

    public function isAllowedString($value)
    {
        $allowedArray=[
            'pic','vedio'
        ];

        if(in_array($value,$allowedArray))
        {
            return true;
        }else{
            return false;
        }
    }
}