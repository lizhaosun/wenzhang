<?php
/*
 * 后台公共控制器*/

namespace app\admin\common\controller;
use think\Controller;
use think\facade\Session;
use think\facade\Config;

class Base extends Controller
{
    //初始化方法
    protected function initialize()
    {


    }
    /*
     * 检测用户是否登录
     * 1.调用位置:后台入口:admin.php/index/index
     * 2.*/
    public function isLogin(){
        if(!Session::has('admin_id')){
            $this->error('请先登录','admin/user/login');
        }


    }

    public function logined(){
        if(Session::has('admin_id')){
            $this->error('你已经登录','admin/user/userList');
        }
    }


}