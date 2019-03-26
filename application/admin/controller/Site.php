<?php
/**
 * Created by PhpStorm.
 * User: lzs592
 * Date: 2019/2/20
 * Time: 16:30
 */

namespace app\admin\controller;
use app\admin\common\controller\Base;
use app\admin\common\model\Site as SiteModel;
use think\facade\Request;
use think\facade\Session;

class Site extends Base
{
    //站点的管理首页
    public function index(){
        //1.获取站点信息
        $siteInfo=SiteModel::get(['status'=>1]);
        //2.模板复制
        $this->view->assign('siteInfo',$siteInfo);

        //3.渲染模板
        return $this->view->fetch('index');

    }
    //保存站点修改信息
    public function save(){
        //获取数据
        $data=Request::param();

        //更新
        if(SiteModel::update($data)){
            $this->success('更新成功','index');
        }
        $this->error('更新失败','index');
    }
}