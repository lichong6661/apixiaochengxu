<?php
/**
 * Created by PhpStorm.
 * User: Lich
 * Date: 2018/12/20
 * Time: 10:32
 */

namespace app\ceping\model\base;


use think\Model;

class BaseModel extends Model
{
    protected $autoWriteTimestamp=true;
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
    }

}