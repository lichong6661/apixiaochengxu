<?php
/**
 * Created by PhpStorm.
 * User: Lich
 * Date: 2019/1/17
 * Time: 11:28
 */

namespace app\ceping\behavior;


class CORS
{
    public function appInit(&$params)
    {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: Origin,token,X-Requested-With, Content-Type, Accept, Authorization");
        header('Access-Control-Allow-Methods: GET, POST');
        if(request()->isOptions())
        {
            exit();
        }
    }
}