<?php
/**
 * Created by PhpStorm.
 * User: Lich
 * Date: 2018/12/27
 * Time: 11:28
 */

namespace app\ceping\controller\v1;


use app\ceping\controller\BaseController;
use app\ceping\model\Pic;
use app\ceping\model\Vedio;
use app\ceping\service\UploadService;
use app\ceping\service\UrlService;
use app\ceping\validate\FileUploadValidate;
use app\libExcep\FileException;
use app\libExcep\SuccessException;
use think\Request;

class UploadPicController extends BaseController
{
    public static function uploadPic(Request $request)
    {

        if($request->isPost())
        {
            (new FileUploadValidate())->goCheck();

            $inputData=input('post.');


            $getFileInfo=UploadService::uploads($inputData['bucket'],$inputData['type']);
            if(!$getFileInfo)
            {
                throw new FileException([
                    'msg'=>'上传文件返回值错误！'
                ]);
            }

            //存入图片数据库
            switch($inputData['type']){
                case 'pic':
                    $res=Pic::addInfo($inputData['user_id'],$inputData['bucket'],$getFileInfo['fileUrl']);
                    break;
                case 'vedio':
                    $res=Vedio::addInfo($inputData['user_id'],$inputData['bucket'],$getFileInfo['fileUrl']);
                    break;
                default:
                    throw new FileException();
            }


            if(!$res)
            {
                throw new FileException([
                    'msg'=>'数据库保存失败！'
                ]);
            }

            $picUrlAll=UrlService::picUrl($getFileInfo['fileUrl'],$inputData['bucket']);

            if($picUrlAll)
            {
                throw new SuccessException([
                    'data'=>$picUrlAll
                ]);
            }
        }

    }
}