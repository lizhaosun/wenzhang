<?php
namespace app\admin\controller;
use app\admin\common\controller\Base;
use app\admin\common\model\Cate as CateModel;
use think\facade\Request;
use think\facade\Session;

class Cate extends Base
{
    //分类管理首页
    public function index(){
        //检查用户是否登录
        $this->isLogin();
        //登录成功后直接跳转到分类管理界面
        return $this->redirect('cateList');
    }
    //分类列表
    public function cateList(){
        //检查用户是否登录
        $this->isLogin();
        //获取所有的分类
        $catList=CateModel::all();
        //设置模板变量
        $this->view->assign('title','分类管理');
        $this->view->assign('empty','<span style="color:red">没有分类</span>');
        $this->view->assign('cateList',$catList);
        //渲染分类模板
        return $this->view->fetch('catelist');
    }
   //渲染编辑分类界面
    public function cateEdit(){
   //获取分类信息
        $cateId=Request::param('id');
        //根据主键查询要更新的分类信息
        $cateInfo=CateModel::where('id',$cateId)->find();
        //设置模板变量
        $this->view->assign('title','编辑分类');
        $this->view->assign('cateInfo',$cateInfo);
        return $this->view->fetch('cateedit');
    }
    //执行更新操作
    public function doEdit(){
        $data=Request::param();
        //2.取出主键
        $id=$data['id'];
        //3.将用户密码加密后保存回去

        //4.删除主键ID
        unset($data['id']);
        //5.执行更新操作
        if(CateModel::where('id',$id)->data($data)->update()){
            return $this->success('更新成功','cateList');
        }
        //6.更新失败
        $this->error('没有更新或者更新失败');
    }
    public function doDelete()
    {
        //获取id
        $id = Request::param('id');
        //执行删除
        if (CateModel::where('id', $id)->delete()) {
            return $this->success('删除成功', 'cateList');
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