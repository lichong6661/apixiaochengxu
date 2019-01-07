<?php
/**
 * Created by PhpStorm.
 * User: Lich
 * Date: 2018/12/27
 * Time: 10:46
 */

namespace app\ceping\service;


use think\Config;
use think\Request;

class UrlService
{
    /*
     * 拼装图片的完整URL
     */

    public static function picUrl($pic_key,$bucket='')
    {
        $request=Request::instance();
        $domain=$request->domain();

        $domainBucket=$domain.'/'.Config::get('uploadPath.'.$bucket);
        return $picUrl=$domainBucket.'/'.$pic_key;
    }
}