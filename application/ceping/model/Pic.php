<?php
/**
 * Created by PhpStorm.
 * User: Lich
 * Date: 2018/12/27
 * Time: 11:39
 */

namespace app\ceping\model;


use app\ceping\model\base\BaseModel;

class Pic extends BaseModel
{
    public static function addInfo($user_id,$bucket,$pic_key)
    {
        $data=[
            'user_id'=>$user_id,
            'bucket'=>$bucket,
            'pic_key'=>$pic_key
        ];

        $insert_id=self::create($data,true);

        return $insert_id;
    }
}