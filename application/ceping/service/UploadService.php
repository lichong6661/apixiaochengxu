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
                        'size'=>200*1024*1024
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

            $tmp_name=$file->getInfo()['tmp_name'];
            $md5_name=md5(file_get_contents($tmp_name));


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
                $fileUrl=$data_file.'/'.$info->getSaveName();

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

   //上传剪裁后的图片 是一串base64加密字符串
    //未测试，未启用
    public static function uploadBasePic($base64String='',$target)
    {

        $request=Request::instance();

        if(!$target || !$base64String)
        {
            throw new FileException([
                'msg'=>'文件target错误！'
            ]);
        }

        $allowed_extend=['jpg','png','jpeg'];
        $r='';
        $image='';
        //$rootPath=RootPath::getPath();
        //$filePathPin1=$rootPath.'/web'.\Yii::$app->params['filetaget']['book'].'/';
        $filePathPin1=ROOT_PATH.'public'.Config::get('uploadPath.'.$target).'/';

        $dataName=date('Ymd');

        try{

            if(!file_exists($filePathPin1.$dataName))
            {

                mkdir($filePathPin1.$dataName,0777);
                chmod($filePathPin1.$dataName,0777);
            }
        } catch(Exception $e){
            throw new FileException([
                'msg'=>$e->getMessage()
            ]);
        }

        //文件名字

        // 文件的dir
        $fileDir=md5(file_get_contents($base64String));

        //文件的type
        $typeBegin=strpos($base64String,'/')+1;
        $typeEnd=strpos($base64String,';');
        $typeCount=$typeEnd-$typeBegin;
        $pathExtension=substr($base64String,$typeBegin,$typeCount);
        if(!in_array( $pathExtension ,$allowed_extend) )
        {
            throw new FileException([
                'msg'=>'格式错误'
            ]);
        }


        /*$pathExtensionFlag=explode('.',$fileName);
        $pathExtension=strtolower( end($pathExtensionFlag));*/

        //文件全名
        $fileNameLast=$fileDir.'.'.$pathExtension;

        //完整路径
        $filePathLast=$filePathPin1.$dataName.'/'.$fileNameLast;
        $filePathLast=str_replace('\\','/',$filePathLast);
        // var_dump($filePathLast);exit;

        if (strstr($base64String,",")) {
            $image = explode(',', $base64String);
            $image = $image[1];


            if (is_uploaded_file($image)) {
                move_uploaded_file($image, $filePathLast);
            } else {
                $r = file_put_contents($filePathLast, base64_decode($image));
            }
        }else{
            throw new FileException([
                'msg'=>'base64格式错误'
            ]);
        }

        if($r)
        {
            return [
                'fileUrl'=>$dataName.'/'.$fileNameLast,
                'fileRealPath'=>$filePathLast
            ];

        }else{
            throw new FileException([
                'msg'=>'上传失败'
            ]);

        }
    }
}