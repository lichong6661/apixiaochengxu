<?php
/**
 * Created by PhpStorm.
 * User: Lich
 * Date: 2018/12/20
 * Time: 10:30
 */

namespace app\ceping\model;


use app\ceping\model\base\BaseModel;
use think\Db;

class Informations extends BaseModel
{
   /* protected $autoWriteTimestamp=true;
    protected $auto=[
        'updated_time',
        'created_time'
    ];

    //添加、修改的时候 自动添加的时间
    public function setUpdatedTimeAttr()
    {
        return date('Y-m-d H:i:s');
    }
    public function setCreatedTimeAttr()
    {
        return date('Y-m-d H:i:s');
    }*/


    /*
     * 添加数据
     */
    public static function addOneInfo($data){
        $res=self::create($data,true);
        return $res;
    }
}