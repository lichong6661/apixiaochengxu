<?php
/**
 * Created by PhpStorm.
 * User: Lich
 * Date: 2018/12/24
 * Time: 16:30
 */

namespace app\ceping\service;


use app\libExcep\FileException;
use app\libExcep\SuccessException;
use think\Config;
use think\Exception;
use think\Request;

class UploadService
{
    public static function uploads($target='',$type='pic')
    {
        $request=Request::instance();

        if(!$target)
        {
            throw new FileException([
                'msg'=>'文件target错误！'
            ]);
        }

        if($request->isGet())
        {
            throw new FileException([
                'msg'=>'请求方式错误'
            ]);
        }else{
            $file=$request->file('avatar');
            if(empty($file))
            {
                throw new FileException([
                    'msg'=>'请上传图片'
                ]);
            }

            $data_file=date('Ymd');

            $tmp_name=$file->getInfo()['tmp_name'];
            $md5_name=md5(file_get_contents($tmp_name));

            //区分图片还是视频
            switch($type){
                case 'pic':
                    $rules=[
                        'ext'=>'jpeg,jpg,png',
                        'size'=>5*1024*1024
                    ];

                    $path=ROOT_PATH.'public'.Config::get('uploadPath.'.$target).'/'.$data_file;
//                    $path=ROOT_PATH.'public'.Config::get('uploadPath.'.$target);

                    break;
                case 'vedio':
                    $rules=[
                        'ext'=>'mp4',
                        'size'=>300*1024*1024
                    ];



                    $path=ROOT_PATH.'public'.Config::get('uploadPath.'.$target).'/'.$data_file;

                    break;
                default:
                    throw new FileException([
                       'msg'=>'上传文件的既不是图片也不是视频格式！'
                    ]);

            }



            try{
                if(!file_exists($path))
                {
                    mkdir($path,0777,true);
                    chmod($path,0777);
                }
            }catch(Exception $e){
                throw new FileException([
                    'msg'=>$e->getMessage()
                ]);
            }




//            $info= $file->rule('sha1')->validate($rules)->move($path);
//            $info= $file->validate($rules)->move($path);
           $info= $file->validate($rules)->move($path,$md5_name);

            /*if(!$info)
            {
                throw new FileException([
                    'msg'=>$file->getError()
                ]);
            }*/

            if($info)
            {
                $fileUrl=$info->getSaveName();

                return [
                    'fileUrl'=>$fileUrl,
                    'fileRealPath'=>$info->getPathname()
                ];
            }else{
                throw new FileException([
                    'msg'=>$file->getError()
                ]);
            }

            // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg



        }
    }
}