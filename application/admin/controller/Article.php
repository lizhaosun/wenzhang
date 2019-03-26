<?php
namespace app\admin\controller;
use app\admin\common\controller\Base;
use app\admin\common\model\Article as ArticleModel;
use think\facade\Request;
use think\facade\Session;

class Article extends Base
{
    //文章管理首页
    public function index(){
        //检查用户是否登录
        $this->isLogin();
        //登录成功后直接跳转到文章管理界面
        return $this->redirect('articleList');
    }
    //文章列表
    public function articleList(){

        //检查用户是否登录
        $this->isLogin();

        //获取当前用户id和用户级别
       $userId= Session::get('user_id');

        $isAdmin=Session::get('is_admin');
        $adminLevel=Session::get('admin_level');

        //获取当前用户发布的文章
        $artList=ArticleModel::where('user_id',$userId)->paginate(5);

//超级管理员
        if($adminLevel==1){
            $artList=ArticleModel::paginate(5);

        }
        //设置模板变量
        $this->view->assign('title','文章管理');
        $this->view->assign('empty','<span style="color:red">没有文章</span>');
        $this->view->assign('artList',$artList);
        //渲染分类模板
        return $this->view->fetch('articleList');
    }
    //渲染编辑分类界面
    public function articleEdit(){
        //检查用户是否登录
        $this->isLogin();
        //获取分类信息
        $articleId=Request::param('id');
        //根据主键查询要更新的分类信息
        $articleInfo=ArticleModel::where('id',$articleId)->find();
       $cateList= Db('think_article_category')->all();
        //设置模板变量
        $this->view->assign('title','编辑分类');
        $this->view->assign('articleInfo',$articleInfo);
        $this->view->assign('cateList',$cateList);
        return $this->view->fetch('articleEdit');
    }
    //执行更新操作
    public function doEdit(){
        $data=Request::param();
        //2.取出主键
        $id=$data['id'];
        //3.将用户密码加密后保存回去

        //4.删除主键ID
        unset($data['id']);

        if(!empty(Request::file())){
            $file=Request::file('title_img');
            //文件信息验证成功后,再上传到服务器上的指定目录 以public为起始目录
            $info=$file->validate([    //在服务器
                'require'=>'require',
                'size'=>209715200,
                'ext'=>'jpeg,jpg,png,gif',
            ])->move('uploads/');
            if($info){
                $data['title_img']= $info->getSaveName();
            }else{
                $this->error($file->getError(),'articleedit');
            }
        }
        //5.执行更新操作
        if(ArticleModel::where('id',$id)->data($data)->update()){
            return $this->success('更新成功','articleList');
        }
        //6.更新失败
        $this->error('没有更新或者更新失败');
    }
    public function doDelete()
    {
        //获取id
        $id = Request::param('id');

        //执行删除
        if (ArticleModel::where('id', $id)->delete()) {
            return $this->success('删除成功', 'articleList');
        }
        //删除失败
        $this->error('删除失败');
    }
    //添加分类
    public function cateAdd(){
        //渲染添加界面
        return $this->fetch('cateadd',['title'=>'添加分类']);
    }
    public function doAdd(){
        //获取数据
        $data=Request::param();
        //添加操作
        if(CateModel::create($data)){
            $this->success('添加成功','catelist');
        }
        //失败
        $this->error('新增失败');
    }
}