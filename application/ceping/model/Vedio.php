<?php
/**
 * Created by PhpStorm.
 * User: Lich
 * Date: 2018/12/27
 * Time: 15:09
 */

namespace app\ceping\model;


use app\ceping\model\base\BaseModel;

class Vedio extends BaseModel
{
    public static function addInfo($user_id,$bucket,$pic_key)
    {
        $data=[
            'user_id'=>$user_id,
            'bucket'=>$bucket,
            'video'=>$pic_key
        ];

        $insert_id=self::create($data,true);

        return $insert_id;
    }
}