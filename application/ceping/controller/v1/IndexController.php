<?php
/**
 * Created by PhpStorm.
 * User: Lich
 * Date: 2018/12/20
 * Time: 10:27
 */

namespace app\ceping\controller\v1;


use app\ceping\controller\BaseController;
use app\ceping\model\Informations;
use app\ceping\validate\PageOneValidate;
use app\ceping\validate\PageTwoValidate;
use app\libExcep\FailException;
use app\libExcep\FileException;
use app\libExcep\SuccessException;
use think\process\exception\Failed;

class IndexController extends BaseController
{
    /*
     * @info    测评主题接口
     * @url     api/v1/index
     */
    public function index()
    {
        $request=$this->request;

        $pages=$request->post('pages');

        switch($pages)
        {
            //处理第一页数据
            case "one":
                $this->saveOne();
                break;
            case 'two':
                $this->saveTwo();
                break;
            default:
                return json(['msg'=>'无任何处理']);
        }


    }

    private function saveOne()
    {
        (new PageOneValidate())->goCheck();

        $res=Informations::addOneInfo(input('post.'));
        if($res)
        {
            throw new SuccessException([
                'data'=>$res->id
            ]);
        }else{
            throw new FailException();
        }

    }

    private function saveTwo()
    {
        (new PageTwoValidate())->goCheck();

        $pageTwoValidate=new PageTwoValidate();
        $pageTwoValidate->goCheck();

        $user_id=input('post.user_id');

        $data=input('post.');

        $res=Informations::update($data,['id'=>$user_id],true);
        if(!$res)
        {
            throw new FileException();
        }

        throw new SuccessException();
    }
}