<?php


namespace app\common\controller;
use app\common\model\Article;
use think\Controller;
use think\facade\Session;
use app\common\model\ArtCate;
use app\admin\common\model\Site;
use think\facade\Request;

class Base extends Controller
{
    // 初始化方法 创建常量和公共方法 在所有的方法之前被调用
    protected function initialize()
    {
        //显示分类导航
        $this->showNav();
        //检测网站是否关闭
        $this->is_open();
        //获取右侧数据
        $this->getHotArt();
    }

    //防止重复登录
    public function logined(){
        if(Session::has('user_id')){
            $this->error('你已经登录','index/index');
        }
    }
    public function isLogin(){
        if(!Session::has('user_id')){
            $this->error('请登录','index/login');
        }
    }

    //显示分类导航
    protected function showNav(){
        //1.查询分类表获取到所有的分类信息
        $cateList=ArtCate::all(function($query){
            $query->where('status',1)->order('sort','asc');
        });
        //2,将分类信息赋值给模板 nav.html
        $this->view->assign('cateList',$cateList);
    }
//检测站点是否关闭
public function is_open(){
        //1,获取当前站点状态
    $isOpen=Site::where('status',1)->value('is_open');

    //2.如果站点已经关闭,那我们只允许关闭前台
    if($isOpen==0&&Request::module()=='index'){
        //关闭网站
        $info=<<<'INFO'
<body style="background-color:#333">
<h1 style="color: #eeeeee;text-align:center;margin:200px">站点维护中...</h1>
INFO;
        exit($info);
    }
}

//检测注册是否关闭
public function is_reg(){
        //获取注册状态
    $isReg=Site::where('status',1)->value('is_reg');

    //2.如果站点已经关闭,那我们只允许关闭前台
if($isReg==0){
    //关闭网站
$this->error('注册关闭','index/index');
}
}
//根据阅读量pv来获取内容
public function getHotArt(){
        $hotArtList=Db('think_article')->where('status',1)->order('pv','desc')->limit(12)->select();
        $this->view->assign('hotArtList',$hotArtList);
}
}