<?php
/**
 * Created by PhpStorm.
 * User: Lich
 * Date: 2018/12/20
 * Time: 13:29
 */

namespace app\libExcep\base;




use think\exception\Handle;
use think\Log;
use think\Request;

class ExceptionHandler extends Handle
{
    private $code;
    private $msg;
    private $errorCode;
    private $datas=[];

    //重写抛出的异常，抛出的异常都会调用它
    //需要在config 里面设置子类的路径
    public function render(\Exception $e)
    {
        //return parent::render($e); // TODO: Change the autogenerated stub
        if($e instanceof BaseException)
        {
            //自动以的异常,返回客户端的
            $this->code=$e->code;
            $this->msg=$e->msg;
            $this->errorCode=$e->errorCode;
            $this->datas=$e->data;
        }else{
            //如果调试模式就显示调试页面，否则显示返回APPJSON数据
            if(config('app_debug'))
            {
                return parent::render($e);
            }else{
                $this->code=500;
                $this->msg='服务器内部错误';
                $this->errorCode=999;
            }

        }

        $this->selfLog($e);

        $requst=Request::instance();
        $data=[
            'msg'=>$this->msg,
            'errorCode'=>$this->errorCode,
            'url'=>$requst->url(),
            'data'=>$this->datas
        ];

        return json($data,$this->code,['Access-Control-Allow-Origin'=>'*']);
    }

    //自定义写入日志
    public function selfLog(\Exception $e)
    {
        //自己初始化,在config 里面关掉自动记录 把File 改成 test
        Log::init([
            'type'=>'File',
            'path'=>LOG_PATH,
            'level'=>['error']
        ]);

        //Log::record($e->getMessage(),'error');
        Log::record([$this->code,$this->errorCode,$this->msg],'error');
    }
}