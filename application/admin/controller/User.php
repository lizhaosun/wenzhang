<?php
/**
 * Created by PhpStorm.
 * User: lzs592
 * Date: 2019/2/20
 * Time: 16:30
 */

namespace app\admin\controller;
use app\admin\common\controller\Base;
use app\admin\common\model\User as UserModel;
use think\facade\Request;
use think\facade\Session;


class User extends Base
{
    //渲染登录界面
    public function login(){
        if(Session::has('user_id')){
            $userId= Session::get('user_id');
            $res= Db('think_user')->where('id',$userId)->find();
            if($res['is_admin']==0){
                $this->error('该账号非管理员','/index.php');
            }
            Session::set('admin_id',$res['id']);
            Session::set('admin_name',$res['name']);
            Session::set('admin_isAdmin',$res['is_admin']);
            Session::set('admin_level',$res['admin_level']);

            $this->logined();

        }

        $this->view->assign('title','管理员登录');
            return $this->view->fetch('login');
    }
    //验证后台登录
    public function CheckLogin(){
        $data=Request::param();
        //查询条件
        $map[]=['email','=',$data['email']];
        $map[]=['password','=',sha1($data['password'])];
        $result=UserModel::where($map)->find();
        if($result&&($result['is_admin']==1)){
            Session::set('admin_id',$result['id']);
            Session::set('admin_name',$result['name']);
            Session::set('admin_isAdmin',$result['is_admin']);
            Session::set('admin_level',$result['admin_level']);
            $this->success('登录成功','admin/user/userList');
        }
        $this->error('请登录管理员账号');
    }
    //退出登录
    public function logout(){
        //1.清楚session
        Session::clear();
        //2.退出登录并跳转到登录页面
        $this->success('退出成功','admin/user/login');

    }
    //用户列表
    public function userList(){

        //1.获取当前用户的id和级别is_admin
        $data['admin_id']=Session::get('admin_id');
        $data['admin_level']=Session::get('admin_level');
        $data['admin_isAdmin']=Session::get('admin_isAdmin');

        if($data['admin_isAdmin']==0){
            $this->error('该账号非管理员','/index.php');
        }
        //2.获取当前用户信息
        $userList=UserModel::where('id',$data['admin_id'])->select();

        //3.如果是超级管理员,获取全部信息
        if($data['admin_level']==1){
            $userList=UserModel::select();
        }
        //4.模板赋值

        $this->view->assign('title','用户管理');
        $this->view->assign('empty','<span>没有任何数据</span>span>');
        $this->view->assign('userList',$userList);
        //5.渲染出用户列表模板
        return $this->view->fetch('userList');
    }
    //渲染用户编辑界面
    public function userEdit()
    {//1获取更新的用户主键
        $userId=Request::param('id');

        //2.根据主键进行查询
        $userInfo=UserModel::where('id',$userId)->find();
        //3.设置编辑界面的模板变量
        $this->view->assign('title','编辑用户');
        $this->assign('userInfo',$userInfo);
        //4.渲染编辑界面
        return $this->fetch('useredit');
    }
    //执行用户信息的保存
    public function doEdit(){
        //1.获取到用户提交的信息
        $data=Request::param();
        //2.取出主键
        $id=$data['id'];
        //3.将用户密码加密后保存回去
        if($data['password']==$this->password){
            unset($data['password']);
        }else{
            $data['password']=sha1($data['password']);
        }

        //4.删除主键ID
        unset($data['id']);
        //5.执行更新操作
        if(UserModel::where('id',$id)->data($data)->update()){
            return $this->success('更新成功','userList');
        }
        //6.更新失败
        $this->error('没有更新或者更新失败');
    }
public function doDelete(){
        //获取id
        $id=Request::param('id');
        //执行删除
    if(UserModel::where('id',$id)->delete()){
        return $this->success('删除成功','userList');
    }
    //删除失败
    $this->error('删除失败');
}
}